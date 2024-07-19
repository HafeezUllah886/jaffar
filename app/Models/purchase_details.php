<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class purchase_details extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(material::class, 'productID');
    }

    public function unit()
    {
        return $this->belongsTo(raw_units::class, 'unitID');
    }
    
}
