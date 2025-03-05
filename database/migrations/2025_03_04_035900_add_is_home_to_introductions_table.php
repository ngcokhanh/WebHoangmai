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
        Schema::table('introductions', function (Blueprint $table) {
            $table->boolean('is_home')->default(false)->after('video'); // Thêm cột is_home với giá trị mặc định là false
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('introductions', function (Blueprint $table) {
            $table->dropColumn('is_home'); // Xóa cột khi rollback migration
        });
    }
};
