<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourrierEntrantController;
use App\Http\Controllers\ArchiveEntrantController;
use App\Http\Controllers\CourrierSortantController;
use App\Http\Controllers\ArchiveSortantController;
use App\Http\Controllers\ExtraController;

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

Route::middleware('auth')->group(function () {
    Route::resource('/users',UserController::class);
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
});