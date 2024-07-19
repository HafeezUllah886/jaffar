<?php

namespace App\Http\Controllers;

use App\Models\material;
use App\Models\raw_units;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $units = raw_units::all();
        $items = material::all();

        return view('raw_material.material', compact('units', 'items'));
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
        material::create($request->only('name', 'unitID', 'price'));
        return back()->with('success', "Raw Material Created");
    }

    /**
     * Display the specified resource.
     */
    public function show(material $material)
    {
        return "This is show";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(material $material)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $material= material::find($id);
        $material->update($request->only('name', 'unitID', 'price'));
        return back()->with('success', "Raw Material Updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(material $material)
    {
        //
    }
}
