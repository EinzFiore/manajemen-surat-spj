<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kop extends Model
{
    use HasFactory;
    protected $table = "kop_dokumen";
    protected $fillable = [
        'id',
        'tahun_anggaran',
        'kode_rekening',
        'no_bukti',
        'kegiatan',
        'created_by',
        'updated_by',
    ];
}