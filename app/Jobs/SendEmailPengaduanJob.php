<?php

namespace App\Jobs;

use App\Models\User;
use App\Mail\PengaduanMail;
use App\Models\PengaduanModel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendEmailPengaduanJob implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, SerializesModels;

    protected $userId;
    protected $admin;
    protected $pengaduan;

    /**
     * Create a new job instance.
     */
    public function __construct(PengaduanModel $pengaduan, $userId = null)
    {
        $this->pengaduan = $pengaduan;
        $this->userId = $userId;
        $this->admin = Auth::id();
    }


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $user = User::findOrFail($this->userId);

            $emailPemohon = $user->email;

            // Log informasi email
            Log::info('Email Retrieval', [
                'user_id' => $user->id,
                'user_email' => $user->email,
                'pemohon_email' => $emailPemohon ?? 'No email found',
            ]);

            $updated = $this->pengaduan->update([
                'email_sent_at' => now(),
                'email_sent_by' => $this->admin,
            ]);

            // Log::info('Update Result', [
            //     'updated' => $updated,
            //     'admin' => $this->admin,  // Should be true if the update was successful
            // ]);

            // Send email
            Mail::to($user->email)->send(new PengaduanMail($this->pengaduan));
        } catch (\Exception $e) {
            Log::error('Gagal mengirim email surat', [
                'surat_id' => $this->pengaduan->id,
                'user_id' => $this->userId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            // Lempar ulang exception
            throw $e;
        }
    }

    // protected function updateSuratStatus(): void
    // {
    //     Log::info('Updating Surat Status', [
    //         'pengaduan_id' => $this->pengaduan->id,
    //         'admin' => $this->admin,
    //     ]);

    //     $updated = $this->pengaduan->update([
    //         'email_sent_at' => now(),
    //         'email_sent_by' => $this->admin,
    //     ]);

    //     Log::info('Update Result', [
    //         'updated' => $updated,  // Should be true if the update was successful
    //     ]);
    // }
}
