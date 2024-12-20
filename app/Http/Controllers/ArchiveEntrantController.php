<?php

namespace App\Http\Controllers;

use App\Models\ArchiveEntrant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\pagination\paginator;

class ArchiveEntrantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user=Auth::user();
        $archive_entrants = $user->archiveEntrants()->orderBy('created_at', 'desc')->paginate(5);
        return view('archive_entrants.index',compact('archive_entrants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ArchiveEntrant $archiveEntrant)
    {
        return view('archive_entrants.show',compact('archiveEntrant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ArchiveEntrant $archiveEntrant)
    {
        return view('archive_entrants.edit',compact('archiveEntrant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ArchiveEntrant $archiveEntrant)
    {
        $data=$request->validate([
            'Expediteur'=>'required',
            'CorrespondanceRequiertReponse'=>'required',
            'SujetCorrespondance'=>'required',
            'TelechargementCorrespondance'=>$request->hasFile('TelechargementCorrespondance') ? 'required' : ''
        ],[
            'Expediteur.required' => 'يرجى تقديم معلومات المرسل.',
            'CorrespondanceRequiertReponse.required' => 'يرجى تحديد ما إذا كانت المراسلة تتطلب الرد أم لا.',
            'SujetCorrespondance.required' => 'يرجى تحديد موضوع المراسلة.',
            'TelechargementCorrespondance.required' => 'يرجى تحميل المراسلة.',     
    ]);
        if($request->hasFile('TelechargementCorrespondance')){
            $fileName=Str::random(2).'_'.$request->file('TelechargementCorrespondance')->getClientOriginalName();
            $data['TelechargementCorrespondance']=$request->file('TelechargementCorrespondance')->storeAs('courrierEntrant',$fileName,'public');
        }
        $data['Reference']=$request['Reference'];
        $data['NumeroInscriptionAcademie']=$request['NumeroInscriptionAcademie'];
        $data['DateInscriptionAcademie']=$request['DateInscriptionAcademie'];
        $data['DateEnvoiEntiteExpeditrice']=$request['DateEnvoiEntiteExpeditrice'];
        $data['NumeroEnvoiEntiteExpeditrice']=$request['NumeroEnvoiEntiteExpeditrice'];
        $data['Repondu']=$request['Repondu'];
        $data['DernierDelaiReponse']=$request['DernierDelaiReponse'];
        $data['Statut']=$request['Statut'];
        $data['user_id']=Auth::id();

        $archiveEntrant->update($data);
        return redirect()->route('archive_entrants.index')->with('success','تم تعديل البريد بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ArchiveEntrant $archiveEntrant)
    {
        $archiveEntrant->delete();
        if (request()->header('X-Requested-With') == 'XMLHttpRequest') {
            return response()->json(['message' => 'تم حذف البريد بنجاح.'], 200);
        }
            // Si ce n'est pas une requête AJAX, retournez une redirection avec un message flash
            return redirect()->route('archive_entrants.index')->with('danger', 'تم حذف البريد بنجاح');  
    }
}
