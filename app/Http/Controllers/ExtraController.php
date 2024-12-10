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

    public function pageArchives(){
        return view('archives');
    }

    public function restaureArchiveEntrant($id){
        DB::transaction(function () use ($id) {
        $archiveEntrant = ArchiveEntrant::findOrFail($id);
        CourrierEntrant::create($archiveEntrant->toArray());
        $archiveEntrant->delete();  
    });
        return back()->with('success', 'تم إرجاع البريد بنجاح');
    }

    public function restaureArchiveSortant($id){
        DB::transaction(function () use ($id) {
        $archiveSortant = ArchiveSortant::findOrFail($id);
        CourrierSortant::create($archiveSortant->toArray());
        $archiveSortant->delete();  
    });
        return back()->with('success', 'تم إرجاع البريد بنجاح');
    }
}