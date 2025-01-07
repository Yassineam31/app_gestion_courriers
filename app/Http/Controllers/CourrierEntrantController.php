<?php

namespace App\Http\Controllers;

use App\Models\CourrierEntrant;
use App\Events\NewCourrierAddedEvent;
use App\Events\UpdateCourrierAddedEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\pagination\paginator;

class CourrierEntrantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user=Auth::user();
        $courrier_entrants=$user->courrierEntrants()->orderBy('created_at','desc')->paginate(5);
        return view('courrier_entrants.index',compact('courrier_entrants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('courrier_entrants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
                'Expediteur'=>'required',
                'CorrespondanceRequiertReponse'=>'required',
                'SujetCorrespondance'=>'required',
                'TelechargementCorrespondance'=>'required'
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
        
        $courrier=CourrierEntrant::create($data);
        $user=Auth::user();
        if(in_array($user->poste, ['مدير', 'رئيس القسم', 'كاتب عام', 'مسؤول مكتب الضبط'])){
            event(new NewCourrierAddedEvent($courrier)); 
        }
        
        return redirect()->route('courrier_entrants.index')->with('succes','تمت إظافة البريد بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(CourrierEntrant $courrierEntrant)
    {
        return view('courrier_entrants.show',compact('courrierEntrant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourrierEntrant $courrierEntrant)
    {
        return view('courrier_entrants.edit',compact('courrierEntrant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CourrierEntrant $courrierEntrant)
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

        $courrierEntrant->update($data);
        $courrier = $courrierEntrant->fresh(); // Recharge les données mises à jour du modèle depuis la base de données
        $user=Auth::user();
        if(in_array($user->poste, ['مدير', 'رئيس القسم', 'كاتب عام', 'مسؤول مكتب الضبط'])){
            event(new UpdateCourrierAddedEvent($courrier)); 
        }
        return redirect()->route('courrier_entrants.index')->with('success','تم تعديل البريد بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourrierEntrant $courrierEntrant){
        $courrierEntrant->delete();
        // Vérifier si la requête est AJAX
        if (request()->header('X-Requested-With') == 'XMLHttpRequest') {
            return response()->json(['message' => 'تم حذف البريد بنجاح.'], 200);
        }
            // Si ce n'est pas une requête AJAX, retournez une redirection avec un message flash
            return redirect()->route('courrier_entrants.index')->with('danger', 'تم حذف البريد بنجاح');  
    }
}
