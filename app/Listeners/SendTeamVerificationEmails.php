<?php

namespace App\Listeners;

use App\Events\TeamRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendTeamVerificationEmails
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TeamRegistered $event): void
    {
        //
        $team=$event->team ;
           
        $emails=array_filter([$team->student1_email,$team->student2_email]) ;
        Mail::to()->send(new VerificationEmail()) ;
   
       
    }
}
