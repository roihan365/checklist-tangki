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
        Schema::create('checklist_reports', function (Blueprint $table) {
            $table->id();
            $table->string('report_name');
            $table->text('parameters'); // Menyimpan parameter filter (misalnya, tanggal mulai, tanggal selesai)
            $table->string('file_path')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('status')->default('processing'); // processing, completed, failed
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checklist_reports');
    }
};
