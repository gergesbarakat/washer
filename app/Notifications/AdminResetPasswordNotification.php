<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AdminResetPasswordNotification extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $resetUrl = url("/admin/reset-password/{$this->token}?email=" . urlencode($notifiable->email));

        return (new MailMessage)
            ->subject('Admin Password Reset')
            ->greeting("Hello {$notifiable->name},")
            ->line('You are receiving this email because we received a password reset request for your admin account.')
            ->action('Reset Password', $resetUrl)
            ->line('If you did not request a password reset, no further action is required.');
    }
}
