<?php

namespace App\Listeners;

use App\Events\NewCourrierAddedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use App\Notifications\NewCourrierAdded;

class NotifyUsersOnNewCourrier implements ShouldQueue
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
    public function handle(NewCourrierAddedEvent $event): void
    {
        $user = User::find($event->userId);

        // Récupérer tous les utilisateurs de la division du courrier
        $members = User::where('division', $user->division)->get();

        // Notifier chaque utilisateur
        foreach ($members as $member) {
            $member->notify(new NewCourrierAdded($event->courrier));
        }
    }
}
