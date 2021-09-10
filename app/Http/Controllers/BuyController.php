<?php

namespace App\Http\Controllers;

use App\Models\Buy;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BuyController extends Controller
{
    public function BuyIndex()
    {
        return view('admin.buy');
    }

    public function BuyAdd(Request $request){
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

    public function BuygetData (){
        $data = Buy::orderBy('created_at', 'desc');

        if (request()->ajax()) {
            return datatables()->of($data)
            ->addColumn('nama_item', function($data){
                $dt = $data->nama_item;
                return $dt;
            })
            ->addColumn('jumlah_item', function($data){
                $dt = $data->jumlah_item;
                return $dt;
            })
            ->addColumn('harga_beli', function($data){
                $dt = "Rp. ".number_format($data->harga_beli,0,',','.');
                return $dt;
            })
            ->addColumn('total', function($data){
                $dt = "Rp. ".number_format($data->total,0,',','.');
                return $dt;
            })
            ->addColumn('tanggal', function($data){
                $dt = $data->created_at ? with(new Carbon($data->created_at))->format('d-M-Y') : '';
                return $dt;
            })
            ->addColumn('keterangan', function($data){
                $dt = $data->keterangan;
                return $dt;
            })
            ->addColumn('saldo', function($data){
                if($data->saldo == 1){
                    return 'Kas Bank';
                }
                elseif ($data->saldo == 2) {
                    return 'Kas Besar';
                }
                else {
                    return 'Kas Kecil';
                }
            })
            ->addColumn('aksi', function($data){
                $btn = "<button class='btn btn-danger btn-sm btn-delete' data-id='".$data->id."'><i class='fas fa-trash-alt'></i></button>";
                return $btn;
            })
            ->rawColumns(['tanggal_keluar','dana','sumber_dana','bank_id','jumlah','keterangan','saldo','aksi'])
            ->make(true);
        }

        return view('admin.buy',
            [
                'data'    => $data,
            ]);
    }

    public function deleteIdBuy($id)
    {
        $delete = buy::findOrfail($id);
        $delete->delete();
        return back();
    }
}
