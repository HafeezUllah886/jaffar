<?php

use App\Models\material_stock;
use App\Models\stock;
use Carbon\Carbon;

function firstDayOfMonth()
{
    $startOfMonth = Carbon::now()->startOfMonth();

    return $startOfMonth->format('Y-m-d');
}
function lastDayOfMonth()
{

    $endOfMonth = Carbon::now()->endOfMonth();

    return $endOfMonth->format('Y-m-d');
}

function createMaterialStock($id, $cr, $db, $date, $notes, $ref)
{
    material_stock::create(
        [
            'productID' => $id,
            'cr'        => $cr,
            'db'        => $db,
            'date'      => $date,
            'notes'     => $notes,
            'refID'     => $ref
        ]
    );
}

function getMaterialStock($id){
    $stocks  = material_stock::where('productID', $id)->get();
    $balance = 0;
    foreach($stocks as $stock)
    {
        $balance += $stock->cr;
        $balance -= $stock->db;
    }

    return $balance;
}

function createStock($id, $cr, $db, $date, $notes, $batch, $ref)
{
    stock::create(
        [
            'productID'     => $id,
            'cr'            => $cr,
            'db'            => $db,
            'date'          => $date,
            'notes'         => $notes,
            'batchNumber'   => $batch,
            'refID'         => $ref
        ]
    );
}

function getStock($id){
    $stocks  = stock::where('productID', $id)->get();
    $balance = 0;
    foreach($stocks as $stock)
    {
        $balance += $stock->cr;
        $balance -= $stock->db;
    }

    return $balance;
}

