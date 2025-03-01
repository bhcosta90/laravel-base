<?php

declare(strict_types = 1);

namespace App\Notifications\User;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TokenNotification extends Notification
{
    public string $token;

    public function __construct(?string $token)
    {
        $this->token = $token;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage())
            ->line('');
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
