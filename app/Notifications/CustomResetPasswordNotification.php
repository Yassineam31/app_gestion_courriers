<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomResetPasswordNotification extends Notification
{
    use Queueable;

    protected $token;

    /**
     * Create a new notification instance.
     *
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        // Générer l'URL de réinitialisation
        $resetUrl = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        // Retourner l'email avec un message personnalisé
        return (new MailMessage)
            ->subject(__('Réinitialisation de votre mot de passe'))
            ->greeting(__('Bonjour!'))
            ->line(__('Vous recevez cet email car nous avons reçu une demande de réinitialisation de votre mot de passe.'))
            ->action(__('Réinitialiser le mot de passe'), $resetUrl)
            ->line(__('Si vous n\'avez pas demandé de réinitialisation, aucune action supplémentaire n\'est requise.'))
            ->salutation(__('Cordialement,') . '<br>' . config('app.name'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            // Données supplémentaires (facultatif)
        ];
    }
}
