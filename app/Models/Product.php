<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Softfile;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'quantity',
        'price',
        'image',
        'category',
        'weight'
    ];

    public function softfile()
    {
        return $this->hasOne(Softfile::class);
    }
}
