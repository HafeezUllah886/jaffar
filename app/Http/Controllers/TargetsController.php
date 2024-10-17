<?php

namespace App\Http\Controllers;

use App\Models\targets;
use App\Http\Controllers\Controller;
use App\Models\accounts;
use App\Models\products;
use App\Models\units;
use Illuminate\Http\Request;

class TargetsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = accounts::Customer()->get();
        $products = products::all();
        $units = units::all();
        $targets = targets::orderBy("endDate", 'desc')->get();
        return view('target.index', compact('customers', 'products', 'units', 'targets'));
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
    public function show(targets $targets)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(targets $targets)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, targets $targets)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(targets $targets)
    {
        //
    }
}
