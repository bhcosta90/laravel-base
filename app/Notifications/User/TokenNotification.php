<?php

declare(strict_types = 1);

namespace App\Notifications\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TokenNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public string $token)
    {
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage())
            ->line(__('You have requested a new login token.'))
            ->line(__('Your token is: :token', ['token' => $this->token]))
            ->line(__('Please use this token to log in to your account.'))
            ->line(__('If you did not request this token, please ignore this email.'))
            ->line(__('Thank you for using our application!'));
    }
}
