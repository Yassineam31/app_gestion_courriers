<?php

namespace App\Http\Controllers;

use App\Models\CourrierEntrant;
use Illuminate\Http\Request;
use Illuminate\pagination\paginator;

class CourrierEntrantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courrier_entrants=CourrierEntrant::orderBy('created_at','desc')->paginate(5);
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
            $data['Reference']=$request['Reference'];
            $data['NumeroInscriptionAcademie']=$request['NumeroInscriptionAcademie'];
            $data['DateInscriptionAcademie']=$request['DateInscriptionAcademie'];
            $data['DateEnvoiEntiteExpeditrice']=$request['DateEnvoiEntiteExpeditrice'];
            $data['NumeroEnvoiEntiteExpeditrice']=$request['NumeroEnvoiEntiteExpeditrice'];
            $data['Repondu']=$request['Repondu'];
            $data['DernierDelaiReponse']=$request['DernierDelaiReponse'];
            $data['Statut']=$request['Statut'];
            $data['user_id']=5;

        $post=CourrierEntrant::create($data);
        return redirect()->route('courrier_entrants.index')->with('success','تمت إظافة البريد بنجاح');
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
            'TelechargementCorrespondance'=>'required'
        ],[
            'Expediteur.required' => 'يرجى تقديم معلومات المرسل.',
            'CorrespondanceRequiertReponse.required' => 'يرجى تحديد ما إذا كانت المراسلة تتطلب الرد أم لا.',
            'SujetCorrespondance.required' => 'يرجى تحديد موضوع المراسلة.',
            'TelechargementCorrespondance.required' => 'يرجى تحميل المراسلة.',     
    ]);
        $data['Reference']=$request['Reference'];
        $data['NumeroInscriptionAcademie']=$request['NumeroInscriptionAcademie'];
        $data['DateInscriptionAcademie']=$request['DateInscriptionAcademie'];
        $data['DateEnvoiEntiteExpeditrice']=$request['DateEnvoiEntiteExpeditrice'];
        $data['NumeroEnvoiEntiteExpeditrice']=$request['NumeroEnvoiEntiteExpeditrice'];
        $data['Repondu']=$request['Repondu'];
        $data['DernierDelaiReponse']=$request['DernierDelaiReponse'];
        $data['Statut']=$request['Statut'];
        $data['user_id']=5;

        $courrierEntrant->update($data);
        return redirect()->route('courrier_entrants.index')->with('success','تم تعديل البريد بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourrierEntrant $courrierEntrant)
    {
        $courrierEntrant->delete();
        return back()->with('danger','Le courrier est supprimé avec succés.');
    }
}
