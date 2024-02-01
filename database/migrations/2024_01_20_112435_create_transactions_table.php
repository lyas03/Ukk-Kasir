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
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id_transaksi');
            $table->integer('id_produk');
            $table->integer('total_item');
            $table->integer('total_harga');
            $table->string('nama_pelanggan', 45);
            $table->string('nomor_unik', 45);
            $table->integer('meja')->nullable();
            $table->integer('uang_bayar');
            $table->integer('uang_kembali');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
