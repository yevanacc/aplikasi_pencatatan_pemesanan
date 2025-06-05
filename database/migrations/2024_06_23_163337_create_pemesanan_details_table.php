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
        Schema::create('pemesanan_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemesanan_id')->constrained('pemesanans');
            $table->string('nama_bahan')->collate();
            $table->integer('kode_cetakan')->collate();
            $table->string('jenis_cetakan')->collate();
            $table->integer('harga_cetakan')->collate();
            $table->string('satuan')->collate();
            $table->string('ukuran')->collate();
            $table->integer('panjang')->collate();
            $table->integer('lebar')->collate();
            $table->integer('jumlah_banner')->collate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan_details');
    }
};
