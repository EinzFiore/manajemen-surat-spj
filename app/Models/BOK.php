<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BOK extends Model
{
    use HasFactory;
    protected $table = "bok";
    protected $fillable = [
        'ket_terima',
        'uang_keluar',
        'kode_rekening',
        'keterangan',
        'id_ttd',
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