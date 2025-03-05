<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Introduction;
use Illuminate\Support\Facades\Storage;

class AdminIntroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $intros = Introduction::all();
        return view('admin.introductions.index', compact('intros'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.introductions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'required',
            'is_home' => 'required|boolean',
            'video' => 'nullable|mimes:mp4,mov,ogg,qt|max:20000',
        ]);

        // Kiểm tra file trước khi lưu
        $videoPath = $request->hasFile('video') ? $request->file('video')->store('videos', 'public') : null;
        $imagePath = $request->hasFile('image') ? $request->file('image')->store('images', 'public') : null;

        // Tạo giới thiệu
        Introduction::create([
            'title' => $request->title,
            'image' => $imagePath,
            'content' => $request->content,
            'is_home' => $request->is_home,
            'video' => $videoPath,
        ]);

        return redirect()->route('admin.intros.index')->with('success', 'Tạo mới giới thiệu thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $intro = Introduction::findOrFail($id);
        return view('admin.introductions.edit', compact('intro'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'required',
            'is_home' => 'required|boolean',
            'video' => 'nullable|mimes:mp4,mov,ogg,qt|max:20000',
        ]);

        $intro = Introduction::findOrFail($id);

        // Kiểm tra và xóa ảnh cũ nếu có ảnh mới được tải lên
        if ($request->hasFile('image')) {
            if ($intro->image) {
                Storage::disk('public')->delete($intro->image); // Xóa ảnh cũ
            }
            $imagePath = $request->file('image')->store('images', 'public'); // Lưu ảnh mới
        } else {
            $imagePath = $intro->image;
        }

        // Kiểm tra và xóa video cũ nếu có video mới được tải lên
        if ($request->hasFile('video')) {
            if ($intro->video) {
                Storage::disk('public')->delete($intro->video); // Xóa video cũ
            }
            $videoPath = $request->file('video')->store('videos', 'public'); // Lưu video mới
        } else {
            $videoPath = $intro->video;
        }

        // Cập nhật thông tin
        $intro->update([
            'title' => $request->title,
            'image' => $imagePath,
            'content' => $request->content,
            'is_home' => $request->is_home,
            'video' => $videoPath,
        ]);

        return redirect()->route('admin.intros.index')->with('success', 'Cập nhật giới thiệu thành công.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $intro = Introduction::findOrFail($id);
            if ($intro->image) {
                Storage::disk('public')->delete($intro->image);
            }
            if ($intro->video) {
                Storage::disk('public')->delete($intro->video);
            }
            $intro->delete();
            return redirect()->route('admin.intros.index')->with('success', 'Xóa giới thiệu thành công.');
        } catch (\Exception $e) {
            return redirect()->route('admin.intros.index')->with('error', 'Xóa giới thiệu thất bại với lỗi: ' . $e->getMessage());
        }
    }
}
