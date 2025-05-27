<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('arsips', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->text('deskripsi');
        $table->enum('kategori', ['Surat Undangan', 'Surat Peminjaman', 'Proposal', 'LPJ']);
        $table->string('nomor_surat')->nullable();
        $table->enum('departemen', ['DPH','MBA', 'PPM', 'PKM', 'ADM', 'KEAGAMAAN', 'HUAL', 'SOSMAS', 'KOMINKRAF']);
        $table->string('pengunggah');
        $table->string('file_path');
        $table->timestamp('tanggal_upload')->useCurrent();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsips');
    }
};
