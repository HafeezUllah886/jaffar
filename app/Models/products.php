<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function unit()
    {
        return $this->belongsTo(units::class, 'unitID');
    }

    public function ingredient()
    {
        return $this->hasMany(recipe_management::class, 'productID');
    }


}
