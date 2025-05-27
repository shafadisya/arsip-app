<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'kategori',
        'nomor_surat',
        'departemen',
        'pengunggah',
        'file_path',
    ];
    protected $casts = [
    'tanggal_upload' => 'datetime',
];
}
