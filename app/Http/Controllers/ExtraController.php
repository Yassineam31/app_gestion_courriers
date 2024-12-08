<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CourrierEntrant;
use App\Models\CourrierSortant;
use App\Models\ArchiveEntrant;
use App\Models\ArchiveSortant;

class ExtraController extends Controller
{
    public function archiverCourrierEntrant($id){
        DB::transaction(function () use ($id) {
        $courrierEntrant = CourrierEntrant::findOrFail($id);
        ArchiveEntrant::create($courrierEntrant->toArray());
        $courrierEntrant->delete();  
    });
    return back()->with('success', 'تمت أرشفة البريد بنجاح');
    }

    public function archiverCourrierSortant($id){
        DB::transaction(function () use ($id) {
        $courrierSortant = CourrierSortant::findOrFail($id);
        ArchiveSortant::create($courrierSortant->toArray());
        $courrierSortant->delete();  
    });
    return back()->with('success', 'تمت أرشفة البريد بنجاح');
    }

}