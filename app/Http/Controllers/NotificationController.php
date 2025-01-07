<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notifications(){
        
        // Récupérer les notifications de l'utilisateur connecté
        $user = auth()->user();
        $notifications = $user->notifications()->orderBy('created_at','desc')->paginate(8); // Par exemple, 10 notifications par page

        return view('notifications.index', compact('notifications'));
    }

    // Marquer une notification comme lue
    public function markAsReadNewCourrierAdded($notificationId){

        $user = auth()->user();
        $notification = $user->notifications()->find($notificationId);

        if ($notification) {
            $notification->markAsRead();
        }

        return  view('notifications.show_incoming_mail_notif',compact('notification'));
    }

    public function markAsReadNewCourrierSortant($notificationId){

        $user = auth()->user();
        $notification = $user->notifications()->find($notificationId);

        if ($notification) {
            $notification->markAsRead();
        }

        return  view('notifications.show_outgoing_mail_notif',compact('notification'));
    }

    public function markAsReadUpdatedCourrierAdded($notificationId){

        $user = auth()->user();
        $notification = $user->notifications()->find($notificationId);

        if ($notification) {
            $notification->markAsRead();
        }

        return  view('notifications.show_updated_incoming_mail_notif',compact('notification'));
    }

    public function markAsReadUpdatedCourrierSortant($notificationId){

        $user = auth()->user();
        $notification = $user->notifications()->find($notificationId);

        if ($notification) {
            $notification->markAsRead();
        }

        return  view('notifications.show_updated_outgoing_mail_notif',compact('notification'));
    }

    public function getNotificationsCount(){

    $user = auth()->user();
    $unreadCount = $user->unreadNotifications->count();

    return response()->json(['unreadCount' => $unreadCount]);
    }

    // Supprimer une notification
    public function destroy($id)
    {
        $notification = auth()->user()->notifications()->find($id);

        if ($notification) {
            $notification->delete();
        }

        return back();
    }
}
