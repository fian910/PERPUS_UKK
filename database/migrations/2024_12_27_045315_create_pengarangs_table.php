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
        Schema::create('pengarangs', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('kode_pengarang', 10)->unique();
            $table->string('gelar_depan', 20);
            $table->string('nama_pengarang', 100)->unique();
            $table->string('gelar_belakang', 20);
            $table->string('no_telp', 15);
            $table->string('email', 100);
            $table->string('website', 100);
            $table->longText('biografi');
            $table->string('keterangan', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengarangs');
    }
};
