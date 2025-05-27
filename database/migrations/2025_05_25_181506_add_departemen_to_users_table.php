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
    Schema::table('users', function (Blueprint $table) {
        $table->enum('departemen', ['DPH','MBA', 'PPM', 'PKM', 'ADM', 'KEAGAMAAN', 'HUAL', 'SOSMAS', 'KOMINKRAF'])->after('role')->nullable();
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('departemen');
    });
}
};
