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
        $courrier_sortants=CourrierSortant::orderBy('created_at')->paginate(5);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourrierSortant $courrierSortant)
    {
        $courrierSortant->delete();
        return back()->with('danger','Le courrier est supprimé avec succés.');
    }
}
