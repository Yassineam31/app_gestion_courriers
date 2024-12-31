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
            ->subject(__('إعادة تعيين كلمة المرور'))
            ->greeting(__('مرحباً،'))
            ->line(__('لقد تلقينا طلباً لإعادة تعيين كلمة المرور الخاصة بحسابك'))
            ->action(__('إعادة تعيين كلمة المرور'), $resetUrl)
            ->line(__('إدارة منصة تدبير المراسلات'))
            ->salutation(__('&copy; 2025'));
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
