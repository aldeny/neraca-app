<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function PositionIndex(){
        return view('admin.position');
    }

    public function addPosition(Request $request){
        $request->validate([
            'jabatan' => 'required|unique:positions',
        ],
        [
            'jabatan.required' => 'Nama jabatan tidak boleh kosong',
            'jabatan.unique' => 'Data sudah ada',
        ]);

        $data = new Position;
        $data -> jabatan = $request -> jabatan;
        $save = $data -> save();

        if ($save) {
            return response()->json(['success' => 'Data berhasil ditambahkan']);
        }else {
            return response()->json(['error' => 'Data gagal ditambahkan']);
        }
    }

    public function getDataPosition(){
        $data = Position::latest()->get();

        if (request()->ajax()) {
            return datatables()->of($data)
            ->addColumn('jabatan', function($data){
                return $data->jabatan;
            })
            ->addColumn('aksi', function($data){
                $btn = "<button class='btn btn-sm btn-outline-info btn-edit' data-id='".$data->id."'><i class='fas fa-edit'></i></button>";
                $btn .= "<button class='btn btn-sm btn-outline-danger btn-delete' data-id='".$data->id."'><i class='fas fa-trash'></i></button>";
                return $btn;
            })
            ->rawColumns(['jabatan','aksi'])
            ->make(true);
        }

        return view('extend.index',
            [
                'data'    => $data,
            ]);
    }

    public function getIdPosition($id){
        $jabatan = Position::find($id);
        return response()->json(['jabatan' => $jabatan]);
    }

    public function updatePosition(Request $request){
        $id_jabatan = $request->id;
        $update = Position::find($id_jabatan);
        $update -> jabatan = $request -> jabatan;
        $update -> save();

        return response()->json(['success' => 'Data berhasil di update']);
    }

    public function deleteIdPosition($id){
        $delete = Position::findOrfail($id);
        $delete->delete();
        return back();
    }
}
