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
        Schema::table('anggotas', function (Blueprint $table) {
            $table->string('tempat', 20)->nullable()->change();
            $table->date('tgl_lahir')->nullable()->change();
            $table->string('alamat', 50)->nullable()->change();
            $table->string('no_telp', 15)->nullable()->change();
            $table->enum('fa', ['Y', 'T'])->nullable()->change();
            $table->string('keterangan', 45)->nullable()->change();
            $table->string('foto')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anggotas', function (Blueprint $table) {
            $table->string('tempat', 20)->nullable(false)->change();
            $table->date('tgl_lahir')->nullable(false)->change();
            $table->string('alamat', 50)->nullable(false)->change();
            $table->string('no_telp', 15)->nullable(false)->change();
            $table->enum('fa', ['Y', 'T'])->nullable(false)->change();
            $table->string('keterangan', 45)->nullable(false)->change();
            $table->string('foto')->nullable(false)->change();
        });
    }
};
