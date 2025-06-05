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
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();
            $table->string('no_nota')->collate();
            $table->date('tanggal_pesanan')->collate();
            $table->date('tanggal_selesai')->collate();
            $table->string('nama_pelanggan')->collate();
            $table->string('alamat')->collate();
            $table->integer('no_hp')->collate();
            $table->string('image')->collate();
            $table->integer('jumlah')->collate();
            $table->integer('total_harga')->collate();
            $table->integer('uang_muka')->collate();
            $table->integer('sisa_pembayaran')->collate();
            $table->string('status_pesanan')->collate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};
