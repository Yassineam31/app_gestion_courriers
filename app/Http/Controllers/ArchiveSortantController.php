<?php

namespace App\Http\Controllers;

use App\Models\ArchiveSortant;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\pagination\paginator;

class ArchiveSortantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $archive_sortants = ArchiveSortant::orderBy('created_at', 'desc')->paginate(5);
        return view('archive_sortants.index',compact('archive_sortants'));
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
    public function show(ArchiveSortant $archiveSortant)
    {
        return view('archive_sortants.show',compact('archiveSortant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ArchiveSortant $archiveSortant)
    {
        return view('archive_sortants.edit',compact('archiveSortant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ArchiveSortant $archiveSortant)
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
        $data['user_id']=5;
        $archiveSortant->update($data);
        return redirect()->route('archive_sortants.index')->with('success','تم تعديل البريد بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ArchiveSortant $archiveSortant)
    {
        $archiveSortant->delete();
        return back()->with('danger','تم حذف البريد بنجاح');
    }
}
