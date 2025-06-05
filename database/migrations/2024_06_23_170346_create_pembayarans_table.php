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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->string('no_nota')->collate();
            $table->string('kode_pembayaran')->collate();
            $table->string('nama_pelanggan')->collate();
            $table->string('alamat')->collate();
            $table->string('no_hp')->collate();
            $table->date('tanggal_pesanan')->collate();
            $table->date('tanggal_selesai')->collate();
            $table->date('tanggal_bayar')->collate();
            $table->integer('total_harga')->collate();
            $table->integer('uang_muka')->collate();
            $table->integer('sisa_pembayaran')->collate();
            $table->integer('jumlah_pembayaran')->collate();
            $table->string('status_pembayaran')->collate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
