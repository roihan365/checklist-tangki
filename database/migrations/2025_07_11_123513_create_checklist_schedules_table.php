<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('checklist_schedules', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->time('waktu');
            $table->string('lokasi');
            $table->foreignId('distributor_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('vehicle_id')->constrained('tank_trucks')->onDelete('cascade');
            $table->enum('jenis_layanan', ['checklist_harian', 'checklist_mingguan', 'rejected']);
            $table->enum('status', ['terjadwal', 'dalam_proses', 'selesai', 'dibatalkan']);
            $table->text('catatan')->nullable();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('checklist_schedules');
    }
};
