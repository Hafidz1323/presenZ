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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('shift_id')->nullable()->constrained('shifts')->nullOnDelete();
            
            $table->dateTime('check_in_time')->nullable();
            $table->dateTime('check_out_time')->nullable();
            
            $table->string('check_in_photo')->nullable();
            $table->string('check_out_photo')->nullable();
            
            $table->decimal('check_in_lat', 10, 8)->nullable();
            $table->decimal('check_in_long', 11, 8)->nullable();
            
            $table->decimal('check_out_lat', 10, 8)->nullable();
            $table->decimal('check_out_long', 11, 8)->nullable();
            
            $table->string('check_in_ip', 45)->nullable();
            $table->string('check_out_ip', 45)->nullable();
            
            $table->string('check_in_device')->nullable();
            $table->string('check_out_device')->nullable();
            
            $table->enum('status', ['Hadir', 'Terlambat', 'Alpha', 'Izin', 'Sakit', 'Cuti'])->default('Alpha');
            $table->text('notes')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['user_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
