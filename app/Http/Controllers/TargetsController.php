<?php

namespace App\Http\Controllers;

use App\Models\targets;
use App\Http\Controllers\Controller;
use App\Models\accounts;
use App\Models\products;
use App\Models\units;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        try
        {
            DB::beginTransaction();
            $unit = units::find($request->unitID);
            $qty = $request->qty * $unit->value;
            targets::create(
                [
                    'productID'     => $request->productID,
                    'customerID'    => $request->customerID,
                    'qty'           => $qty,
                    'unitID'        => $request->unitID,
                    'startDate'     => $request->startDate,
                    'endDate'       => $request->endDate,
                ]
            );

            DB::commit();
            return back()->with("success", "Target Saved");
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return back()->with("error", $e->getMessage());
        }
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
