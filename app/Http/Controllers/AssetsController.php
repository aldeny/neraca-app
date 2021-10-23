<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Dompdf\Dompdf;

class AssetsController extends Controller
{
    public function index_assets(){

        return view('admin.assets');
    }

    public function insert_assets(Request $request){

        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required',
            'tanggal_aset' => 'required',
            'jumlah_barang' => 'required',
            'saldo' => 'required',
            'harga' => 'required',
            'total' => 'required',
            'kondisi' => 'required',
            'gambar' => 'required|image',
            'keterangan' => 'nullable',
        ],
        [
            'nama_barang.required' => 'Nama barang/aset tidak boleh kosong',
            'tanggal_aset.required' => 'Tanggal tidak boleh kosong',
            'saldo.required' => 'Saldo tidak boleh kosong',
            'jumlah_barang.required' => 'Jumlah tidak boleh kosong',
            'harga.required' => 'Harga tidak boleh kosong',
            'total.required' => 'Total tidak boleh kosong',
            'kondisi.required' => 'Kondisi tidak boleh kosong',
            'gambar.required' => 'Gambar tidak boleh kosong',
            'gambar.image' => 'Gambar harus image',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code'=> 0, 'error'=>$validator->errors()->toArray()]);
        } else {
            $path = 'img-assets/';
            $file = $request->file('gambar');
            $file_name = time().'_'.$file->getClientOriginalName();

            $upload = $file->storeAs($path, $file_name, 'public');

            $db = new Aset;
            $db -> nama_barang = $request ->nama_barang;
            $db -> tanggal_beli_aset = $request ->tanggal_aset;
            $db -> saldo = $request ->saldo;
            $db -> jumlah = $request ->jumlah_barang;
            $db -> harga = $request ->harga;
            $db -> total = $request ->total;
            $db -> kondisi = $request ->kondisi;
            $db -> gambar =$file_name;
            $db -> keterangan = $request ->keterangan;

            $insert = $db -> save();

            if ($insert) {
                return response()->json(['code' => 1, 'pesan' => 'Aset baru berhasil ditambahkan']);
            }
            return response()->json(['code' => 0, 'pesan' => 'Terjadi kesalahan input']);

        }

    }

    public function GetDataassets(){
        $data = Aset::latest()->get();

        if (request()->ajax()) {
            return datatables()->of($data)
            ->addColumn('gambar', function($data){
                $gambar ="<img src='/storage/img-assets/".$data->gambar."' alt='' class='img-fluid' width='100px'>";
                return $gambar;
            })
            ->addColumn('nama_barang', function($data){
                return $data->nama_barang;
            })
            ->addColumn('tanggal_aset', function($data){
                $dt = $data->tanggal_beli_aset ? with(new Carbon($data->tanggal_beli_aset))->format('d-M-Y') : '';
                return $dt;
            })
            ->addColumn('saldo', function($data){
                if ($data->saldo == 1) {
                    return 'Kas Bank';
                } elseif ($data->saldo == 2) {
                    return 'Kas Besar';
                } else {
                    return 'Kas Kecil';
                }
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
                //$btn = "<button class='btn btn-primary btn-sm btn-detail mr-2' data-id='".$data->id."'>Detail</button>";
                $btn = "<button class='btn btn-info btn-sm mr-2' data-id='".$data->id."' id='btn-edit'>Edit</button>";
                $btn .= "<button class='btn btn-danger btn-sm' data-id='".$data->id."' id='btn-delete'>Delete</button>";
                return $btn;
            })
            ->rawColumns(['gambar','nama_barang','tanggal_aset','saldo','jumlah_barang','harga','total','kondisi','aksi'])
            ->make(true);
        }

        return view('admin.assets',
            [
                'data'    => $data,
            ]);
    }

    public function EditDataassets(Request $request){
        $update = Aset::findOrfail($request->id_aset);
        return response()->json(['code'=>1, 'result'=>$update]);
    }

    public function UpdateDataassets(Request $request){

        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required',
            'tanggal_aset_edit' => 'required',
            'saldo_edit' => 'required',
            'jumlah_barang_edit' => 'required',
            'harga_edit' => 'required',
            'total_edit' => 'required',
            'kondisi' => 'required',
            'gambar_update' => 'image',
            'keterangan' => 'nullable',
        ],
        [
            'nama_barang.required' => 'Nama barang/aset tidak boleh kosong',
            'tanggal_aset_edit.required' => 'Tanggal tidak boleh kosong',
            'saldo_edit.required' => 'Nama barang/aset tidak boleh kosong',
            'jumlah_barang_edit.required' => 'Jumlah tidak boleh kosong',
            'harga_edit.required' => 'Harga tidak boleh kosong',
            'total_edit.required' => 'total tidak boleh kosong',
            'kondisi.required' => 'Kondisi tidak boleh kosong',
            'gambar_update.image' => 'Gambar harus image',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code'=> 0, 'error'=>$validator->errors()->toArray()]);
        }
        else {
            // update aset
            if ($request->hasFile('gambar_update')) {
                $id_asset = $request->id;
                $update = Aset::find($id_asset);
                $path = 'img-assets/';
                $file_path = $path.$update->gambar;

                // delete asset
                if ($update->gambar != null && Storage::disk('public')->exists($file_path)) {
                    Storage::disk('public')->delete($file_path);
                }
                //update new image
                $file = $request->file('gambar_update');
                $file_name = time().'_'.$file->getClientOriginalName();
                $upload = $file->storeAs($path, $file_name, 'public');

                if ($upload) {
                    $id_asset = $request->id;
                    $update = Aset::find($id_asset);
                    $update -> nama_barang = $request -> nama_barang;
                    $update -> tanggal_beli_aset = $request -> tanggal_aset_edit;
                    $update -> saldo = $request -> saldo_edit;
                    $update -> jumlah = $request -> jumlah_barang_edit;
                    $update -> harga = $request -> harga_edit;
                    $update -> total = $request -> total_edit;
                    $update -> kondisi = $request -> kondisi;
                    $update -> gambar = $file_name;
                    $update -> save();

                    return response()->json(['code'=>1, 'pesan'=>'Aset berhasil diperbarui']);
                }

            } else {

                $id_asset = $request->id;
                $update = Aset::find($id_asset);
                $update -> nama_barang = $request -> nama_barang;
                $update -> tanggal_beli_aset = $request -> tanggal_aset_edit;
                $update -> saldo = $request -> saldo_edit;
                $update -> jumlah = $request -> jumlah_barang_edit;
                $update -> harga = $request -> harga_edit;
                $update -> total = $request -> total_edit;
                $update -> kondisi = $request -> kondisi;

                $update -> save();

                return response()->json(['code'=>1, 'pesan'=>'Aset berhasil diperbarui']);
            }
        }
    }

    public function deleteIdAsset(Request $request)
    {
        $delete = Aset::findOrfail($request->aset_id);
        $path = 'img-assets/';
        $img_path = $path.$delete->gambar;

        if ($delete->gambar != null && Storage::disk('public')->exists($img_path)) {
            Storage::disk('public')->delete($img_path);
        }

        $query = $delete->delete();

        if ($query) {
            return response()->json(['code'=>1, 'pesan'=>'Data berhasil dihapus']);
        } else {
            return response()->json(['code'=>0, 'pesan'=>'Data gagal dihapus']);
        }

    }

    public function PrintAset($from_date, $to_date){

        $aset = Aset::whereBetween('tanggal_beli_aset',[$from_date, $to_date])->latest()->get();
        $sum = $aset->sum('total');

        $today = Carbon::now()->isoFormat('D MMMM Y');

        return view('extend.print_Aset', compact('aset', 'today', 'sum'));
    }

    public function exportAset()
    {
        $aset = Aset::latest()->get();
        $total = $aset->sum('total');

        $today = Carbon::now()->isoFormat('D MMMM Y');

        $view = view('exports.aset_export', compact('aset','total','today'));

        return $view;

       /*  $dompdf = new Dompdf();
        $dompdf->loadHtml($view);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream(); */
    }
}
