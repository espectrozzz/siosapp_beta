<?php

namespace App\Listeners;

use App\Events\UpdateTecnicoEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use App\Notifications\tecnicoNotification;
use Illuminate\Support\Facades\Notification;

class UpdateTecnicoListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UpdateTecnicoEvent  $event
     * @return void
     */
    public function handle($event)
    {
        User::all()
        ->where('id',$event->usuario)
        ->each(function(User $user) use ($event){
           if($user->hasRole('despacho')){
            Notification::send($user,new tecnicoNotification($event->folio,$event->descripcion));
             }
        });
    }
}
