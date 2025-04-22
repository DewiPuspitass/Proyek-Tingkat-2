<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class BroadcastEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $nama_perusahaan;
    public $nama_pekerjaan;
    public $domisili_penempatan;
    public $foto_loker;
    public $tipe_lowongan;
    public $link;

    /**
     * Create a new message instance.
     */
    public function __construct($name, $nama_perusahaan, $nama_pekerjaan, $domisili_penempatan, $foto_loker, $tipe_lowongan, $link)
    {
        $this->name = $name;
        $this->nama_perusahaan = $nama_perusahaan;
        $this->nama_pekerjaan = $nama_pekerjaan;
        $this->domisili_penempatan = $domisili_penempatan;
        $this->foto_loker = $foto_loker;
        $this->tipe_lowongan = $tipe_lowongan;
        $this->link = $link;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('dewibelajar10@gmail.com', 'Pengemar terberatmu'),
            replyTo: [
                new Address('dewibelajar10@gmail.com', 'Pengemar terberatmu')
            ],
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.lowonganEmail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
