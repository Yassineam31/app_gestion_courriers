<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UpdateCourrierAdded extends Notification
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
            'Reference' => $this->courrier->Reference, // Reference du courrier
            'Expediteur' => $this->courrier->Expediteur, // Expediteur du courrier
            'SujetCorrespondance' => $this->courrier->SujetCorrespondance, // SujetCorrespondance
            'CorrespondanceRequiertReponse' => $this->courrier->CorrespondanceRequiertReponse,
            'NumeroInscriptionAcademie' => $this->courrier->NumeroInscriptionAcademie,
            'DateInscriptionAcademie' => $this->courrier->DateInscriptionAcademie,
            'DateEnvoiEntiteExpeditrice' => $this->courrier->DateEnvoiEntiteExpeditrice,
            'NumeroEnvoiEntiteExpeditrice' => $this->courrier->NumeroEnvoiEntiteExpeditrice,
            'Repondu' => $this->courrier->Repondu,
            'DernierDelaiReponse' => $this->courrier->DernierDelaiReponse,
            'Statut' => $this->courrier->Statut,
            'TelechargementCorrespondance' => $this->courrier->TelechargementCorrespondance,
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
