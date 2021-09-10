<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Buy;
use App\Models\Cash;
use Carbon\Carbon;
use Illuminate\Http\Request;


class MainController extends Controller
{

    public function index()
    {
        $bank = Cash::where('sumber_dana', '=', 'Kas Bank')->sum('jumlah');
        $buy = Buy::where('saldo', '=', 1)->sum('total');
        $result = $bank-$buy;
        $coun_bank = "Rp. ".number_format($result,0,',','.');

        $kas_besar = Cash::where('sumber_dana', '=', 'Kas Besar')->sum('jumlah');
        $buy_besar = Buy::where('saldo', '=', 2)->sum('total');
        $result_besar = $kas_besar - $buy_besar;
        $coun_besar = "Rp. ".number_format($result_besar,0,',','.');

        $kas_kecil = Cash::where('sumber_dana', '=', 'Kas Kecil')->sum('jumlah');
        $buy_kecil = Buy::where('saldo', '=', 3)->sum('total');
        $result_kecil = $kas_kecil - $buy_kecil;
        $coun_kecil = "Rp. ".number_format($result_kecil,0,',','.');

        $saldo_buy = Buy::all()->sum('total');
        $saldo_buy_ = "Rp. ".number_format($saldo_buy,0,',','.');

        $total_saldo = $result + $kas_besar + $result_kecil;
        $coun = "Rp. ".number_format($total_saldo,0,',','.');

        return view('admin.index', ['count_bank' => $coun_bank, 'count' => $coun, 'count_besar' => $coun_besar, 'count_kecil' => $coun_kecil, 'saldo_buy_' => $saldo_buy_]);
    }

    public function getIndexKasBank()
    {
        $count = Cash::where('sumber_dana', '=', 'Kas Bank')->sum('jumlah');
        $bank = Bank::all();
        $coun = "Rp. ".number_format($count,0,',','.');
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
        $data = Cash::Where('sumber_dana', '=', 'Kas Bank')
                    ->get();

        //$data = Cash::all();

        if (request()->ajax()) {
            return datatables()->of($data)
            ->addColumn('tanggal', function($data){
                $dt = $data->tanggal ? with(new Carbon($data->tanggal))->format('d-M-Y') : '';
                return $dt;
            })
            ->addColumn('dana', function($data){
                $sd = "<small class='badge badge-success'>".$data->dana."</small>";
                return $sd;
            })
            ->addColumn('sumber_dana', function($data){
                $sd = $data->sumber_dana;
                return $sd;
            })
            ->addColumn('bank_id', function($data){
                $dt = $data->bank;
                return $dt->nama_bank;
            })
            ->addColumn('jumlah', function($data){
                $dt = "Rp. ".number_format($data->jumlah,0,',','.');
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

    /* Kas Besar */
    public function getIndexKasBesar(){
        $count = Cash::where('sumber_dana', '=', 'Kas Besar')->sum('jumlah');
        $bank = Bank::all();
        $coun = "Rp. ".number_format($count,0,',','.');
        return view('admin.kas_besar', ['count' => $coun, 'bank' => $bank]);
    }

    public function getDataKasBesar()
    {
        $data = Cash::Where('sumber_dana', '=', 'Kas Besar')
                    ->get();

        //$data = Cash::all();

        if (request()->ajax()) {
            return datatables()->of($data)
            ->addColumn('tanggal', function($data){
                $dt = $data->tanggal ? with(new Carbon($data->tanggal))->format('d-M-Y') : '';
                return $dt;
            })
            ->addColumn('dana', function($data){
                $sd = "<small class='badge badge-success'>".$data->dana."</small>";
                return $sd;
            })
            ->addColumn('sumber_dana', function($data){
                $sd = $data->sumber_dana;
                return $sd;
            })
            ->addColumn('bank_id', function($data){
                $dt = $data->bank;
                return $dt->nama_bank;
            })
            ->addColumn('jumlah', function($data){
                $dt = "Rp. ".number_format($data->jumlah,0,',','.');
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

    /* Kas Kecil */
    /* Kas Besar */
    public function getIndexKasKecil(){
        $count = Cash::where('sumber_dana', '=', 'Kas Kecil')->sum('jumlah');
        $bank = Bank::all();
        $coun = "Rp. ".number_format($count,0,',','.');
        return view('admin.kas_kecil', ['count' => $coun, 'bank' => $bank]);
    }

    public function getDataKasKecil()
    {
        $data = Cash::Where('sumber_dana', '=', 'Kas Kecil')
                    ->get();

        //$data = Cash::all();

        if (request()->ajax()) {
            return datatables()->of($data)
            ->addColumn('tanggal', function($data){
                $dt = $data->tanggal ? with(new Carbon($data->tanggal))->format('d-M-Y') : '';
                return $dt;
            })
            ->addColumn('dana', function($data){
                $sd = "<small class='badge badge-success'>".$data->dana."</small>";
                return $sd;
            })
            ->addColumn('sumber_dana', function($data){
                $sd = $data->sumber_dana;
                return $sd;
            })
            ->addColumn('bank_id', function($data){
                $dt = $data->bank;
                return $dt->nama_bank;
            })
            ->addColumn('jumlah', function($data){
                $dt = "Rp. ".number_format($data->jumlah,0,',','.');
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
}
