<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class AdminBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::all();
        $categories = Category::all();
        return view('admin.banners.index', compact('banners', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.banners.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'link' => 'max:255',
                'description' => 'nullable|string',
            ]);

            // Kiểm tra và lưu ảnh nếu có
            $imagePath = $request->hasFile('image') ? $request->file('image')->store('images', 'public') : null;

            // Tạo banner
            Banner::create([
                'image' => $imagePath,
                'link' => $request->link,
                'description' => $request->description,
            ]);

            return redirect()->route('admin.banners.index')->with('success', 'Tạo mới banner thành công.');
        } catch (\Exception $e) {
            return redirect()->route('admin.banners.index')->with('error', 'Tạo banner thất bại với lỗi: ' . $e->getMessage());
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
        try {
            $banner = Banner::findOrFail($id);
            $categories = Category::all();
            return view('admin.banners.edit', compact('banner', 'categories'));
        } catch (\Exception $e) {
            return redirect()->route('admin.banners.index')->with('error', 'Banner not found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $banner = Banner::findOrFail($id);
            if ($banner->image) {
                Storage::disk('public')->delete($banner->image);
            }
            $banner->delete();
            return redirect()->route('admin.banners.index')->with('success', 'Xóa banner thành công');

        } catch (\Exception $e) {
            return redirect()->route('admin.banners.index')->with('error', 'Xóa banner thất bại với lỗi: ' . $e->getMessage());
        }
    }
}
