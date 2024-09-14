<?php

namespace App\Http\Controllers\reports;

use App\Http\Controllers\Controller;
use App\Models\sales;
use Illuminate\Http\Request;

class salesGstReportController extends Controller
{
    public function index()
    {
        return view('reports.salesGst.index');
    }

    public function data($from, $to)
    {
        $sales = sales::with('customer', 'details')->whereBetween('date', [$from, $to])->get();

        return view('reports.salesGst.details', compact('from', 'to', 'sales'));
    }
}
