<?php

use App\Models\accounts;
use App\Models\purchase;
use App\Models\purchase_details;
use App\Models\sale_details;

function totalSales()
{
    return $sales = sale_details::sum('ti');
}

function totalPurchases()
{
   return purchase::sum('net');
}

function totalSaleGst()
{
    return sale_details::sum('gstValue');
}

function totalPurchaseGst()
{
    return purchase_details::sum('gstValue');
}

function myBalance()
{
    $accounts = accounts::business()->get();
    $balance = 0;
    foreach($accounts as $account)
    {
        $cr = $account->transactions->sum('cr');
        $db = $account->transactions->sum('db');

        $balance += $cr - $db;
    }

    return $balance;
}
