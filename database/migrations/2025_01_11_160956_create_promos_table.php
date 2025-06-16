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
        Schema::create('promos', function (Blueprint $table) {
            $table->id('promo_id');
            $table->unsignedBigInteger('product_id');
            $table->string('jenis_promo');
            $table->string('deskripsi_promo');
            $table->date('tanggal_mulai');
            $table->date('tanggal_akhir');
            $table->decimal('diskon');
            $table->foreign('product_id')->references('product_id')->on('products')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promos');
    }
};
