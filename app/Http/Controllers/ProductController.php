<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function ProductIndex(){
        return view('admin.product');
    }

    public function ProductAdd(Request $request){
        $request->validate([
            'nama_produk' => 'required|unique:products',
        ]);

        $save = new Product;
        $save -> nama_produk = $request -> nama_produk;
        $data = $save -> save();


        if ($data){
            return response()->json(['success' => 'Data berhasil ditambahkan']);
        }
        else{
            return response()->json(['error' => 'Data gagal ditambahkan']);
        }
    }

    public function getDataProduct(){
        $data = Product::latest()->get();

        if (request()->ajax()) {
            return datatables()->of($data)
            ->addColumn('nama_produk', function($data){
                return $data->nama_produk;
            })
            ->addColumn('qty', function($data){
                $span = "<small class='badge badge-warning'>Kosong</small>";
                if ($data->qty == null) {
                    return $span;
                }
                return $data->qty;
            })
            ->addColumn('aksi', function($data){
                $btn = "<button class='btn btn-sm btn-outline-info btn-edit' data-id='".$data->id."'><i class='fas fa-edit'></i></button>";
                $btn .= "<button class='btn btn-sm btn-outline-danger btn-delete' data-id='".$data->id."'><i class='fas fa-trash'></i></button>";
                return $btn;
            })
            ->rawColumns(['nama_produk','qty','aksi'])
            ->make(true);
        }

        return view('admin.product',
            [
                'data'    => $data,
            ]);
    }

    public function getIdProduct($id){
        $product = Product::find($id);
        return response()->json(['product' => $product]);
    }

    public function updateProduct(Request $request){
        $id_product = $request->id;
        $update = Product::find($id_product);
        $update -> nama_produk = $request -> nama_produk;
        $update -> qty = $request -> jumlah_produk;
        $update -> save();

        return response()->json(['success' => 'Data berhasil di update']);
    }

    public function deleteIdProduct($id)
    {
        $delete = Product::findOrfail($id);
        $delete->buy()->delete();
        //$delete->sell()->delete();
        $delete->delete();

        if ($delete) {
            return response()->json(['success' => 'Data berhasil dihapus']);
        } else {
            return response()->json(['error' => 'Data gagal dihapus']);
        }

    }
}
