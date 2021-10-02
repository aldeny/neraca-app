<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CreditController extends Controller
{
    public function CreditIndex(){
        return view('admin.credit');
    }

    public function CreditAdd(Request $request){
        /* Validate */
        $request->validate([
            'nama_item' => 'required',
            'tanggal_beli' => 'required',
            'harga' => 'required',
            'jumlah_bayar' => 'required',
            'sisa' => 'required',
        ],
        [
            'nama_item.required' => 'Nama barang tidak boleh kosong',
            'tanggal_beli.required' => 'Tanggal beli tidak boleh kosong',
            'harga.required' => 'Harga beli tidak boleh kosong',
            'jumlah_bayar.required' => 'Jumlah bayar tidak boleh kosong',
            'sisa.required' => 'Sisa bayar pokok tidak boleh kosong',
        ]);

        /* Insert data into database */

        $insert = new Credit;
        $insert -> nama_item = $request -> nama_item;
        $insert -> tanggal_beli = $request -> tanggal_beli;
        $insert -> harga = $request -> harga;
        $insert -> jumlah_bayar = $request -> jumlah_bayar;
        $insert -> ket_bayar = $request -> ket_bayar;
        $insert -> sisa = changeIDRtoNumeric($request -> sisa);
        $save = $insert->save();

        if ($save) {
            return response()->json(['success' => 'Data berhasil di tambahkan', $save]);
        }
        else {
            return response()->json(['error' => 'Data gagal di tambahkan', $save]);
        }
    }

    public function CreditGet(){
        $data = Credit::all();

        if (request()->ajax()) {
            return datatables()->of($data)
            ->addColumn('nama_item', function($data){
                $dt = $data->nama_item;
                return $dt ;
            })
            ->addColumn('tanggal_beli', function($data){
                $dt = $data->tanggal_beli ? with(new Carbon($data->tanggal_beli))->format('d-M-Y') : '';
                return $dt;
            })
            ->addColumn('harga', function($data){
                $dt = "Rp. ".number_format($data->harga,0,',','.');
                return $dt;
            })
            ->addColumn('jumlah_bayar', function($data){
                $dt = "Rp. ".number_format($data->jumlah_bayar,0,',','.');
                return $dt;
            })
            ->addColumn('sisa', function($data){
                $dt = "Rp. ".number_format($data->sisa,0,',','.');
                return $dt;
            })
            ->addColumn('ket_bayar', function($data){
                $dt = $data->ket_bayar;
                return $dt;
            })
            ->addColumn('aksi', function($data){
                $btn = "<div class='dropdown'>
                            <a class='btn btn-info btn-sm dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <i class='fas fa-th-list'></i>
                            </a>

                            <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
                            <a class='dropdown-item btn-gaji' type='button' data-id='".$data->id."'>Bayar gaji</a>
                            <a class='dropdown-item btn-edit' type='button' data-id='".$data->id."'>Edit</a>
                            <a class='dropdown-item btn-delete' type='button' data-id='".$data->id."'>Hapus</a>
                            </div>
                        </div>";

                return $btn;

            })
            ->rawColumns(['nama_item','tanggal_beli','harga','jumlah_bayar','sisa','ket_bayar','aksi'])
            ->make(true);
        }

        return view('admin.credit',
            [
                'data'    => $data,
            ]);
    }
}
