<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $fillable = ['jabatan'];

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
