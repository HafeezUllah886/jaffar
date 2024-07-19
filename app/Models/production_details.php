<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class production_details extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function material()
    {
        return $this->belongsTo(material::class, 'materialID');
    }

    public function unit()
    {
        return $this->belongsTo(raw_units::class, 'raw_unitID');
    }

}
