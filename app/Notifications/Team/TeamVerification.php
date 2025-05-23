<?php

namespace App\Notifications\Team;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

class TeamVerification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $studentType ;

    public function __construct($studentType)
    {
         $this->studentType=$studentType ;
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
        ->subject('Confirm Your Email to Join the Team')
        ->greeting('Hello!')
        ->line("To complete your registration, please confirm your email address by clicking the button below.")
        ->action('Confirm My Email', $url)
        ->line("This link will expire in 1 hour for security reasons.") ;
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

        $email = $this->studentType==1 ? $notifiable->student1_email : $notifiable->student2_email ;
        return  URL::temporarySignedRoute(
              'team.verification.verify' ,
              Carbon::now()->addMinutes(60) ,
              ["id"=>$notifiable->id,"student"=>$this->studentType,"hash"=>sha1($email)]
          );
        
      }
}
