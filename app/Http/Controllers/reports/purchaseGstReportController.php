<?php

namespace App\Http\Controllers\reports;

use App\Http\Controllers\Controller;
use App\Models\purchase;
use Illuminate\Http\Request;

class purchaseGstReportController extends Controller
{
    public function index()
    {
        return view('reports.purchaseGst.index');
    }

    public function data($from, $to)
    {
        $purchases = purchase::with('vendor', 'details')->whereBetween('date', [$from, $to])->get();

        $data = [];

        foreach($purchases as $purchase)
        {
            $vendorID = $purchase->vendorID;
            $vendorName = $purchase->vendor->title;
            $gstValue = $purchase->details->sum('gstValue');
            $data [] = [
                'id' => $vendorID,
                'name' => $vendorName,
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
                'gst' => 0,
            ];
        }

        $groupedData[$id]['gst'] += $entry['gst'];
    }

    $groupedData = array_values($groupedData);
            return view('reports.purchaseGst.details', compact('from', 'to', 'groupedData'));
    }
}
