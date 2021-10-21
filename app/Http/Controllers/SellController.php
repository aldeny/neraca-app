<?php

namespace App\Http\Controllers;

use App\Models\Sell;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use DateTime;

class SellController extends Controller
{
    public function SellIndex(){
        $product = Product::all();

        return view('admin.sell', compact('product'));
    }

    public function SellAddData(Request $request){
        // validate
        $request->validate([
            'nama_barang' => 'required',
            'jumlah_item' => 'required',
            'harga_jual' => 'required',
            'total' => 'required',
            'tanggal_jual' => 'required',
            'keterangan' => 'required',
        ],
        [
            'nama_barang.required' => 'Nama barang tidak boleh kosong',
            'jumlah_item.required' => 'Jumlah barang tidak boleh kosong',
            'harga_jual.required' => 'Harga jual tidak boleh kosong',
            'total.required' => 'required',
            'tanggal_jual.required' => 'Tanggal jual tidak boleh kosong',
            'keterangan.required' => 'Keterangan tidak boleh kosong',
        ]);

        $save = new Sell;
        $save -> product_id = $request -> nama_barang;
        $save -> jumlah_item = $request -> jumlah_item;
        $save -> harga_jual = $request -> harga_jual;
        $save -> total = $request -> total;
        $save -> tanggal_jual = $request -> tanggal_jual;
        $save -> keterangan = $request -> keterangan;
        $data = $save -> save();

        $product = Product::findOrFail($request->nama_barang);
        $product->qty -= $request->jumlah_item;
        $product -> save();

        if ($data){
            return response()->json(['success' => 'Data berhasil ditambahkan']);
        }
        else{
            return response()->json(['error' => 'Data gagal ditambahkan']);
        }
    }

    public function SellgetData (){
        $data = Sell::orderBy('created_at', 'desc');

        if (request()->ajax()) {
            return datatables()->of($data)
            ->addColumn('nama_barang', function($data){
                $dt = $data->product->nama_produk;
                return $dt;
            })
            ->addColumn('jumlah_item', function($data){
                $dt = $data->jumlah_item;
                return $dt;
            })
            ->addColumn('harga_jual', function($data){
                $dt = "Rp. ".number_format($data->harga_jual,0,',','.');
                return $dt;
            })
            ->addColumn('total', function($data){
                $dt = "Rp. ".number_format($data->total,0,',','.');
                return $dt;
            })
            ->addColumn('tanggal', function($data){
                $dt = $data->tanggal_jual ? with(new Carbon($data->tanggal_jual))->format('d-M-Y') : '';
                return $dt;
            })
            ->addColumn('keterangan', function($data){
                $dt = $data->keterangan;
                return $dt;
            })
            ->addColumn('aksi', function($data){
            $btn = "<button class='btn btn-danger btn-sm btn-delete' data-product='".$data->product_id."' data-jumlah='".$data->jumlah_item."' data-id='".$data->id."'><i class='fas fa-trash-alt'></i></button>";

            $btn_dis= "<button class='btn btn-danger btn-sm disabled'><i class='fas fa-trash-alt'></i></button>";


            $dt_awal = new DateTime(now());
            $dt_akhir = new DateTime($data->created_at);
            $selisih = $dt_awal->diff($dt_akhir);

            if ($selisih->days >= 1) {
                return $btn_dis;
            }
                return $btn;
            })
            ->rawColumns(['nama_barang','jumlah_item','harga_jual','total','tanggal','keterangan','aksi'])
            ->make(true);
        }

        return view('admin.sell',
            [
                'data'    => $data,
            ]);
    }

    public function deleteIdSell(Request $request)
    {
        $product = Product::findOrFail($request->product);
        $product->qty += $request->jumlah;
        $product -> save();

        $delete = Sell::findOrfail($request->id);
        $delete->delete();

        if ($delete) {
            return response()->json(['success'=>'Data berhasil dihapus']);
        } else {
            return response()->json(['error'=>'Data gagal dihapus']);

        }
    }

    public function getAutoLoad($item){

        $autoload = Product::findOrfail($item);
        return response()->json($autoload);
    }

    public function PrintSell($from_date, $to_date){

        $sell = Sell::whereBetween('tanggal_jual',[$from_date, $to_date])->latest()->get();
        $sum = $sell->sum('total');

        $today = Carbon::now()->isoFormat('D MMMM Y');

        return view('extend.print_Sell', compact('sell', 'today', 'sum'));
    }
}
