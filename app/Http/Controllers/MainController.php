<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Cash;
use Carbon\Carbon;
use Illuminate\Http\Request;


class MainController extends Controller
{

    public function index()
    {
        return view('admin.index');
    }

    public function getIndexKasBank()
    {
        $count = Cash::all()->sum('jumlah');
        $bank = Bank::all();
        $coun = "Rp. ".number_format($count,2,',','.');
        return view('admin.kas_bank', ['count' => $coun, 'bank' => $bank]);
    }

    public function addData(Request $request)
    {
        // Validate
        $request->validate([
            'tanggal' => 'required',
            'dana' => 'required',
            'sumber_dana' => 'required',
            'bank_id' => 'required',
            'jumlah' => 'required',
            'keterangan' => 'required',
        ]);

        // Insert into database
        $save = new Cash;
        $save -> tanggal = $request -> tanggal;
        $save -> dana = $request -> dana;
        $save -> sumber_dana = $request -> sumber_dana;
        $save -> bank_id = $request -> bank_id;
        $save -> jumlah = changeIDRtoNumeric($request -> jumlah) ;
        $save -> keterangan = $request -> keterangan;
        $data = $save -> save();

        if ($data) {
            return response()->json(['success' => 'Data berhasil ditambahkan']);
        }else{
            return response()->json(['error' => 'Data gagal ditambahkan']);
        }
    }

    /* Data Masuk */
    public function getDataCash()
    {
        $data = Cash::where('dana', '=', 'Masuk')
                    //->orWhere('dana', '=', 'Keluar')
                    ->get();

        if (request()->ajax()) {
            return datatables()->of($data)
            ->addColumn('tanggal', function($data){
                $dt = $data->tanggal ? with(new Carbon($data->tanggal))->format('d-M-Y') : '';
                return $dt;
            })
            ->addColumn('dana', function($data){
                return $data -> dana;
            })
            ->addColumn('sumber_dana', function($data){
                $kas1 = 'Kas Bank';
                $kas2 = 'Kas Besar';
                $kas3 = 'Kas Kecil';
                if ($data->sumber_dana == 1) {
                    return $kas1;
                } elseif ($data->sumber_dana == 2) {
                    return $kas2;
                }else{
                    return $kas3;
                }

            })
            ->addColumn('bank_id', function($data){
                $dt = $data->bank;
                return $dt->nama_bank;
            })
            ->addColumn('jumlah', function($data){
                $dt = "Rp. ".number_format($data->jumlah,2,',','.');
                return $dt;
            })
            ->addColumn('keterangan', function($data){
                $dt = $data->keterangan;
                return $dt;
            })
            ->addColumn('aksi', function($data){
                $btn = "<button class='btn btn-danger btn-sm btn-delete' data-id='".$data->id."'>Delete</button>";
                return $btn;
            })
            ->rawColumns(['tanggal_keluar','dana','sumber_dana','bank_id','jumlah','keterangan','aksi'])
            ->make(true);
        }

        return view('admin.kas_bank',
            [
                'data'    => $data,
            ]);
    }

    /* Data Keluar */
    public function getDataCashOut()
    {
        $data = Cash::where('dana', '=', 'Keluar')
                    ->get();

        if (request()->ajax()) {
            return datatables()->of($data)
            ->addColumn('tanggal', function($data){
                $dt = $data->tanggal ? with(new Carbon($data->tanggal))->format('d-M-Y') : '';
                return $dt;
            })
            ->addColumn('dana', function($data){
                return $data -> dana;
            })
            ->addColumn('sumber_dana', function($data){
                $kas1 = 'Kas Bank';
                $kas2 = 'Kas Besar';
                $kas3 = 'Kas Kecil';
                if ($data->sumber_dana == 1) {
                    return $kas1;
                } elseif ($data->sumber_dana == 2) {
                    return $kas2;
                }else{
                    return $kas3;
                }

            })
            ->addColumn('bank_id', function($data){
                $dt = $data->bank;
                return $dt->nama_bank;
            })
            ->addColumn('jumlah', function($data){
                $dt = "Rp. ".number_format($data->jumlah,2,',','.');
                return $dt;
            })
            ->addColumn('keterangan', function($data){
                $dt = $data->keterangan;
                return $dt;
            })
            ->addColumn('aksi', function($data){
                $btn = "<button class='btn btn-danger btn-sm btn-delete' data-id='".$data->id."'>Delete</button>";
                return $btn;
            })
            ->rawColumns(['tanggal_keluar','dana','sumber_dana','bank_id','jumlah','keterangan','aksi'])
            ->make(true);
        }

        return view('admin.kas_bank',
            [
                'data'    => $data,
            ]);
    }

    public function deleteId($id)
    {
        $delete = Cash::findOrfail($id);
        $delete->delete();
        return back();
    }
}
