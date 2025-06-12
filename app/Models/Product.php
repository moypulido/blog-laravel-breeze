<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'price_hearts', 'stock'];

    public function badge()
    {
        return $this->belongsTo(Badge::class);
    }

}
