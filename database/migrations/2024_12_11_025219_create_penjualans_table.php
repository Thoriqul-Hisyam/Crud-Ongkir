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
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sales');
            $table->integer('nilai_omset');
            $table->string('nama_customer');
            $table->string('produk');
            $table->foreignId('province_id');
            $table->foreignId('city_id');
            $table->string('courier');
            $table->integer('berat');
            $table->bigInteger('ongkir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};
