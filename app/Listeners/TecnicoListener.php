<?php

namespace App\Listeners;

use App\Models\c_tecnico;
use App\Models\d_analisi;
use App\Models\User;
use App\Notifications\tecnicoNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Role;

class TecnicoListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
       
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        User::all()
        ->except($event->folio->user_id)
        ->where('id',$event->usuario)
        ->each(function(User $user) use ($event){
           if($user->hasRole('tecnico')){
            Notification::send($user,new tecnicoNotification($event->folio,$event->descripcion));
             }
        });
    }
}
