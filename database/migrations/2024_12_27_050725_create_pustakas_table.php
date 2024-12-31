<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Ddc;
use App\Models\Format;
use App\Models\Penerbit;
use App\Models\Pengarang;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pustakas', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('kode_pustaka');
            $table->foreignIdFor(Ddc::class)->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignIdFor(Format::class)->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignIdFor(Penerbit::class)->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignIdFor(Pengarang::class)->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('isbn', 20);
            $table->string('judul_pustaka', 100);
            $table->string('tahun_terbit', 5);
            $table->string('keyword', 50);
            $table->string('keterangan_fisik', 100);
            $table->string('keterangan_tambahan', 100);
            $table->longText('abstraksi');
            $table->longText('gambar');
            $table->integer('harga_buku');
            $table->string('kondisi_buku', 15);
            $table->enum('rp', ['0', '1']);
            $table->tinyInteger('jml_pinjam');
            $table->integer('denda_terlambat');
            $table->integer('denda_hilang');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pustakas');
    }
};
