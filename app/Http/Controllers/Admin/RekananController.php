<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rekanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class RekananController extends Controller
{
    public function index()
    {
        return view('admin.rekanan.list');
    }

    public function getRekanan()
    {
        $data = Rekanan::get();
        return DataTables::of($data)
            ->addColumn('Actions', function ($data) {
                return '<button type="button" class="btn btn-primary btn-sm" id="editRekanan" data-id="' . $data->id . '">Edit</button>
                    <a href="/admin/rekanan/delete/' . $data->id . '" class="btn btn-danger btn-md" id="deleteRekanan">Delete</a>';
            })
            ->rawColumns(['Actions'])
            ->make(true);
    }

    public function store(Request $request, Rekanan $rekanan)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'perusahaan' => 'required',
            'alamat' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $rekanan->create($request->all());
        return response()->json(['success' => 'Berhasil menambahkan rekanan!']);
    }

    public function show($id)
    {
        $data = Rekanan::findOrFail($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $data = Rekanan::findOrFail($id);
        $data->update($request->all());
        return response()->json(['success' => 'Berhasil mengubah data Rekanan!']);
    }

    public function destroy($id)
    {
        $data = Rekanan::findOrFail($id);
        $data->delete();
        return back()->with('success', 'Berhasil menghapus data Rekanan');
    }

    public function cari(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $rekanan = Rekanan::limit(5)->get();
        } else {
            $rekanan = Rekanan::where('nama', 'like', '%' . $search . '%')->limit(5)->get();
        }

        $response = array();
        foreach ($rekanan as $p) {
            $response[] = array("value" => $p->nama, "id" => $p->id, "alamat" => $p->alamat);
        }

        return response()->json($response);
    }
}