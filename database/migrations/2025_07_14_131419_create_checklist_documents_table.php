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
        Schema::create('checklist_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('checklist_schedule_id')->constrained('checklist_schedules')->onDelete('cascade');
            $table->foreignId('vehicle_id')->constrained('tank_trucks')->onDelete('cascade');
            $table->foreignId('petugas_id')->constrained('users')->onDelete('cascade'); 
            $table->string('status'); // e.g., 'completed', 'rejected'
            $table->string('file_path'); // Path to the document file
            $table->string('catatan')->nullable(); // Additional notes or comments
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checklist_documents');
    }
};
