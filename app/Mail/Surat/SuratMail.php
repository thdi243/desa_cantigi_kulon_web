<?php

namespace App\Mail\Surat;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\SuratModel;

class SuratMail extends Mailable
{
    use Queueable, SerializesModels;

    public $surat;
    public $pdfPath;

    /**
     * Create a new message instance.
     */
    public function __construct(SuratModel $surat, string $pdfPath)
    {
        $this->surat = $surat;
        $this->pdfPath = $pdfPath;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $jenisSurat = $this->surat->subSuratType->nama_sub_surat ?? 'Surat';
        $namaPemohon = $this->surat->data_pemohon['nama_lengkap_pemohon'] ?? 'Pemohon';

        return $this
            ->subject("{$jenisSurat} - {$namaPemohon}")
            ->view('emails.surat_template')
            ->attach($this->pdfPath, [
                // Include the sub_surat type name in the filename
                'as' => "{$jenisSurat}_{$this->surat->nomor_surat}.pdf",
                'mime' => 'application/pdf',
            ]);
    }
}
