<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
         // Configurer Carbon pour utiliser la locale arabe
         Carbon::setLocale('ar');
        
         // Obtenir la date actuelle et la formater
         $currentDate = Carbon::now()->translatedFormat('l j F Y');
 
         // Passer la date formatée à la vue
         return view('dashboard1', compact('currentDate'));
    }
}
