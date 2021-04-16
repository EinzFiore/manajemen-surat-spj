<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExportSurat extends Model
{
    use HasFactory;
    protected $table = "export_surat";
    protected $fillable = [
        'no_bku',
        'nama_file',
        'total_export',
        'export_by',
    ];
}