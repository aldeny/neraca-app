<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\Models\HistoryCredit;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Dompdf\Dompdf;

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
            'saldo' => 'required',
        ],
        [
            'nama_item.required' => 'Nama barang tidak boleh kosong',
            'tanggal_beli.required' => 'Tanggal beli tidak boleh kosong',
            'harga.required' => 'Harga beli tidak boleh kosong',
            'jumlah_bayar.required' => 'Jumlah bayar tidak boleh kosong',
            'sisa.required' => 'Sisa bayar pokok tidak boleh kosong',
            'saldo.required' => 'Sisa bayar pokok tidak boleh kosong',
        ]);

        /* Insert data into database */

        $insert = new Credit;
        $insert -> nama_item = $request -> nama_item;
        $insert -> tanggal_beli = $request -> tanggal_beli;
        $insert -> harga = $request -> harga;
        $insert -> jumlah_bayar = $request -> jumlah_bayar;
        $insert -> ket_bayar = $request -> ket_bayar;
        $insert -> saldo = $request -> saldo;
        $insert -> sisa = changeIDRtoNumeric($request -> sisa);
        $save = $insert->save();

        $history = new HistoryCredit;
        $history -> credit_id = $insert -> id;
        $history -> tanggal_histori = $request -> tanggal_beli;
        $history -> sisa_bayar = $request -> jumlah_bayar;
        $history -> saldo_histori = $request -> saldo;
        $history -> keterangan_histori = $request -> ket_bayar;
        $store = $history -> save();

        if ($save) {
            return response()->json(['success' => 'Data berhasil di tambahkan', $save]);
        }
        else {
            return response()->json(['error' => 'Data gagal di tambahkan', $save]);
        }
    }

    public function CreditGet(){
        $data = Credit::latest();

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
            ->addColumn('saldo', function($data){
                if ($data->saldo == 1) {
                    return 'Kas Bank';
                } elseif ($data->saldo == 2) {
                    return 'Kas Besar';
                } else {
                    return 'Kas Kecil';
                }

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
                if ($data->sisa == 0) {
                    return 'LUNAS';
                }
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
                            <a class='dropdown-item btn-sisa' type='button' data-id='".$data->id."'>Bayar Sisa</a>

                            <a class='dropdown-item btn-delete' type='button' data-id='".$data->id."'>Hapus</a>
                            </div>
                        </div>";

                return $btn;

            })
            ->rawColumns(['nama_item','tanggal_beli','saldo','harga','jumlah_bayar','sisa','ket_bayar','aksi'])
            ->make(true);
        }

        return view('admin.credit',
            [
                'data'    => $data,
            ]);
    }

    public function GetDataCreditId($id){
        $credit = Credit::find($id);
        return response()->json(['credit' => $credit]);
    }

    public function PayCredit(Request $request){

        $credit = new HistoryCredit();
        $credit -> credit_id = $request -> id_sisa;
        $credit -> tanggal_histori = $request -> tanggal_bayar_sisa;
        $credit -> saldo_histori = $request -> saldo_histori;
        $credit -> sisa_bayar = $request -> jumlah_bayar_sisa;
        $credit -> keterangan_histori = $request -> ket_bayar_sisa;
        $save = $credit -> save();

        $sisa = Credit::findOrFail($request->id_sisa);
        $sisa->sisa -= $request->jumlah_bayar_sisa;
        $sisa->jumlah_bayar += $request->jumlah_bayar_sisa;
        $sisa -> save();

        if ($save) {
            return response()->json(['success' => 'Credit berhasil dibayarkan', $save]);
        }
        else {
            return response()->json(['error' => 'Credit gagal dibayarkan', $save]);
        }

    }

    public function HistoryCreditGet(){
        $data = HistoryCredit::latest();

        if (request()->ajax()) {
            return datatables()->of($data)
            ->addColumn('nama_barang', function($data){
                $dt = $data->credit->nama_item;
                return $dt ;
            })
            ->addColumn('tanggal_bayar', function($data){
                $dt = $data->tanggal_histori ? with(new Carbon($data->tanggal_histori))->format('d-M-Y') : '';
                return $dt;
            })
            ->addColumn('saldo_histori', function($data){
                if ($data->saldo_histori == 1) {
                    return 'Kas Bank';
                } elseif ($data->saldo_histori == 2) {
                    return 'Kas Besar';
                } else {
                    return 'Kas Kecil';
                }
            })
            ->addColumn('sisa_bayar', function($data){
                $dt = "Rp. ".number_format($data->sisa_bayar,0,',','.');
                return $dt;
            })
            ->addColumn('keterangan_histori', function($data){
                $dt = $data->keterangan_histori;
                return $dt;
            })
            ->addColumn('aksi', function($data){
                $btn = "<button class='btn btn-danger btn-sm btn-delete-histori' type='button' data-id='".$data->id."' data-sisa='".$data->sisa_bayar."' data-credit='".$data->credit->id."'>Hapus</button>";

                return $btn;

            })
            ->rawColumns(['nama_barang','tanggal_bayar','saldo_histori','sisa_bayar','keterangan_histori','aksi'])
            ->make(true);
        }

        return view('admin.credit',
            [
                'data'    => $data,
            ]);
    }

    public function deleteIdCredit($id){
        $delete = Credit::findOrfail($id);
        $delete->delete();

        if ($delete) {
            return response()->json(['success' => 'Data berhasil dihapus']);
        } else {
            return response()->json(['error' => 'Data gagal dihapus']);
        }
    }

    public function deleteIdHistoryCredit(Request $request)
    {
        $product = Credit::findOrFail($request->credit);
        $product->jumlah_bayar -= $request->sisa;
        $product->sisa += $request->sisa;
        $product -> save();

        $delete = HistoryCredit::findOrfail($request->id);
        $delete->delete();

        if ($delete) {
            return response()->json(['success'=>'Data berhasil dihapus']);
        } else {
            return response()->json(['error'=>'Data gagal dihapus']);

        }
    }

    public function PrintCredit($from_date, $to_date){

        $credit = Credit::whereBetween('tanggal_beli',[$from_date, $to_date])->latest()->get();
        $sum = $credit->sum('gaji');

        $today = Carbon::now()->isoFormat('D MMMM Y');

        return view('extend.print_Credit', compact('credit', 'today', 'sum'));
    }

    public function PrintCreditHistory($from_date, $to_date){

        $history = HistoryCredit::whereBetween('tanggal_histori',[$from_date, $to_date])->latest()->get();
        $sum = $history->sum('gaji');

        $today = Carbon::now()->isoFormat('D MMMM Y');

        return view('extend.print_Credit_History', compact('history', 'today', 'sum'));
    }

    public function exportCredit()
    {
        $credit = Credit::latest()->get();
        $harga = $credit->sum('harga');
        $jum = $credit->sum('jumlah_bayar');
        $sisa = $credit->sum('sisa');

        $today = Carbon::now()->isoFormat('D MMMM Y');

        $view = view('exports.credit_export', compact('credit','harga','jum','sisa','today'));

        //return $view;

        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
    }
}
