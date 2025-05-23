<?php

namespace App\Notifications\Teacher;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactMessage extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $data ;
    public function __construct($data)
    {
        //
        $this->data=$data;
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
        return (new MailMessage)
                    ->subject("New Contact Message From Teacher")
                    ->line('You have received a new contact from a teacher:')
                    ->line("**Name:** {$this->data['name']}")
                    ->line("**Email:** {$this->data['email']}")
                    ->line("**Message:**")
                    ->line($this->data['message'])
                    ->line('---')
                    ->line('This message was sent via the contact form.');
        
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
