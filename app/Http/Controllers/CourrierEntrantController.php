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
        $courrier_entrants=CourrierEntrant::orderBy('created_at')->paginate(5);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourrierEntrant $courrierEntrant)
    {
        //
    }
}
