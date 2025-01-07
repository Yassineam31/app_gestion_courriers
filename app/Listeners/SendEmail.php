<?php

namespace App\Listeners;

use App\Events\MailEvent;
use Illuminate\Http\Request;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\AcademieMail;
use Illuminate\Support\Facades\Storage;


class SendEmail implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(MailEvent $event): void
    {
        $expediteur = $event->expediteur;
        $object = $event->object;
        $fichiersPaths = $event->fichiers;
        $messageContent = $event->messageContent;

        $mail = new AcademieMail($object,$fichiersPaths,$messageContent);

        // Ajouter les fichiers attachés
        foreach ($fichiersPaths as $path) {
            $mail->attach(Storage::path($path));
        }

        Mail::to($expediteur)->send($mail);
    }
}
