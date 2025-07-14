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
        Schema::create('rejecteds', function (Blueprint $table) {

            $table->id('rejected_id')->index();
            $table->unsignedBigInteger('entity_terkait_id');
            $table->dateTime('tanggal_rejected');
            $table->text('alasan_rejected');
            $table->enum('status_rejected',['Ditolak', 'Diterima']);
            $table->text('catatan')->nullable();
            $table->foreignId('user_id')->constrained('users');

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rejecteds');
    }
};
