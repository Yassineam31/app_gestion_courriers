<?php

namespace App\Listeners;

use App\Events\NewCourrierSortantEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use App\Notifications\NewCourrierSortant;

class NotifyUsersOnNewCourrierSortant
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
    public function handle(NewCourrierSortantEvent $event): void
    {
        $user = User::find($event->userId);

        // Récupérer tous les utilisateurs de la division du courrier
        $members = User::where('division', $user->division)->get();

        // Notifier chaque utilisateur
        foreach ($members as $member) {
            $member->notify(new NewCourrierSortant($event->courrier));
        }
    }
}
