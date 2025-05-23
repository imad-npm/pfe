<?php

namespace App\Notifications\Teacher;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

class TeacherVerification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

    public function __construct()
    {
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
        $url=$this->generateUrl($notifiable) ;

        return (new MailMessage)
        ->subject('Confirm Your Email Address')
        ->greeting('Hello!')
        ->line("Please confirm your email address by clicking the button below to activate your account.")
        ->action('Confirm My Email', $url)
        ->line("This link is valid for 1 hour.")
      ;
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

    public function  generateUrl($notifiable){

        $email = $notifiable->email  ;
        return  URL::temporarySignedRoute(
              'teacher.verification.verify' ,
              Carbon::now()->addMinutes(60) ,
              ["id"=>$notifiable->id,"hash"=>sha1($email)]
          );
        
      }
}
