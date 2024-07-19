<?php

namespace App\Http\Controllers;

use App\Models\raw_units;
use Illuminate\Http\Request;

class RawUnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $units = raw_units::all();
        return view('raw_material.units', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return "This is Create";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        raw_units::create($request->only('name', 'value'));
        return back()->with('success', 'Unit Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(raw_units $raw_units)
    {
        return "This is Show";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(raw_units $raw_units)
    {
        return "This is Edit";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $raw_unit = raw_units::find($id);
        $raw_unit->update($request->only('name', 'value'));
        return back()->with('success', 'Unit Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(raw_units $raw_units)
    {
        return "This is Create";
    }
}
