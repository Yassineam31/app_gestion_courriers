<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class AcademieMail extends Mailable
{
    use Queueable, SerializesModels;

    public $object;
    public $fichiers;
    public $messageContent;

    public function __construct($object, $fichiers,$messageContent){
        $this->object = $object;
        $this->fichiers = $fichiers;
        $this->messageContent = $messageContent;
    }

    public function build(){
        $mail = $this->subject($this->object)
                     ->view('emails.academieMail')
                     ->with([
                        'object' => $this->object,
                        'messageContent' => $this->messageContent,
                    ]);

        if ($this->fichiers) {
            foreach ($this->fichiers as $path) {
                $mail->attach(Storage::path($path));
            }
        }

        return $mail;
    }
}
