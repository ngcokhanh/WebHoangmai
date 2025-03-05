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
        Schema::create('introductions', function (Blueprint $table) {
            $table->id(); // Khóa chính tự động tăng
            $table->string('title'); // Tiêu đề giới thiệu
            $table->text('content'); // Nội dung giới thiệu
            $table->string('image')->nullable(); // Đường dẫn ảnh (có thể null)
            $table->string('video')->nullable(); // Đường dẫn video (có thể null)
            $table->timestamps(); // Thời gian tạo & cập nhật
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('introductions');
    }
};
