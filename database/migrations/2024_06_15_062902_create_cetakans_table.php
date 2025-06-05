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
        Schema::create('cetakans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_bahan')->collate();
            $table->string('kode_cetakan')->collate();
            $table->string('nama_cetakan')->collate();
            $table->integer('harga_cetakan')->collate();
            $table->string('satuan')->collate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cetakans');
    }
};
