<?php

declare(strict_types = 1);

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ValidationCodeNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public int | string $code)
    {
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail(): MailMessage
    {
        return (new MailMessage())
            ->line('Your verification code is: ')
            ->line($this->code);
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
