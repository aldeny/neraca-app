<?php

namespace App\Http\Controllers;

use App\Models\Sell;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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
            'keterangan' => 'required',
        ]);

        $save = new Sell;
        $save -> product_id = $request -> nama_barang;
        $save -> jumlah_item = $request -> jumlah_item;
        $save -> harga_jual = $request -> harga_jual;
        $save -> total = $request -> total;
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
                $dt = $data->created_at ? with(new Carbon($data->created_at))->format('d-M-Y') : '';
                return $dt;
            })
            ->addColumn('keterangan', function($data){
                $dt = $data->keterangan;
                return $dt;
            })
            ->addColumn('aksi', function($data){
            $btn = "<button class='btn btn-danger btn-sm btn-delete' data-id='".$data->id."'><i class='fas fa-trash-alt'></i></button>";

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

    public function getAutoLoad($item){

        $autoload = Product::findOrfail($item);
        return response()->json($autoload);
    }

    // public function deleteIdBuy($id)
    // {
    //     $delete = Buy::findOrfail($id);
    //     $delete->delete();

    //     return back();
    // }
}
