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
        Schema::create('cetaks', function (Blueprint $table) {
            $table->id();

            $table->string('cetak_id')->index();
            $table->dateTime('tanggal_cetak');
            $table->string('jumlah_halaman');
            $table->enum('status_cetak',['Selesai', 'Belum Selesai']);
            $table->text('keterangan');
            $table->foreignId('user_id');
            $table->foreignId('dokumen_id');

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cetaks');
    }
};
