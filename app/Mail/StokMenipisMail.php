<?php

namespace App\Mail;

use App\Models\Barang;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StokMenipisMail extends Mailable
{
    use Queueable, SerializesModels;

    public Barang $barang;

    public function __construct(Barang $barang)
    {
        $this->barang = $barang;
    }

    public function build()
    {
        return $this->subject('Peringatan: Stok Menipis — ' . $this->barang->nama)
                    ->view('emails.stok-menipis');
    }
}
