<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AdminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $posts = Post::all();
        return view('admin.posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'video' => 'nullable|mimes:mp4,mov,ogg,qt|max:50000',
                'content' => 'required',
                'category_id' => 'required|exists:categories,id',
                'is_published' => 'required|boolean',
            ]);

            // Kiểm tra file trước khi lưu
            $imagePath = $request->hasFile('image') ? $request->file('image')->store('images', 'public') : null;
            $videoPath = $request->hasFile('video') ? $request->file('video')->store('videos', 'public') : null;

            // Tạo bài viết
            Post::create([
                'title' => $request->title,
                'image' => $imagePath,
                'video' => $videoPath,
                'content' => $request->content,
                'category_id' => $request->category_id,
                'is_published' => $request->is_published,
                'user_id' => Auth::id(), // Lấy ID của user đang đăng nhập
            ]);

            return redirect()->route('admin.posts.index')->with('success', 'Bài viết đã được thêm thành công.');
        } catch (Exception $e) {
            return redirect()->route('admin.posts.index')->with('error', 'Bài viết tạo không thành công: ' . $e->getMessage());
        }

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
        $post = Post::findOrFail($id);
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video' => 'nullable|mimes:mp4,mov,ogg,qt|max:50000',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'is_published' => 'required|boolean',
        ]);

        $post = Post::findOrFail($id);

        // Xóa ảnh cũ nếu có ảnh mới được tải lên
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image); // Xóa ảnh cũ
            }
            $imagePath = $request->file('image')->store('images', 'public'); // Lưu ảnh mới
        } else {
            $imagePath = $post->image;
        }

        // Xóa video cũ nếu có video mới được tải lên
        if ($request->hasFile('video')) {
            if ($post->video) {
                Storage::disk('public')->delete($post->video); // Xóa video cũ
            }
            $videoPath = $request->file('video')->store('videos', 'public'); // Lưu video mới
        } else {
            $videoPath = $post->video;
        }

        // Cập nhật bài viết
        $post->update([
            'title' => $request->title,
            'image' => $imagePath,
            'video' => $videoPath,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'is_published' => $request->is_published,
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Bài viết đã được cập nhật thành công.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $post = Post::findOrFail($id);

            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            if ($post->video) {
                Storage::disk('public')->delete($post->video);
            }
            $post->delete();
            return redirect()->route('admin.posts.index')->with('success', 'Bài viết đã được xóa thành công.');
        } catch (\Exception $e) {
            return redirect()->route('admin.posts.index')->with('error', 'Xóa bài viết thất bại với lỗi: ' . $e->getMessage());
        }

    }
}
