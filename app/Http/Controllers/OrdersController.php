<?php

namespace App\Http\Controllers;

use App\Models\accounts;
use App\Models\orders;
use App\Models\products;
use App\Models\units;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth()->user()->role == "Admin")
        {
            $orders = orders::orderBy('id', 'desc')->get();
        }
        else
        {
            $orders = orders::where('orderbookerID', auth()->user()->id)->orderBy('id', 'desc')->get();
        }

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = products::all();
        $customers = accounts::Customer()->get();
        $units = units::all();
        return view('orders.create', compact('products', 'customers', 'units'));
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
    public function show(orders $orders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, orders $orders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(orders $orders)
    {
        //
    }
}
