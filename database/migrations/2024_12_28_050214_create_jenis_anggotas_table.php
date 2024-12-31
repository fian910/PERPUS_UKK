<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jenis_anggotas', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('kode_jenis_anggota', 2);
            $table->string('jenis_anggota', 15);
            $table->string('max_pinjam', 5);
            $table->string('keterangan', 50);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_anggotas');
    }
};
