<?php

namespace App\Http\Controllers;

use App\Models\CourrierSortant;
use Illuminate\Http\Request;
use Illuminate\pagination\paginator;

class CourrierSortantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courrier_sortants=CourrierSortant::orderBy('created_at','desc')->paginate(5);
        return view('courrier_sortants.index',compact('courrier_sortants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('courrier_sortants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $data=$request->validate([
                'Destinataire'=>'required',
                'CorrespondanceRequiertReponse'=>'required',
                'ObjetCorrespondance'=>'required',
                'TelechargementCorrespondance'=>'required'
            ],[
                'Destinataire.required' => ' يرجى تقديم معلومات المرسل إليه.',
                'CorrespondanceRequiertReponse.required' =>'يرجى تحديد ما إذا كانت المراسلة تتطلب الرد أم لا.',
                'ObjetCorrespondance.required' => 'يرجى تحديد موضوع المراسلة.',
                'TelechargementCorrespondance.required' => 'يرجى تحميل المراسلة.',     
        ]);
        $data['Reference']=$request['Reference'];
        $data['NumeroEnvoiAcademie']=$request['NumeroEnvoiAcademie'];
        $data['DateEnvoiAcademie']=$request['DateEnvoiAcademie'];
        $data['DernierDelaiReceptionReponse']=$request['DernierDelaiReceptionReponse'];
        $data['ReponseRecue']=$request['ReponseRecue'];
        $data['Statut']=$request['Statut'];
        $data['user_id']=5;
        $post=CourrierSortant::create($data);
        return redirect()->route('courrier_sortants.index')->with('success','تمت إضافة البريد بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(CourrierSortant $courrierSortant)
    {
        return view('courrier_sortants.show',compact('courrierSortant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourrierSortant $courrierSortant)
    {
        return view('courrier_sortants.edit',compact('courrierSortant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CourrierSortant $courrierSortant)
    {
        $data=$request->validate([
            'Destinataire'=>'required',
            'CorrespondanceRequiertReponse'=>'required',
            'ObjetCorrespondance'=>'required',
            'TelechargementCorrespondance'=>'required'
        ],[
            'Destinataire.required' => ' يرجى تقديم معلومات المرسل إليه.',
            'CorrespondanceRequiertReponse.required' =>'يرجى تحديد ما إذا كانت المراسلة تتطلب الرد أم لا.',
            'ObjetCorrespondance.required' => 'يرجى تحديد موضوع المراسلة.',
            'TelechargementCorrespondance.required' => 'يرجى تحميل المراسلة.',     
        ]);
        $data['Reference']=$request['Reference'];
        $data['NumeroEnvoiAcademie']=$request['NumeroEnvoiAcademie'];
        $data['DateEnvoiAcademie']=$request['DateEnvoiAcademie'];
        $data['DernierDelaiReceptionReponse']=$request['DernierDelaiReceptionReponse'];
        $data['ReponseRecue']=$request['ReponseRecue'];
        $data['Statut']=$request['Statut'];
        $data['user_id']=5;
        $courrierSortant->update($data);
        return redirect()->route('courrier_sortants.index')->with('success','تم تعديل البريد بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourrierSortant $courrierSortant)
    {
        $courrierSortant->delete();
        return back()->with('danger','تمت إزالة البريد بنجاح');
    }
}
