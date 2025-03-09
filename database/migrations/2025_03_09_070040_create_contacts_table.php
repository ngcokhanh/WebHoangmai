<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id(); // Khóa chính tự tăng
            $table->string('name'); // Tên
            $table->string('email')->index(); // Email có thể trùng
            $table->text('content'); // Nội dung
            $table->string('phone', 20); // Số điện thoại
            $table->string('linkface')->nullable(); // Link Facebook (có thể null)
            $table->string('address'); // Địa chỉ
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
