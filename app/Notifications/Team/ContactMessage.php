<?php

namespace App\Notifications\Team;

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
        $mail= (new MailMessage)
                    ->subject("New Contact Message From Team")
                    ->line('You have received a new contact message from team :')
                    ->line("**Student 1 Name:** {$this->data['name1']}")
                    ->line("**Student 1 Email:** {$this->data['email1']}") ;
        if($this->data["name2"]){
            $mail=$mail
             ->line("**Student 2 Name:** {$this->data['name2']}")
            ->line("**Student 2 Email:** {$this->data['email2']}")            ;
        }
        $mail->line("**Message:**")
                    ->line($this->data['message'])
                    ->line('---')
                    ->line('This message was sent via the contact form.');
        return $mail ;
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
