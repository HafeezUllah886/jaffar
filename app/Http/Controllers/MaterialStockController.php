<?php

namespace App\Http\Controllers;

use App\Models\material;
use App\Models\material_stock;
use App\Models\raw_units;
use Illuminate\Http\Request;

class MaterialStockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = material::all();
        $units = raw_units::all();
        return view('material_stock.index', compact('products', 'units'));
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
    public function show($id, $unitID, $from, $to)
    {
        $product = material::find($id);

        $stocks = material_stock::where('productID', $id)->whereBetween('date', [$from, $to])->get();

        $pre_cr = material_stock::where('productID', $id)->whereDate('date', '<', $from)->sum('cr');
        $pre_db = material_stock::where('productID', $id)->whereDate('date', '<', $from)->sum('db');
        $pre_balance = $pre_cr - $pre_db;

        $cur_cr = material_stock::where('productID', $id)->sum('cr');
        $cur_db = material_stock::where('productID', $id)->sum('db');
        
        $cur_balance = $cur_cr - $cur_db;

        $unit = raw_units::find($unitID);
        return view('material_stock.details', compact('product', 'pre_balance', 'cur_balance', 'stocks', 'unit', 'from', 'to'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(material_stock $material_stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, material_stock $material_stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(material_stock $material_stock)
    {
        //
    }
}
