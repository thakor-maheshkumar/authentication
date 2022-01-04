<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $guarded=['reviews'];

    public function stores()
    {
        return $this->belongsTo('\App\Models\Store','store_id','id');
    }
}
