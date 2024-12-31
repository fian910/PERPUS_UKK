<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Rak;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ddcs', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignIdFor(Rak::class)->constrained()->onDelete('cascade');
            $table->string('kode_ddc', 10)->unique();
            $table->string('ddc', 50)->unique();
            $table->string('keterangan', 100);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ddcs');
    }
};
