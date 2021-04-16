<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;
    protected $table = "surat";
    protected $primaryKey = "no_bku";
    protected $fillable = [
        'no_bku',
        'ket_terima',
        'uang_keluar',
        'keterangan',
        'id_ttd',
        'kode_rekening',
        'no_bukti',
        'created_by',
        'updated_by',
        'id_export',
        'penerima',
        'alamat_penerima',
        'id_penyetuju',
        'id_pengetahu',
        'id_pembayar',
        'tahun_anggaran',
    ];
}