<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\SuratModel;
use App\Mail\Surat\SuratMail;
use Illuminate\Bus\Queueable;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendEmailSuratJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $surat;
    protected $userId;
    protected $admin;

    /**
     * Create a new job instance.
     */
    public function __construct(SuratModel $surat, $userId = null)
    {
        $this->surat = $surat;
        $this->userId = $userId;
        $this->admin = Auth::id();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // Cari user penerima
            $user = User::findOrFail($this->userId);

            // Validasi dan dapatkan email
            $email = $this->getRecipientEmail($user);

            // Generate PDF
            $pdfPath = $this->generatePDF();

            // Kirim email
            $this->sendEmail($email, $pdfPath);

            // Update status surat
            $this->updateSuratStatus();

            // Log keberhasilan
            Log::info('Email surat berhasil dikirim', [
                'surat_id' => $this->surat->id,
                'user_id' => $this->userId,
                'email_to' => $email,
            ]);
        } catch (\Exception $e) {
            // Log kesalahan
            Log::error('Gagal mengirim email surat', [
                'surat_id' => $this->surat->id,
                'user_id' => $this->userId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            // Lempar ulang exception
            throw $e;
        }
    }
    /**
     * Validasi email penerima
     */
    protected function getRecipientEmail(User $user): string
    {
        // Prioritaskan email dari data pemohon
        $emailPemohon = $this->surat->data_pemohon['email_pemohon'] ?? null;

        // Jika tidak ada, gunakan email user
        if (!$emailPemohon && $user->email) {
            $emailPemohon = $user->email;
        }

        // Log informasi email
        Log::info('Email Retrieval', [
            'user_id' => $user->id,
            'user_email' => $user->email,
            'pemohon_email' => $emailPemohon ?? 'No email found',
        ]);

        // Throw exception jika tidak ada email
        if (!$emailPemohon) {
            throw new \Exception('Tidak ada email penerima yang tersedia');
        }

        // Validasi format email
        if (!filter_var($emailPemohon, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception('Format email tidak valid: ' . $emailPemohon);
        }

        return $emailPemohon;
    }

    /**
     * Generate PDF surat
     */
    protected function generatePDF(): string
    {
        // Create a simplified, safe filename
        $safeNomor = $this->surat->subSuratType->nama_sub_surat ?? 'UNDEFINED';
        $namaPemohon = $this->surat->data_pemohon['nama_lengkap_pemohon'];
        $filename = $safeNomor . '_' . $namaPemohon . '.pdf';

        // Define storage paths
        $storagePath = 'surat/send_email';
        $fullPath = $storagePath . '/' . $filename;

        // Ensure the directory exists
        Storage::disk('public')->makeDirectory($storagePath);
        $imagePath = public_path('images/logo/darma-ayu-logo.png');
        $base64Image = 'data:image/png;base64,' . base64_encode(file_get_contents($imagePath));

        $pdf = PDF::loadView($this->getTemplateForSubType($this->surat->sub_surat_type_id), [
            'surat' => $this->surat,
            'logoBase64' => $base64Image,
        ]);

        // Save PDF (choose ONE method, not both)
        Storage::disk('public')->put($fullPath, $pdf->output());

        // Get the actual storage path for return
        $physicalPath = Storage::disk('public')->path($fullPath);

        // Log successful PDF generation
        Log::info('PDF Generated Successfully', [
            'path' => $physicalPath,
            'surat_id' => $this->surat->id
        ]);

        return $physicalPath;
    }

    // Helper method to determine the template path
    private function getTemplateForSubType($subTypeId)
    {
        // Map sub_surat_type_id to the corresponding template
        $templates = [
            1 => 'pdfs.sk_domisili_masyarakat',
            2 => 'pdfs.sk_wali_murid',
            3 => 'pdfs.sk_penghasilan_ortu',
            4 => 'pdfs.sk_beda_nama',
            5 => 'pdfs.sk_domisili_lembaga',
            6 => 'pdfs.sk_tidak_dalam_sengketa',
            7 => 'pdfs.sk_taksir_tanah',
            8 => 'pdfs.sk_kks_perbaikan',
            9 => 'pdfs.sk_tidak_mampu',
            10 => 'pdfs.sk_tidak_mampu_sekolah',
            11 => 'pdfs.sk_tidak_mampu_bpjs',
            12 => 'pdfs.sp_rt_rw',
            13 => 'pdfs.sp_ktp',
            14 => 'pdfs.si_usaha',
            // Add more mappings as needed
        ];

        // Return the mapped template or a default one if not found
        return $templates[$subTypeId] ?? 'pdfs.surat-template';
    }

    /**
     * Kirim email dengan attachment
     */
    protected function sendEmail(string $email, string $pdfPath): void
    {
        if (!$this->surat->relationLoaded('subSuratType')) {
            $this->surat->load('subSuratType');
        }
        Mail::to($email)
            ->send(new SuratMail($this->surat, $pdfPath));
    }

    /**
     * Update status pengiriman surat
     */
    protected function updateSuratStatus(): void
    {
        $this->surat->update([
            'email_sent_at' => now(),
            'email_sent_by' => $this->admin,
        ]);
    }

    /**
     * Handle job failure
     */
    public function failed(\Throwable $exception)
    {
        Log::critical('Job pengiriman email surat gagal', [
            'surat_id' => $this->surat->id,
            'user_id' => $this->userId,
            'error' => $exception->getMessage(),
        ]);
    }
}
