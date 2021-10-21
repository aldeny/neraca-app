<?php

namespace App\Http\Controllers;

use App\Models\Buy;
use App\Models\Product;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BuyController extends Controller
{
    public function BuyIndex()
    {
        $product = Product::all();

        return view('admin.buy', compact('product'));
    }

    public function BuyAdd(Request $request){
        // validate
        $request->validate([
            'nama_item' => 'required',
            'tanggal_beli' => 'required',
            'jumlah_item' => 'required',
            'saldo' => 'required',
            'harga_beli' => 'required',
            'total' => 'required',
            'keterangan' => 'required',
        ],
        [
            'nama_item.required' => 'Nama produk tidak boleh kosong',
            'tanggal_beli.required' => 'Tanggal beli tidak boleh kosong',
            'jumlah_item.required' => 'Jumlah produk tidak boleh kosong',
            'saldo.required' => 'Saldo tidak boleh kosong',
            'harga_beli.required' => 'Harga beli tidak boleh kosong',
            'total.required' => 'Total tidak boleh kosong',
            'keterangan.required' => 'Keterangan produk tidak boleh kosong',
        ]);

        $save = new Buy;
        $save -> product_id = $request -> nama_item;
        $save -> tanggal_beli = $request -> tanggal_beli;
        $save -> jumlah_item = $request -> jumlah_item;
        $save -> saldo = $request -> saldo;
        $save -> harga_beli = $request -> harga_beli;
        $save -> total = $request -> total;
        $save -> keterangan = $request -> keterangan;
        $data = $save -> save();

        $product = Product::findOrFail($request->nama_item);
        $product->qty += $request->jumlah_item;
        $product -> save();

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
                $dt = $data->product->nama_produk;
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
                $dt = $data->tanggal_beli ? with(new Carbon($data->tanggal_beli))->format('d-M-Y') : '';
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
                $btn_act = "<button class='btn btn-danger btn-sm btn-delete' data-jum='".$data->jumlah_item."' data-poduct='".$data->product_id."' data-id='".$data->id."'><i class='fas fa-trash-alt'></i></button>";

                $btn_dis= "<button class='btn btn-danger btn-sm disabled'><i class='fas fa-trash-alt'></i></button>";

                $dt_awal = new DateTime(now());
                $dt_akhir = new DateTime($data->created_at);
                $selisih = $dt_awal->diff($dt_akhir);

                if ($selisih->days >= 1) {
                    return $btn_dis;
                }
                return $btn_act;
            })
            ->rawColumns(['tanggal_keluar','dana','sumber_dana','bank_id','jumlah','keterangan','saldo','aksi'])
            ->make(true);
        }

        return view('admin.buy',
            [
                'data'    => $data,
            ]);
    }

    public function deleteIdBuy(Request $request)
    {
        $product = Product::findOrFail($request->poduct);
        $product->qty -= $request->jum;
        $product -> save();

        $delete = Buy::findOrfail($request->id);
        $delete->delete();

        if ($delete) {
            return response()->json(['success'=>'Data berhasil dihapus']);
        } else {
            return response()->json(['error'=>'Data gagal dihapus']);

        }

    }

    public function PrintBuy($from_date, $to_date){

        $buy = Buy::whereBetween('tanggal_beli',[$from_date, $to_date])->latest()->get();
        $sum = $buy->sum('total');

        $today = Carbon::now()->isoFormat('D MMMM Y');

        return view('extend.print_Buy', compact('buy', 'today', 'sum'));
    }
}
