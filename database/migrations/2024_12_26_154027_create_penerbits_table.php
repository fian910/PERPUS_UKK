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
        Schema::create('penerbits', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('kode_penerbit', 10)->unique();
            $table->string('nama_penerbit', 100)->unique();
            $table->string('alamat_penerbit', 200);
            $table->string('no_telp', 15);
            $table->string('email', 100);
            $table->string('fax', 15);
            $table->string('website', 100);
            $table->string('kontak', 100);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerbits');
    }
};
