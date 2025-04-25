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
    public $tanggal;
    public $type;
    public $subject;

    /**
     * Create a new message instance.
     */
    public function __construct($name, $nama_perusahaan, $nama_pekerjaan, $domisili_penempatan, $foto_loker, $tipe_lowongan, $link, $tanggal, $type = 'baru')
    {
        $this->name = $name;
        $this->nama_perusahaan = $nama_perusahaan;
        $this->nama_pekerjaan = $nama_pekerjaan;
        $this->domisili_penempatan = $domisili_penempatan;
        $this->foto_loker = $foto_loker;
        $this->tipe_lowongan = $tipe_lowongan;
        $this->link = $link;
        $this->tanggal = $tanggal;
        $this->type = $type;

        $this->subject = $type === 'revisi' ? '[Revisi] Lowongan Pekerjaan' : 'Lowongan Pekerjaan Baru Nih Buat Kamu!';
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('dewibelajar10@gmail.com', 'SMK Negeri 2 Cimahi'),
            replyTo: [
                new Address('dewibelajar10@gmail.com', 'SMK Negeri 2 Cimahi')
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
            view: $this->type === 'revisi' ? 'emails.revisilowonganEmail' : 'emails.lowonganEmail',
            with: [
                'name' => $this->name,
                'nama_perusahaan' => $this->nama_perusahaan,
                'nama_pekerjaan' => $this->nama_pekerjaan,
                'domisili_penempatan' => $this->domisili_penempatan,
                'foto_loker' => $this->foto_loker,
                'tipe_lowongan' => $this->tipe_lowongan,
                'link' => $this->link,
                'tanggal' => $this->tanggal
            ],
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
