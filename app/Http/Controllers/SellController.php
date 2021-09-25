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

    public function SellAdd(Request $request){
        // validate
        $request->validate([
            'nama_item' => 'required',
            'jumlah_item' => 'required',
            'saldo' => 'required',
            'harga_beli' => 'required',
            'total' => 'required',
            'keterangan' => 'required',
        ]);

        $save = new Buy;
        $save -> nama_item = $request -> nama_item;
        $save -> jumlah_item = $request -> jumlah_item;
        $save -> saldo = $request -> saldo;
        $save -> harga_beli = $request -> harga_beli;
        $save -> total = $request -> total;
        $save -> keterangan = $request -> keterangan;
        $data = $save -> save();

        if ($data){
            return response()->json(['success' => 'Data berhasil ditambahkan']);
        }
        else{
            return response()->json(['error' => 'Data gagal ditambahkan']);
        }
    }
}
