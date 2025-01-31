<?php

use App\Models\Pustaka;
use App\Models\Anggota;
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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignIdFor(Pustaka::class)
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignIdFor(Anggota::class)
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->date('tgl_pinjam');
            $table->date('tgl_kembali');
            $table->date('tgl_pengembalian')->nullable();
            $table->enum('fp', ['0', '1'])->default('0');
            $table->string('keterangan', 5)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
