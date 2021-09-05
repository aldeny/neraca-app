<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Cash;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index_bank(){
        return view('extend.index');
    }

    public function getDataBank(){
        $data = Bank::latest()->get();

        if (request()->ajax()) {
            return datatables()->of($data)
            ->addColumn('nama_bank', function($data){
                return $data->nama_bank;
            })
            ->addColumn('aksi', function($data){
                $btn = "<button class='btn btn-sm btn-outline-info btn-edit' data-id='".$data->id."'><i class='fas fa-edit'></i></button>";
                $btn .= "<button class='btn btn-sm btn-outline-danger btn-delete' data-id='".$data->id."'><i class='fas fa-trash'></i></button>";
                return $btn;
            })
            ->rawColumns(['nama_bank','aksi'])
            ->make(true);
        }

        return view('extend.index',
            [
                'data'    => $data,
            ]);
    }

    public function addBank(Request $request){

        //validate
        $request->validate([
            'nama_bank' => 'required|unique:banks',
        ],
        [
            'nama_bank.required' => 'Kolom nama bank tidak boleh kosong',
            'nama_bank.unique' => 'Data sudah ada',
        ]);

        $data = new Bank;
        $data -> nama_bank = $request -> nama_bank;
        $save = $data -> save();

        if ($save) {
            return response()->json(['success' => 'Data berhasil ditambahkan']);
        }else {
            return response()->json(['error' => 'Data gagal ditambahkan']);
        }
    }

    public function getDataId($id){
        $bank = Bank::find($id);
        return response()->json(['bank' => $bank]);
    }

    public function updateBank(Request $request){
        $id_bank = $request->id;
        $update = Bank::find($id_bank);
        $update -> nama_bank = $request -> nama_bank;
        $update -> save();

        return response()->json(['success' => 'Data berhasil di update']);
    }

    public function deleteIdBank($id){
        $delete = Bank::findOrfail($id);
        $delete->delete();
        return back();
    }
}
