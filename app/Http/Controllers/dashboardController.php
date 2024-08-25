<?php

namespace App\Http\Controllers;

use App\Models\accounts;
use App\Models\purchase;
use App\Models\purchase_details;
use App\Models\sale_details;
use App\Models\sales;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }
}
