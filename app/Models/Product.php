<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Get the user associated with the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function buy()
    {
        return $this->hasOne(Buy::class);
    }

    public function sell()
    {
        return $this->hasOne(Sell::class);
    }
}
