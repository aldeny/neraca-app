<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Payment;
use App\Models\Position;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Dompdf\Dompdf;

class EmployeeController extends Controller
{
    public function EmployeeIndex(){
        $position = Position::all();

        return view('admin.karyawan', compact('position'));
    }

    public function insert_employee(Request $request){

        /* Validate */
        $request->validate([
            'tanggal' => 'required',
            'nama' => 'required',
            'jabatan' => 'required',
            'jenis_kelamin' => 'required',
            'status' => 'required',
            'gaji' => 'required',
        ],
        [
            'tanggal.required' => 'Tanggal tidak boleh kosong',
            'nama.required' => 'Nama karyawan tidak boleh kosong',
            'jabatan.required' => 'Jabatan tidak boleh kosong',
            'jenis_kelamin.required' => 'Jenis kelamin tidak boleh kosong',
            'status.required' => 'Status tidak boleh kosong',
            'gaji.required' => 'Gaji pokok tidak boleh kosong',
        ]);

        /* Insert data into database */

        $insert = new Employee;
        $insert -> tanggal = $request -> tanggal;
        $insert -> nama = $request -> nama;
        $insert -> position_id = $request -> jabatan;
        $insert -> jenis_kelamin = $request -> jenis_kelamin;
        $insert -> status = $request -> status;
        $insert -> gaji = changeIDRtoNumeric($request -> gaji);
        $save = $insert->save();

        if ($save) {
            return response()->json(['success' => 'Data berhasil di tambahkan', $save]);
        }
        else {
            return response()->json(['error' => 'Data gagal di tambahkan', $save]);
        }
    }

    public function GetDataEmployee(){
        $data = Employee::all();

        if (request()->ajax()) {
            return datatables()->of($data)
            ->addColumn('nama', function($data){
                $dt = $data->nama;
                return $dt ;
            })
            ->addColumn('jabatan', function($data){
                $dt = $data->position->jabatan;
                return $dt;
            })
            ->addColumn('jenis_kelamin', function($data){
                if ($data->jenis_kelamin == 1){
                    return 'Laki-Laki';
                }
                return 'Perempuan';
            })
            ->addColumn('status', function($data){
                switch ($data->status) {
                    case '1':
                        return 'K/...';
                        break;
                    case '2':
                        return 'TK/0';
                        break;
                    default:
                        return 'TK/1';
                        break;
                }
            })
            ->addColumn('gaji', function($data){
                $dt = "Rp. ".number_format($data->gaji,0,',','.');
                return $dt;
            })
            ->addColumn('aksi', function($data){
                $btn = "<div class='dropdown'>
                            <a class='btn btn-info btn-sm dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <i class='fas fa-th-list'></i>
                            </a>

                            <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
                            <a class='dropdown-item btn-gaji' type='button' data-id='".$data->id."'>Bayar gaji</a>
                            <a class='dropdown-item btn-edit' type='button' data-id='".$data->id."'>Edit</a>
                            <a class='dropdown-item btn-delete' type='button' data-id='".$data->id."'>Hapus</a>
                            </div>
                        </div>";

                return $btn;

            })
            ->rawColumns(['nama','jabatan','jenis_kelamin','status','gaji','aksi'])
            ->make(true);
        }

        return view('admin.karyawan',
            [
                'data'    => $data,
            ]);
    }

    public function GetDataEmployeeId($id){
        $emplo = Employee::find($id);
        return response()->json(['emplo' => $emplo]);
    }

    public function PayEmployee(Request $request){

        $pay = new Payment;
        $pay -> employee_id = $request -> id;
        $pay -> tanggal = $request -> tanggal;
        $pay -> nama = $request -> nama;
        $pay -> position_id = $request -> jabatan;
        $pay -> gaji = $request -> gaji;
        $pay -> saldo = $request -> saldo;
        $save = $pay -> save();

        if ($save) {
            return response()->json(['success' => 'Gaji berhasil dibayarkan', $save]);
        }
        else {
            return response()->json(['error' => 'Gaji gagal dibayarkan', $save]);
        }

    }

    public function Payment(){
        $data = Payment::latest()->get();

        if (request()->ajax()) {
            return datatables()->of($data)
            ->addColumn('nama', function($data){
                $dt = $data->nama;
                return $dt ;
            })
            ->addColumn('gaji', function($data){
                $dt = "Rp. ".number_format($data->gaji,0,',','.');
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
            ->addColumn('created_at', function($data){
                $dt = $data->tanggal ? with(new Carbon($data->tanggal))->format('d-M-Y') : '';
                return $dt;
            })
            ->addColumn('aksi', function($data){
                $btn = "<button class='btn btn-danger btn-sm btn-delete-riwayat' data-id='".$data->id."'>Delete</button>";
                $btn_dis = "<button class='btn btn-danger btn-sm disabled'>Delete</button>";

                $dt_awal = new DateTime(now());
                $dt_akhir = new DateTime($data->created_at);
                $selisih = $dt_awal->diff($dt_akhir);

                if ($selisih->days >= 1) {
                    return $btn_dis;
                }
                return $btn;
            })

            ->rawColumns(['nama','gaji','saldo','created_at','aksi'])
            ->make(true);
        }

        return view('admin.karyawan',
            [
                'data'    => $data,
            ]);
    }

    public function PaymentDel($id)
    {
        $delete = Payment::findOrfail($id);
        $delete->delete();
        if ($delete) {
            return response()->json(['success' => 'Data berhasil dihapus']);
        } else {
            return response()->json(['error' => 'Data gagal dihapus']);
        }
    }

    public function UpdateEmployee(Request $request){

        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'jenis_kelamin' => 'required',
            'status' => 'required',
            'gaji' => 'required',
        ],
        [
            'nama.required' => 'Nama karyawan tidak boleh kosong',
            'jabatan.required' => 'Jabatan tidak boleh kosong',
            'jenis_kelamin.required' => 'Jenis kelamin tidak boleh kosong',
            'status.required' => 'Status tidak boleh kosong',
            'gaji.required' => 'Gaji pokok tidak boleh kosong',
        ]);

        $id_employee = $request->id;
        $update = Employee::find($id_employee);
        $update -> nama = $request -> nama;
        $update -> position_id = $request -> jabatan;
        $update -> jenis_kelamin = $request -> jenis_kelamin;
        $update -> status = $request -> status;
        $update -> gaji = changeIDRtoNumeric($request -> gaji);
        $save = $update->save();

        if ($save) {
            return response()->json(['success' => 'Data berhasil di tambahkan', $save]);
        }
        else {
            return response()->json(['error' => 'Data gagal di tambahkan', $save]);
        }
    }

    public function EmployeeDel($id)
    {
        $delete = Employee::findOrfail($id);
        $delete->delete();
        if ($delete) {
            return response()->json(['success' => 'Data berhasil dihapus']);
        } else {
            return response()->json(['error' => 'Data gagal dihapus']);
        }
    }

    public function PrintEmployee($from_date, $to_date){

        $employee = Payment::whereBetween('tanggal',[$from_date, $to_date])->latest()->get();
        $sum = $employee->sum('gaji');

        $today = Carbon::now()->isoFormat('D MMMM Y');

        return view('extend.print_Employee', compact('employee', 'today', 'sum'));
    }

    public function exportEmployee()
    {
        $pegawai = Employee::latest()->get();
        // $harga = $pegawai->sum('harga');

        $today = Carbon::now()->isoFormat('D MMMM Y');

        $view = view('exports.pegawai_export', compact('pegawai','today'));

        return $view;

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
