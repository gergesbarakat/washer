<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class UserResetPasswordNotification extends Notification
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
        $resetUrl = url("user/reset-password/{$this->token}?email=" . urlencode($notifiable->email));

        return (new MailMessage)
            ->subject('Reset Your Password')
            ->greeting("Hi {$notifiable->name},")
            ->line('You requested to reset your password.')
            ->action('Reset Password', $resetUrl)
            ->line('If you didn’t request this, ignore this email.');
    }
}
