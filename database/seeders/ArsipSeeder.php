<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Arsip;
use Illuminate\Support\Carbon;

class ArsipSeeder extends Seeder
{
    public function run()
    {
        Arsip::create([
            'judul' => 'Contoh Arsip',
            'deskripsi' => 'Ini adalah contoh arsip untuk keperluan testing.',
            'kategori' => 'Surat Undangan',
            'departemen' => 'SOSMAS',
            'pengunggah' => 'Shafa',
            'file_path' => 'arsip/contoh.pdf',
            'tanggal_upload' => now(), // <--- tambahkan ini
            // field lain sesuai tabel arsips Anda
        ]);
    }
}