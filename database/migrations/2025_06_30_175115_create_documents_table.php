<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Schema;
use League\CommonMark\Reference\Reference;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dokuments', function (Blueprint $table) {

            $table->id('dokumen_id')->index();
            $table->string('judul_dokumen');
            $table->dateTime('tanggal_upload');
            $table->string('tipe_dokumen');
            $table->integer('ukuran_dokumen');
            $table->string('path_file');
            $table->text('deskripsi')->nullable();
            $table->enum('status_dokumen', ['Aktif', 'Non-Aktif']);
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
        Schema::dropIfExists('dokuments');
    }
};
