<?php

namespace App\Http\Controllers;

use App\Models\CourrierSortant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\pagination\paginator;

class CourrierSortantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user=Auth::user();
        $courrier_sortants=$user->courrierSortants()->orderBy('created_at','desc')->paginate(5);
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
        if($request->hasFile('TelechargementCorrespondance')){
            $fileName=Str::random(2).'_'.$request->file('TelechargementCorrespondance')->getClientOriginalName();
            $data['TelechargementCorrespondance']=$request->file('TelechargementCorrespondance')->storeAs('courrierSortant',$fileName,'public');
        }
        $data['Reference']=$request['Reference'];
        $data['NumeroEnvoiAcademie']=$request['NumeroEnvoiAcademie'];
        $data['DateEnvoiAcademie']=$request['DateEnvoiAcademie'];
        $data['DernierDelaiReceptionReponse']=$request['DernierDelaiReceptionReponse'];
        $data['ReponseRecue']=$request['ReponseRecue'];
        $data['Statut']=$request['Statut'];
        $data['user_id']=Auth::id();
        $post=CourrierSortant::create($data);
        return redirect()->route('courrier_sortants.index')->with('succes','تمت إضافة البريد بنجاح');
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
            'TelechargementCorrespondance'=>$request->hasFile('TelechargementCorrespondance') ? 'required' : ''
        ],[
            'Destinataire.required' => ' يرجى تقديم معلومات المرسل إليه.',
            'CorrespondanceRequiertReponse.required' =>'يرجى تحديد ما إذا كانت المراسلة تتطلب الرد أم لا.',
            'ObjetCorrespondance.required' => 'يرجى تحديد موضوع المراسلة.',
            'TelechargementCorrespondance.required' => 'يرجى تحميل المراسلة.',     
        ]);
        if($request->hasFile('TelechargementCorrespondance')){
            $fileName=Str::random(2).'_'.$request->file('TelechargementCorrespondance')->getClientOriginalName();
            $data['TelechargementCorrespondance']=$request->file('TelechargementCorrespondance')->storeAs('courrierSortant',$fileName,'public');
        }
        $data['Reference']=$request['Reference'];
        $data['NumeroEnvoiAcademie']=$request['NumeroEnvoiAcademie'];
        $data['DateEnvoiAcademie']=$request['DateEnvoiAcademie'];
        $data['DernierDelaiReceptionReponse']=$request['DernierDelaiReceptionReponse'];
        $data['ReponseRecue']=$request['ReponseRecue'];
        $data['Statut']=$request['Statut'];
        $data['user_id']=Auth::id();
        $courrierSortant->update($data);
        return redirect()->route('courrier_sortants.index')->with('success','تم تعديل البريد بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourrierSortant $courrierSortant)
    {
        $courrierSortant->delete();
         // Vérifier si la requête est AJAX
         if (request()->header('X-Requested-With') == 'XMLHttpRequest') {
            return response()->json(['message' => 'تم حذف البريد بنجاح.'], 200);
        }
            // Si ce n'est pas une requête AJAX, retournez une redirection avec un message flash
            return redirect()->route('courrier_sortants.index')->with('danger', 'تم حذف البريد بنجاح');
    }
}
