<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class targets extends Model
{
    use HasFactory;
    public function product()
    {
        return $this->belongsTo(products::class, 'productID');
    }

    public function unit()
    {
        return $this->belongsTo(units::class, 'unitID');
    }

    public function customer()
    {
        return $this->belongsTo(accounts::class, 'customerID');
    }
}
