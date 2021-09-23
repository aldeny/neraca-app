<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use Illuminate\Http\Request;

class AssetsController extends Controller
{
    public function index_assets(){

        return view('admin.assets');
    }

    public function insert_assets(Request $request){

        //ddd($request->all());

        /* Validate */
        $request->validate([
            'nama_barang' => 'required',
            'jumlah_barang' => 'required',
            'harga' => 'required',
            'total' => 'required',
            'kondisi' => 'required',
            'gambar' => 'required|image',
        ]);

        $save = new Aset;
        $save -> nama_barang = $request -> nama_barang;
        $save -> jumlah = $request -> jumlah_barang;
        $save -> harga = $request -> harga;
        $save -> total = $request -> total;
        $save -> kondisi = $request -> kondisi;

        $nm_file = $request->gambar;
        $nama_file = $nm_file->getClientOriginalName();
        $nm_file->move(public_path().'/img-assets', $nama_file);

        $insert = $save -> save();

        if ($insert) {
            return response()->json(['success' => 'Asset berhasil ditambahkan']);
        }else{
            return response()->json(['error' => 'Asset gagal ditambahkan']);
        }
    }

    public function GetDataassets(){
        $data = Aset::latest()->get();

        if (request()->ajax()) {
            return datatables()->of($data)
            ->addColumn('nama_barang', function($data){
                return $data->nama_barang;
            })
            ->addColumn('jumlah_barang', function($data){
                return $data->jumlah;
            })
            ->addColumn('harga', function($data){
                $harga = "Rp. ".number_format($data->harga,0,',','.');
                return $harga;
            })
            ->addColumn('total', function($data){
                $total = "Rp. ".number_format($data->total,0,',','.');
                return $total;
            })
            ->addColumn('kondisi', function($data){
                $kondisi_baik = "<small class='badge badge-success'>Baik</small>";
                $kondisi_rusak = "<small class='badge badge-danger'>Rusak</small>";

                if ($data->kondisi == 1) {
                   return $kondisi_baik;
                }
                else{
                    return $kondisi_rusak;
                }
            })
            ->addColumn('aksi', function($data){
                $btn = "<button class='btn btn-primary btn-sm btn-detail mr-2' data-id='".$data->id."'>Detail</button>";
                $btn .= "<button class='btn btn-info btn-sm btn-edit mr-2' data-id='".$data->id."'>Edit</button>";
                $btn .= "<button class='btn btn-danger btn-sm btn-delete' data-id='".$data->id."'>Delete</button>";
                return $btn;
            })
            ->rawColumns(['nama_barang','jumlah_barang','harga','total','kondisi','aksi'])
            ->make(true);
        }

        return view('admin.assets',
            [
                'data'    => $data,
            ]);
    }

    public function EditDataassets($id){
        $update = Aset::findOrfail($id);
        return response()->json(['update'=>$update]);
    }

    public function UpdateDataassets(Request $request){
        $id_asset = $request->id;
        $update = Aset::find($id_asset);
        $update -> nama_barang = $request -> nama_barang;
        $update -> jumlah = $request -> jumlah_barang;
        $update -> harga = $request -> harga;
        $update -> total = $request -> total;
        $update -> kondisi = $request -> kondisi;
        $update -> save();

        return response()->json(['success' => 'Data berhasil di update']);
    }

    public function deleteIdAsset($id)
    {
        $delete = Aset::findOrfail($id);
        $delete->delete();
        return back();
    }
}
