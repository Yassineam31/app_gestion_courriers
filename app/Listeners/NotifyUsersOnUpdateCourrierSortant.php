<?php

namespace App\Listeners;

use App\Events\UpdateCourrierSortantEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use App\Notifications\UpdateCourrierSortant;

class NotifyUsersOnUpdateCourrierSortant
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
    public function handle(UpdateCourrierSortantEvent $event): void
    {
        $user = User::find($event->userId);

        // Récupérer tous les utilisateurs de la division du courrier
        $members = User::where('division', $user->division)->get();

        // Notifier chaque utilisateur
        foreach ($members as $member) {
            $member->notify(new UpdateCourrierSortant($event->courrier));
        }
    }
}
