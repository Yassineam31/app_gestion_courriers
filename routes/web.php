<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourrierEntrantController;
use App\Http\Controllers\ArchiveEntrantController;
use App\Http\Controllers\CourrierSortantController;
use App\Http\Controllers\ArchiveSortantController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/users',UserController::class);
Route::resource('/courrier_entrants',CourrierEntrantController::class);
Route::resource('/archive_entrants',ArchiveEntrantController::class);
Route::resource('/courrier_sortants',CourrierSortantController::class);
Route::resource('/archive_sortants',ArchiveSortantController::class);