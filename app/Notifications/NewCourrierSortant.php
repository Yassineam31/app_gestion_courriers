<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCourrierSortant extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $courrier;
    public function __construct($courrier)
    {
        $this->courrier = $courrier;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'Reference'=>$this->courrier->Reference,
            'Destinataire'=>$this->courrier->Destinataire,
            'NumeroEnvoiAcademie'=>$this->courrier->NumeroEnvoiAcademie,
            'DateEnvoiAcademie'=>$this->courrier->DateEnvoiAcademie,
            'DernierDelaiReceptionReponse'=>$this->courrier->DernierDelaiReceptionReponse,
            'ReponseRecue'=>$this->courrier->ReponseRecue,
            'Statut'=>$this->courrier->Statut,
            'CorrespondanceRequiertReponse'=>$this->courrier->CorrespondanceRequiertReponse,
            'ObjetCorrespondance'=>$this->courrier->ObjetCorrespondance,
            'TelechargementCorrespondance'=>$this->courrier->TelechargementCorrespondance,
            'date' => now(), // Date et heure de la notification
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
