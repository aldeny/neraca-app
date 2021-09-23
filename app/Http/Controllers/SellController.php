<?php

namespace App\Http\Controllers;

use App\Models\Buy;
use Illuminate\Http\Request;

class SellController extends Controller
{
    public function SellIndex(){
        $buy = Buy::all();

        return view('admin.sell', ['buy' => $buy]);
    }
}
