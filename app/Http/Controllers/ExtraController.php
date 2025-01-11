<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\AUTH;
use App\Models\CourrierEntrant;
use App\Models\CourrierSortant;
use App\Models\ArchiveEntrant;
use App\Models\ArchiveSortant;
use App\Models\User;
use Illuminate\pagination\paginator;

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
        return back()->with('success', 'تم إرجاع البريد إلى القائمة بنجاح');
    }

    public function restaureArchiveSortant($id){
        DB::transaction(function () use ($id) {
        $archiveSortant = ArchiveSortant::findOrFail($id);
        CourrierSortant::create($archiveSortant->toArray());
        $archiveSortant->delete();  
    });
        return back()->with('success', 'تم إرجاع البريد إلى القائمة بنجاح');
    }

    public function searchEntrant(Request $request){
            $query = $request->input('query');
            $user = auth()->user();

            $results = $user->courrierEntrants()
                ->where(function ($q) use ($query) {
                    $q->where('Reference', 'LIKE', "%{$query}%")
                    ->orWhere('NumeroInscriptionAcademie', 'LIKE', "%{$query}%")
                    ->orWhere('NumeroEnvoiEntiteExpeditrice', 'LIKE', "%{$query}%")
                    ->orWhere('Expediteur', 'LIKE', "%{$query}%")
                    ->orWhere('SujetCorrespondance', 'LIKE', "%{$query}%")
                    ->orWhere('Statut', 'LIKE', "%{$query}%")
                    ->orWhere('DernierDelaiReponse', 'LIKE', "%{$query}%")
                    ->orWhere('DateInscriptionAcademie', 'LIKE', "%{$query}%")
                    ->orWhere('DateEnvoiEntiteExpeditrice', 'LIKE', "%{$query}%");
                })
                ->get();

            return response()->json($results);
        }

    public function searchArchiveEntrant(Request $request){
        $query = $request->input('query');
        $user = auth()->user();

        $results = $user->archiveEntrants()
            ->where(function ($q) use ($query) {
            $q->where('Reference', 'LIKE', "%{$query}%")
                ->orWhere('NumeroInscriptionAcademie', 'LIKE', "%{$query}%")
                ->orWhere('NumeroEnvoiEntiteExpeditrice', 'LIKE', "%{$query}%")
                ->orWhere('Expediteur', 'LIKE', "%{$query}%")
                ->orWhere('SujetCorrespondance', 'LIKE', "%{$query}%")
                ->orWhere('Statut', 'LIKE', "%{$query}%")
                ->orWhere('DernierDelaiReponse', 'LIKE', "%{$query}%")
                ->orWhere('DateInscriptionAcademie', 'LIKE', "%{$query}%")
                ->orWhere('DateEnvoiEntiteExpeditrice', 'LIKE', "%{$query}%");
            })
            ->get();
        return response()->json($results);
    }

    public function searchSortant(Request $request){
        $query = $request->input('query');
        $user = auth()->user();

        $results = $user->courrierSortants()
        ->where(function ($q) use ($query) {
        $q->where('Reference', 'LIKE', "%{$query}%")
            ->orWhere('Destinataire', 'LIKE', "%{$query}%")
            ->orWhere('ObjetCorrespondance', 'LIKE', "%{$query}%")
            ->orWhere('NumeroEnvoiAcademie', 'LIKE', "%{$query}%")
            ->orWhere('DateEnvoiAcademie', 'LIKE', "%{$query}%")
            ->orWhere('DernierDelaiReceptionReponse', 'LIKE', "%{$query}%")
            ->orWhere('Statut', 'LIKE', "%{$query}%");
        })
            ->get();
        return response()->json($results);
    }

    public function searchArchiveSortant(Request $request){
        $query = $request->input('query');
        $user = auth()->user();

        $results = $user->archiveSortants()
        ->where(function ($q) use ($query) {
        $q->where('Reference', 'LIKE', "%{$query}%")
            ->orWhere('Destinataire', 'LIKE', "%{$query}%")
            ->orWhere('ObjetCorrespondance', 'LIKE', "%{$query}%")
            ->orWhere('NumeroEnvoiAcademie', 'LIKE', "%{$query}%")
            ->orWhere('DateEnvoiAcademie', 'LIKE', "%{$query}%")
            ->orWhere('DernierDelaiReceptionReponse', 'LIKE', "%{$query}%")
            ->orWhere('Statut', 'LIKE', "%{$query}%");
        })
            ->get();
        return response()->json($results);
    }

    public function searchUser(Request $request){
        $query = $request->input('query');

        $results = User::where('name', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "%{$query}%")
            ->orWhere('division', 'LIKE', "%{$query}%")
            ->orWhere('poste', 'LIKE', "%{$query}%")
            ->orWhere('services', 'LIKE', "%{$query}%")
            ->get();
        return response()->json($results);
    }
}