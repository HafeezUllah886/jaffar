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

        $data = [];

        foreach($sales as $sale)
        {
            $customerID = $sale->customerID;
            $customerName = $sale->customer->title;
            $customerCnic = $sale->customer->cnic;
            $customerNtn = $sale->customer->ntn;
            $customerStrn = $sale->customer->strn;
            $gstValue = $sale->details->sum('gstValue');
            $data [] = [
                'id' => $customerID, 
                'name' => $customerName, 
                'cnic' => $customerCnic, 
                'ntn' => $customerNtn, 
                'strn' => $customerStrn, 
                'gst' => $gstValue,
            ];
        }

        $groupedData = [];

    foreach ($data as $entry) {
        $id = $entry['id'];

        if (!isset($groupedData[$id])) {
            $groupedData[$id] = [
                'id' => $id,
                'name' => $entry['name'],
                'cnic' => $entry['cnic'],
                'ntn' => $entry['ntn'],
                'strn' => $entry['strn'],
                'gst' => 0, 
            ];
        }

        $groupedData[$id]['gst'] += $entry['gst'];
    }

    $groupedData = array_values($groupedData);
            return view('reports.salesGst.details', compact('from', 'to', 'groupedData'));
    }
}
