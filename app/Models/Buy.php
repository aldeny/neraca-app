<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Buy extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'jumlah_item',
        'saldo',
        'harga_beli',
        'total',
        'keterangan',
        'created_at',
        'updated_at'
    ];

    /**
     * Get the user that owns the Buy
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
