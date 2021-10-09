<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryCredit extends Model
{
    use HasFactory;

    public function credit()
    {
        return $this->belongsTo(Credit::class);
    }
}
