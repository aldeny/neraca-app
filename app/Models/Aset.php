<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    use HasFactory;

    protected $fillable = ['nama_barang','jumlah','harga','total','kondisi','image_aset','created_at','updated_at'];
}
