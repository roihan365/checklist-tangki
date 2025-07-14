<?php

use App\Models\Histories;
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
        Schema::create('histories', function (Blueprint $table) {

            $table->id('histories_id')->index();
            $table->string('jenis_aksi');
            $table->dateTime('waktu_aksi');
            $table->text('keterangan')->nullable();
            $table->foreignId('dokumen_id')->constrained('dokuments', 'dokumen_id');
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
        Schema::dropIfExists('histories');
    }
};
