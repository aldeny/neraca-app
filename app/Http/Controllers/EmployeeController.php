<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function EmployeeIndex(){
        $position = Position::all();

        return view('admin.karyawan', compact('position'));
    }
}
