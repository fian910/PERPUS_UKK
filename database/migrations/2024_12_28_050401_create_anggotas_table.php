<?php

use App\Models\JenisAnggota;
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
        Schema::create('anggotas', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignIdFor(JenisAnggota::class)
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('kode_anggota', 20)->unique();
            $table->string('nama_anggota', 255)->unique();
            $table->string('tempat', 20);
            $table->date('tgl_lahir');
            $table->string('alamat', 50);
            $table->string('no_telp', 15);
            $table->string('email', 30);
            $table->date('tgl_daftar');
            $table->date('masa_aktif');
            $table->enum('fa', ['Y', 'T']);
            $table->string('keterangan', 45);
            $table->longText('foto');
            $table->string('username', 50)->unique();
            $table->string('password', 50);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggotas');
    }
};
