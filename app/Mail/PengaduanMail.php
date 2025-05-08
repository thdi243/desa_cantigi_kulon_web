<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\PengaduanModel;
use Illuminate\Support\Facades\Log;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PengaduanMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $nik;
    public $category;
    public $description;
    public $location;
    public $status;

    /**
     * Create a new message instance.
     */
    public function __construct(PengaduanModel $pengaduan)
    {
        $this->name = $pengaduan->name;
        $this->nik = $pengaduan->nik;
        $this->category = $pengaduan->category;
        $this->description = $pengaduan->description;
        $this->location = $pengaduan->location;
        $this->status = $pengaduan->status;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Pemberitahuan Pengaduan')
            ->view('emails.email_pengaduan')
            ->with([
                'name' => $this->name,
                'nik' => $this->nik,
                'category' => $this->category,
                'description' => $this->description,
                'location' => $this->location,
                'status' => $this->status,
            ]);
    }
}
