<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tank_trucks', function (Blueprint $table) {
            $table->id();
            $table->string('plat_nomor')->unique();
            $table->string('nomor_lambung');
            $table->string('jenis_kendaraan');
            $table->string('merk');
            $table->string('tipe');
            $table->integer('tahun_pembuatan');
            $table->string('warna');
            $table->decimal('kapasitas', 8, 2); // dalam liter
            $table->string('nomor_rangka');
            $table->string('nomor_mesin');
            $table->foreignId('distributor_id')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['aktif', 'nonaktif', 'dalam_perbaikan'])->default('aktif');
            $table->date('tanggal_aktif')->nullable();
            $table->date('tanggal_nonaktif')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tank_truck_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tank_truck_id')->constrained()->onDelete('cascade');
            $table->string('jenis_dokumen');
            $table->string('nomor_dokumen');
            $table->date('tanggal_terbit');
            $table->date('tanggal_kadaluarsa');
            $table->string('file_path');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('catatan')->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();
        });

        Schema::create('tank_truck_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tank_truck_id')->constrained()->onDelete('cascade');
            $table->string('aktivitas');
            $table->text('deskripsi');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->json('metadata')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tank_truck_histories');
        Schema::dropIfExists('tank_truck_documents');
        Schema::dropIfExists('tank_trucks');
    }
};
