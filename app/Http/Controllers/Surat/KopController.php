<?php

namespace App\Http\Controllers\Surat;

use App\Http\Controllers\Controller;
use App\Models\Kop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class KopController extends Controller
{
    public function index()
    {
        return view('surat.kop.list');
    }

    public function get()
    {
        $data = Kop::get();
        return DataTables::of($data)
            ->editColumn('created_at', function ($request) {
                return $request->created_at->format('Y-m-d H:i:s');
            })
            ->addColumn('Actions', function ($data) {
                return '<button type="button" class="btn btn-primary btn-sm" id="editKop" data-id="' . $data->id . '">Edit</button>
                    <a href="/surat/kop/edit/' . $data->id . '" class="btn btn-danger btn-md" id="deleteKop">Delete</a>';
            })
            ->rawColumns(['Actions'])
            ->make(true);
    }

    public function store(Request $request, Kop $kop)
    {
        $validator = Validator::make($request->all(), [
            'tahun_anggaran' => 'required|numeric',
            'kode_rekening' => 'required',
            'no_bukti' => 'required',
            'kegiatan' => 'required',
        ]);

        $id = str_pad(1, 4, "0", STR_PAD_LEFT);
        dd($id);

        $request->request->add(
            [
                'id' => $id,
                'created_by' => auth()->user()->username,
                'updated_by' => auth()->user()->username,
            ]); //add request

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $kop->create($request->all());
        return response()->json(['success' => 'Berhasil menambahkan Kop Surat!']);
    }

    public function show($id)
    {
        $data = Kop::findOrFail($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $data = Kop::findOrFail($id);
        $data->update($request->all());
        return response()->json(['success' => 'Berhasil mengubah data Kop!']);
    }

    public function destroy($id)
    {
        $data = Kop::findOrFail($id);
        $data->delete();
        return back()->with('success', 'Berhasil menghapus data Kop');
    }
}