<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function EmployeeIndex(){
    
        return view('admin.karyawan');
    }
}
