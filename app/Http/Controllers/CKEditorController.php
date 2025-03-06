<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CKEditorController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            // Lấy file từ request
            $file = $request->file('upload');

            // Xác định loại file (ảnh hoặc video)
            $extension = $file->getClientOriginalExtension();
            $allowedImageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            $allowedVideoExtensions = ['mp4', 'mov', 'avi', 'wmv'];

            // Kiểm tra loại file hợp lệ
            if (in_array($extension, $allowedImageExtensions)) {
                $folder = 'public/uploads/images';
            } elseif (in_array($extension, $allowedVideoExtensions)) {
                $folder = 'public/uploads/videos';
            } else {
                return response()->json(["error" => ["message" => "Loại file không được hỗ trợ!"]]);
            }

            // Tạo tên file duy nhất
            $filename = time() . '_' . $file->getClientOriginalName();

            // Lưu file vào thư mục storage/public/uploads/...
            $path = $file->storeAs($folder, $filename);

            // Trả về URL để CKEditor hiển thị file
            return response()->json([
                "url" => Storage::url($path)
            ]);
        }

        return response()->json(["error" => ["message" => "Không thể upload file!"]]);
    }
}
