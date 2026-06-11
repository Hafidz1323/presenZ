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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'hr', 'karyawan'])->default('karyawan')->after('password');
            $table->string('nip')->unique()->nullable()->after('role');
            $table->string('photo')->nullable()->after('nip');
            $table->foreignId('department_id')->nullable()->constrained('departments')->nullOnDelete()->after('photo');
            $table->foreignId('position_id')->nullable()->constrained('positions')->nullOnDelete()->after('department_id');
            $table->string('phone')->nullable()->after('position_id');
            $table->text('address')->nullable()->after('phone');
            $table->boolean('is_active')->default(true)->after('address');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
            $table->dropForeign(['position_id']);
            $table->dropColumn([
                'role', 'nip', 'photo', 'department_id', 'position_id', 'phone', 'address', 'is_active', 'deleted_at'
            ]);
        });
    }
};
