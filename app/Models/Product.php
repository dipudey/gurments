<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function rejectProducts()
    {
        return $this->hasMany(RejectProduct::class);
    }

    public function delivers()
    {
        return $this->hasMany(Delivery::class);
    }
}
