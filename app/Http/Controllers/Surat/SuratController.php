<?php

namespace App\Http\Controllers\Surat;

use alhimik1986\PhpExcelTemplator\params\ExcelParam;
use alhimik1986\PhpExcelTemplator\PhpExcelTemplator;
use alhimik1986\PhpExcelTemplator\setters\CellSetterStringValue;
use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use App\Models\ExportSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Riskihajar\Terbilang\Facades\Terbilang;
use Yajra\DataTables\Facades\DataTables;

class SuratController extends Controller
{
    public function index()
    {
        return view('surat.index');
    }

    public function get(Request $request)
    {
        $data = DB::table('surat')
            ->join('export_surat', 'surat.no_bku', 'export_surat.no_bku')
            ->select('surat.*', 'export_surat.nama_file', 'export_surat.total_export', 'export_surat.export_by');
        if ($request->month != "") {
            $data->whereMonth('surat.created_at', $request->month);
        }
        if ($request->tahun != "") {
            $data->whereYear('tahun_anggaran', $request->tahun);
        }
        if ($request->waktu != "") {
            if ($request->waktu == "Today") {
                $data->whereDate('surat.created_at', Carbon::today());
            }
            if ($request->waktu == "Yesterday") {
                $yesterday = date("Y-m-d", strtotime('-1 days'));
                $data->whereDate('surat.created_at', $yesterday);
            }
            if ($request->waktu == "Last Week") {
                $data->whereBetween('surat.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            }
        }
        return DataTables::of($data)
            ->editColumn('created_at', function ($request) {
                return Carbon::make($request->created_at)->format('Y-m-d H:i:s');
            })
            ->addColumn('Actions', function ($data) {
                return '<button type="button" class="btn btn-primary btn-md" id="editSurat" data-id="' . $data->no_bku . '">Edit</button>
                    <a href="/surat/export/' . $data->no_bku . '" class="btn btn-success btn-md" id="print">Print</a>';
            })
            ->rawColumns(['Actions'])
            ->make(true);
    }

    public function store(Request $request, Dokumen $surat)
    {
        $validator = Validator::make($request->all(), [
            'no_bku' => 'required',
            'ket_terima' => 'required',
            'kode_rekening' => 'required',
            'no_bukti' => 'required',
            'uang_keluar' => 'required',
            'keterangan' => 'required',
            'penerima' => 'required',
            'alamat_penerima' => 'required',
            'id_penyetuju' => 'required',
            'id_pengetahu' => 'required',
            'id_pembayar' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $surat->create([
            'no_bku' => $request->no_bku,
            'ket_terima' => $request->ket_terima,
            'kode_rekening' => $request->kode_rekening,
            'no_bukti' => $request->no_bukti,
            'uang_keluar' => $request->uang_keluar,
            'keterangan' => $request->keterangan,
            'penerima' => $request->penerima,
            'alamat_penerima' => $request->alamat_penerima,
            'id_penyetuju' => $request->id_penyetuju,
            'id_pengetahu' => $request->id_pengetahu,
            'id_pembayar' => $request->id_pembayar,
        ]);
        return response()->json(['success' => 'Berhasil menambahkan Surat!']);
    }

    public function show($no)
    {
        $data = DB::table('surat')
            ->join('pegawai as penyetuju', 'surat.id_penyetuju', 'penyetuju.id')
            ->join('pegawai as pengetahu', 'surat.id_pengetahu', 'pengetahu.id')
            ->join('pegawai as pembayar', 'surat.id_pembayar', 'pembayar.id')
            ->select('penyetuju.nama as nama_penyetuju', 'pengetahu.nama as nama_pengetahu', 'pembayar.nama as nama_pembayar', 'surat.*')
            ->where('surat.no_bku', $no)
            ->first();
        return response()->json($data);
    }

    public function update(Request $request, $no)
    {
        $surat = Dokumen::where('no_bku', $no)->first();
        $validator = Validator::make($request->all(), [
            'no_bku' => 'required',
            'ket_terima' => 'required',
            'kode_rekening' => 'required',
            'no_bukti' => 'required',
            'uang_keluar' => 'required',
            'keterangan' => 'required',
            'penerima' => 'required',
            'alamat_penerima' => 'required',
            'id_penyetuju' => 'required',
            'id_pengetahu' => 'required',
            'id_pembayar' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $surat->update($request->all());
        return response()->json(['success' => 'Berhasil ubdah data Surat!']);
    }

    public function export($no)
    {
        $data = DB::table('surat')
            ->join('pegawai as penyetuju', 'surat.id_penyetuju', 'penyetuju.id')
            ->join('pegawai as pengetahu', 'surat.id_pengetahu', 'pengetahu.id')
            ->join('pegawai as pembayar', 'surat.id_pembayar', 'pembayar.id')
            ->select('penyetuju.nama as nama_penyetuju', 'penyetuju.jabatan as jabatan_penyetuju', 'penyetuju.nip as nip_penyetuju', 'pengetahu.nama as nama_pengetahu', 'pengetahu.jabatan as jabatan_pengetahu', 'pengetahu.nip as nip_pengetahu', 'pembayar.nama as nama_pembayar', 'pembayar.jabatan as jabatan_pembayar', 'pembayar.nip as nip_pembayar', 'surat.*')
            ->where('surat.no_bku', $no)
            ->first();
        $url = public_path();
        $params = [
            '{tahun}' => new ExcelParam(CellSetterStringValue::class, $data->tahun_anggaran),
            '{kode_rekening}' => new ExcelParam(CellSetterStringValue::class, $data->kode_rekening),
            '{no_bku}' => new ExcelParam(CellSetterStringValue::class, $data->no_bku),
            '{no}' => new ExcelParam(CellSetterStringValue::class, $data->no_bku),
            '{serah_terima}' => new ExcelParam(CellSetterStringValue::class, $data->ket_terima),
            '{uang}' => new ExcelParam(CellSetterStringValue::class, $data->uang_keluar),
            '{terbilang}' => new ExcelParam(CellSetterStringValue::class, Terbilang::make($data->uang_keluar, ' rupiah')),
            '{keterangan}' => new ExcelParam(CellSetterStringValue::class, $data->keterangan),
            '{jabatan_penyetuju}' => new ExcelParam(CellSetterStringValue::class, $data->jabatan_penyetuju),
            '{penyetuju}' => new ExcelParam(CellSetterStringValue::class, $data->nama_penyetuju),
            '{nip_penyetuju}' => new ExcelParam(CellSetterStringValue::class, $data->nip_penyetuju),
            '{jabatan_pengetahu}' => new ExcelParam(CellSetterStringValue::class, $data->jabatan_pengetahu),
            '{pengetahui}' => new ExcelParam(CellSetterStringValue::class, $data->nama_pengetahu),
            '{nip_pengetahu}' => new ExcelParam(CellSetterStringValue::class, $data->nip_pengetahu),
            '{jabatan_pembayar}' => new ExcelParam(CellSetterStringValue::class, $data->jabatan_pembayar),
            '{pembayar}' => new ExcelParam(CellSetterStringValue::class, $data->nama_pembayar),
            '{nip_pembayar}' => new ExcelParam(CellSetterStringValue::class, $data->nip_pembayar),
            '{penerima}' => new ExcelParam(CellSetterStringValue::class, $data->penerima),
            '{alamat_penerima}' => new ExcelParam(CellSetterStringValue::class, $data->alamat_penerima),
        ];
        $date = date('Y-m-d');
        $file = "{$data->no_bku}-{$date}.xlsx";
        $existData = ExportSurat::where('nama_file', $file)->first();
        $path = "{$url}/export/{$file}";
        if ($existData) {
            $existData->update(['export_by' => auth()->user()->username]);
            $existData->increment('total_export', 1);
            PhpExcelTemplator::saveToFile("{$url}/doc/template.xlsx", "{$url}/export/{$existData->nama_file}", $params);
            return response()->download($path, "{$existData->nama_file}");
        } else {
            ExportSurat::create([
                'no_bku' => $data->no_bku,
                'nama_file' => $file,
                'total_export' => 0,
                'export_by' => auth()->user()->username,
            ]);
            PhpExcelTemplator::saveToFile("{$url}/doc/template.xlsx", "{$url}/export/{$file}", $params);
            return response()->download($path, "{$data->no_bku}-{$date}.xlsx");
        }
    }

}