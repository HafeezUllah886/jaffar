<?php

namespace App\Http\Controllers;

use App\Models\salesman;
use Illuminate\Http\Request;

class SalesmanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salesmans = salesman::all();

        return view('salesmans.index', compact('salesmans'));
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
        salesman::create($request->all());

        return back()->with('success', "Salesman Created");
    }

    /**
     * Display the specified resource.
     */
    public function show(salesman $salesman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(salesman $salesman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $man = salesman::find($id);
        $man->update($request->all());

        return back()->with('success', 'Salesman Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(salesman $salesman)
    {
        //
    }
}
