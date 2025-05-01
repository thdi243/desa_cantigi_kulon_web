<?php

namespace App\Jobs;

use App\Models\Surat;
use App\Models\SuratModel;
use Illuminate\Bus\Queueable;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class PrintSuratJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $surat;

    /**
     * Create a new job instance.
     */
    public function __construct(SuratModel $surat)
    {
        $this->surat = $surat;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Generate PDF
        $pdf = PDF::loadView('pdfs.sk_domisili_masyarakat', [
            'surat' => $this->surat,
        ]);

        // You could save the PDF on the server
        $filename = 'surat_' . $this->surat->tgl_surat . '.pdf';
        $path = Storage::disk('public')->put($filename, $pdf->output());

        // Make sure directory exists
        if (!file_exists(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }

        // Save PDF
        $pdf->save($path);

        // Optional: Update surat record with PDF path
        $this->surat->update([
            'pdf_path' => 'pdf/' . $filename,
        ]);
    }
}
