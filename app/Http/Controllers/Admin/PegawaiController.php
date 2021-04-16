<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PegawaiController extends Controller
{
    public function index()
    {
        return view('admin.pegawai.list');
    }

    public function getPegawai()
    {
        $data = Pegawai::get();
        return DataTables::of($data)
            ->addColumn('Actions', function ($data) {
                return '<button type="button" class="btn btn-primary btn-sm" id="editPegawai" data-id="' . $data->id . '">Edit</button>
                    <a href="/admin/pegawai/delete/' . $data->id . '" class="btn btn-danger btn-md" id="deletePegawai">Delete</a>';
            })
            ->rawColumns(['Actions'])
            ->make(true);
    }

    public function store(Request $request, Pegawai $pegawai)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'jabatan' => 'required',
            'nip' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $pegawai->create($request->all());
        return response()->json(['success' => 'Berhasil menambahkan pegawai!']);
    }

    public function show($id)
    {
        $data = Pegawai::findOrFail($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $data = Pegawai::findOrFail($id);
        $data->update($request->all());
        return response()->json(['success' => 'Berhasil mengubah data pegawai!']);
    }

    public function destroy($id)
    {
        $data = Pegawai::findOrFail($id);
        $data->delete();
        return back()->with('success', 'Berhasil menghapus data pegawai');
    }

    public function cari(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $pegawai = Pegawai::select('id', 'nama')->limit(5)->get();
        } else {
            $pegawai = Pegawai::select('id', 'nama')->where('nama', 'like', '%' . $search . '%')->limit(5)->get();
        }

        $response = array();
        foreach ($pegawai as $p) {
            $response[] = array("value" => $p->nama, "id_pegawai" => $p->id);
        }

        return response()->json($response);
    }
}