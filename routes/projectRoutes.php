<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourrierEntrantController;
use App\Http\Controllers\ArchiveEntrantController;
use App\Http\Controllers\CourrierSortantController;
use App\Http\Controllers\ArchiveSortantController;
use App\Http\Controllers\ExtraController;
use App\Http\Controllers\NotificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('verified')->group(function () {
    Route::resource('/users',UserController::class);
    Route::get('/contact_section',[UserController::class,'contactSectionIndex'])->name('contactSection');
    Route::post('/contact_section',[UserController::class,'storeModalData'])->name('submit.form');
    Route::resource('/courrier_entrants',CourrierEntrantController::class);
    Route::resource('/archive_entrants',ArchiveEntrantController::class);
    Route::resource('/courrier_sortants',CourrierSortantController::class);
    Route::resource('/archive_sortants',ArchiveSortantController::class);
    Route::get('/archiverCourrierEntrant/{id}',[ExtraController::class,'archiverCourrierEntrant'])->name('archiveIncoming');
    Route::get('/archiverCourrierSortant/{id}',[ExtraController::class,'archiverCourrierSortant'])->name('archiveOutgoing');
    Route::get('/archives',[ExtraController::class,'pageArchives'])->name('archivePage');
    Route::get('/restaureArchiveEntrant/{id}',[ExtraController::class,'restaureArchiveEntrant'])->name('restoreIncoming');
    Route::get('/restaureArchiveSortant/{id}',[ExtraController::class,'restaureArchiveSortant'])->name('restoreOutgoing');
    Route::post('/searchCourrierEntrant',[ExtraController::class, 'searchEntrant'])->name('searchEntrant');
    Route::post('/searchArchiveEntrant',[ExtraController::class, 'searchArchiveEntrant'])->name('searchArchiveEntrant');
    Route::post('/searchCourrierSortant',[ExtraController::class, 'searchSortant'])->name('searchSortant');
    Route::post('/searchArchiveSortant',[ExtraController::class, 'searchArchiveSortant'])->name('searchArchiveSortant');
    Route::post('/searchUser',[ExtraController::class, 'searchUser'])->name('searchUser');
    Route::get('/notifications', [NotificationController::class, 'notifications'])->name('notifications.index');
    Route::put('/notifications/{notificationId}/showIncomingMail', [NotificationController::class, 'markAsReadNewCourrierAdded'])->name('notifications.NewCourrierAdded');
    Route::put('/notifications/{notificationId}/showOutgoingMail', [NotificationController::class, 'markAsReadNewCourrierSortant'])->name('notifications.NewCourrierSortant');
    Route::put('/notifications/{notificationId}/showUpdatedIncomingMail', [NotificationController::class, 'markAsReadUpdatedCourrierAdded'])->name('notifications.UpdateCourrierAdded');
    Route::put('/notifications/{notificationId}/showUpdatedOutgoingMail', [NotificationController::class, 'markAsReadUpdatedCourrierSortant'])->name('notifications.UpdateCourrierSortant');
    Route::get('/notifications-count', [NotificationController::class, 'getNotificationsCount']);
    Route::delete('/delete-notification/{id}', [NotificationController::class, 'destroy'])->name('notification.destroy');
});
