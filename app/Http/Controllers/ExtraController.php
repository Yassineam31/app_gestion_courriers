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
        $archiveEnt = $courrierEntrant->toArray();
        $archiveEnt['courrier_entrants_id'] = $id;
        ArchiveEntrant::create($archiveEnt);
        $courrierEntrant->delete();  
    });
        return back()->with('success', 'تمت إضافة البريد إلى الأرشيف بنجاح');
    }

    public function archiverCourrierSortant($id){
        DB::transaction(function () use ($id) {
        $courrierSortant = CourrierSortant::findOrFail($id);
        $archiveSort=$courrierSortant->toArray();
        $archiveSort['courrier_sortants_id']=$id;
        ArchiveSortant::create($archiveSort);
        $courrierSortant->delete();  
    });
        return back()->with('success', 'تمت إضافة البريد إلى الأرشيف بنجاح');
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