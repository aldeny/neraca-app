<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Buy;
use App\Models\Cash;
use App\Models\Credit;
use App\Models\HistoryCredit;
use App\Models\Sell;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use RealRashid\SweetAlert\Facades\Alert;



class MainController extends Controller
{

    public function login(){
        return view('login');
    }

    public function validateLogin(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:6|max:12'
        ]);

        $user = User::where('username', '=', $request->username)->first();
        if (!$user) {
            Alert::toast('Ops, Sepertinya kamu belum terdaftar', 'error');
            return back();
        }
        else {
            //check password
            /* if (Hash::check($request->password, $user->password)) {
                $request->session()->put('LoggedUser', $user->id);
                //Alert::toast('Yayy. Kamu berhasil masuk', 'success');

                if ($user->role->id == 1) {
                    return redirect('/super/index');
                }
                if($user->role->id == 2){
                    return redirect('/super/index');
                }
                if($user->role->id == 3){
                    return redirect('/student/dashboard');
                }

            }
            else{
                Alert::toast('Ops, Password salah', 'error');
                return back();
            } */

            if ($request->password == $user->password) {
                $request->session()->put('LoggedUser', $user->id);
                //Alert::toast('Yayy. Kamu berhasil masuk', 'success');

                    return redirect('/index');

            }
            else{
                Alert::toast('Ops, Password salah', 'error');
                return back();
            }
        }
    }

    public function index()
    {
        $bank = Cash::where('sumber_dana', '=', 'Kas Bank')->sum('jumlah');
        $buy = Buy::where('saldo', '=', 1)->sum('total');
        $creditsisa = HistoryCredit::where('saldo_histori', '=', 1)->sum('sisa_bayar');
        $result = $bank-$buy-$creditsisa;
        $coun_bank = "Rp. ".number_format($result,0,',','.');

        $kas_besar = Cash::where('sumber_dana', '=', 'Kas Besar')->sum('jumlah');
        $buy_besar = Buy::where('saldo', '=', 2)->sum('total');
        $creditsisaBesar = HistoryCredit::where('saldo_histori', '=', 2)->sum('sisa_bayar');
        $result_besar = $kas_besar - $buy_besar - $creditsisaBesar;
        $coun_besar = "Rp. ".number_format($result_besar,0,',','.');

        $kas_kecil = Cash::where('sumber_dana', '=', 'Kas Kecil')->sum('jumlah');
        $buy_kecil = Buy::where('saldo', '=', 3)->sum('total');
        $creditsisaKecil = HistoryCredit::where('saldo_histori', '=', 3)->sum('sisa_bayar');
        $result_kecil = $kas_kecil - $buy_kecil - $creditsisaKecil;
        $coun_kecil = "Rp. ".number_format($result_kecil,0,',','.');

        $saldo_buy = Buy::all()->sum('total');
        $saldo_buy_ = "Rp. ".number_format($saldo_buy,0,',','.');

        $saldo_sell = Sell::all()->sum('total');
        $saldo_sell_ = "Rp. ".number_format($saldo_sell,0,',','.');

        $total_saldo = $result + $kas_besar + $result_kecil;
        $coun = "Rp. ".number_format($total_saldo,0,',','.');

        $pendapatan = ($saldo_sell - $saldo_buy);
        $cuan = "Rp. ".number_format($pendapatan,0,',','.');

        $credit = Credit::all()->sum('sisa');
        $piutang = "Rp. ".number_format($credit,0,',','.');

        return view('admin.index', ['count_bank' => $coun_bank, 'count' => $coun, 'count_besar' => $coun_besar, 'count_kecil' => $coun_kecil, 'saldo_buy_' => $saldo_buy_, 'saldo_sell_' => $saldo_sell_, 'cuan' => $cuan, 'piutang' => $piutang]);
    }

    public function getIndexKasBank()
    {
        $count = Cash::where('sumber_dana', '=', 'Kas Bank')->sum('jumlah');
        $buy = Buy::where('saldo', '=', 1)->sum('total');
        $creditsisa = HistoryCredit::where('saldo_histori', '=', 1)->sum('sisa_bayar');
        $result = $count - $buy - $creditsisa;
        $bank = Bank::all();
        $coun = "Rp. ".number_format($result,0,',','.');
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
        ],
        [
            'tanggal.required' => 'Tanggal tidak boleh kosong',
            'dana.required' => 'Dana tidak boleh kosong',
            'sumber_dana.required' => 'Sumber dana tidak boleh kosong',
            'bank_id.required' => 'Bank tidak boleh kosong',
            'jumlah.required' => 'Jumlah tidak boleh kosong',
            'keterangan.required' => 'Keterangan tidak boleh kosong',
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
                    ->latest()
                    ->get();

        //$data = Cash::all();

        if (request()->ajax()) {
            return datatables()->of($data)
            ->addColumn('tanggal', function($data){
                $dt = $data->tanggal ? with(new Carbon($data->tanggal))->format('d-M-Y') : '';
                return $dt ;
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

                $dt = new DateTime($data->created_at);
                $now = new DateTime('now');

                $dt_now = $now->diff($dt);

                $btn_dis = "<button class='btn btn-danger btn-sm disabled'>Delete</button>";
                $btn_act = "<button class='btn btn-danger btn-sm btn-delete' data-id='".$data->id."'>Delete</button>";

                if ($dt_now->days >= 1) {
                    return $btn_dis;
                } else {
                    return $btn_act;
                }

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
        $buy = Buy::where('saldo', '=', 2)->sum('total');
        $creditsisaBesar = HistoryCredit::where('saldo_histori', '=', 2)->sum('sisa_bayar');
        $result = $count - $buy - $creditsisaBesar;
        $bank = Bank::all();
        $coun = "Rp. ".number_format($result,0,',','.');
        return view('admin.kas_besar', ['count' => $coun, 'bank' => $bank]);
    }

    public function getDataKasBesar()
    {
        $data = Cash::Where('sumber_dana', '=', 'Kas Besar')
                    ->latest()
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
    public function getIndexKasKecil(){
        $count = Cash::where('sumber_dana', '=', 'Kas Kecil')->sum('jumlah');
        $buy = Buy::where('saldo', '=', 3)->sum('total');
        $creditsisaKecil = HistoryCredit::where('saldo_histori', '=', 3)->sum('sisa_bayar');

        $result = $count - $buy - $creditsisaKecil;
        $bank = Bank::all();
        $coun = "Rp. ".number_format($result,0,',','.');
        return view('admin.kas_kecil', ['count' => $coun, 'bank' => $bank]);
    }

    public function getDataKasKecil()
    {
        $data = Cash::Where('sumber_dana', '=', 'Kas Kecil')
                    ->latest()
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

    public function PrintKB($from_date, $to_date){

        $cetak_KB = Cash::where('sumber_dana', '=', 'Kas Bank')->whereBetween('tanggal',[$from_date, $to_date])->latest()->get();
        $sum = $cetak_KB->sum('jumlah');

        $today = Carbon::now()->isoFormat('D MMMM Y');

        return view('extend.print_KB', compact('cetak_KB', 'today', 'sum'));
    }

    public function PrintKBs($from_date, $to_date){

        $cetak_KB = Cash::where('sumber_dana', '=', 'Kas Besar')->whereBetween('tanggal',[$from_date, $to_date])->latest()->get();
        $sum = $cetak_KB->sum('jumlah');

        $today = Carbon::now()->isoFormat('D MMMM Y');

        return view('extend.print_KBs', compact('cetak_KB', 'today', 'sum'));
    }

    public function PrintKC($from_date, $to_date){

        $cetak_KB = Cash::where('sumber_dana', '=', 'Kas Kecil')->whereBetween('tanggal',[$from_date, $to_date])->latest()->get();
        $sum = $cetak_KB->sum('jumlah');

        $today = Carbon::now()->isoFormat('D MMMM Y');

        return view('extend.print_Kecil', compact('cetak_KB', 'today', 'sum'));
    }

    public function export()
    {
        $cash = Cash::all();
        $total = $cash->sum('jumlah');

        $today = Carbon::now()->isoFormat('D MMMM Y');

        $view = view('exports.cash_export', compact('cash','total','today'));

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

    public function logout(){
        if (session()->has('LoggedUser')) {
            session()->pull('LoggedUser');
            Alert::toast('Semoga harimu menyenangkan', 'success');
            return redirect('login');
        }
    }
}
