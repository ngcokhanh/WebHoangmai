<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Banner::query()->latest('id')->paginate(5);
        return response()->json(
            [
                'status' => 'success',
                'message' => 'List data banner' . request()->page,
                'data' => $data
            ],
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'is_published' => 'required|boolean',
                'link' => 'nullable|url',
                'description' => 'nullable|string'
            ]);

            if ($request->hasFile('image')) {
                $validatedData['image'] = $request->file('image')->store('banners', 'public');
            }

            $banner = Banner::query()->create($validatedData);

            return response()->json([
                'status' => 'success',
                'message' => 'Data banner added successfully',
                'data' => $banner
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add banner',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Banner::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Detail data banner with id ' . $id,
            'data' => $data
        ], 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $banner = Banner::findOrFail($id);

            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|nullable',
                'is_published' => 'required|boolean',
                'link' => 'nullable|url',
                'description' => 'nullable|string'
            ]);

            $dataToUpdate = $request->only(['is_published', 'link', 'description']);

            if ($request->hasFile('image')) {
                Storage::disk('public')->delete($banner->image);
                $dataToUpdate['image'] = $request->file('image')->store('banners', 'public');
            }

            if (!empty(array_diff_assoc($dataToUpdate, $banner->toArray()))) {
                $banner->update($dataToUpdate);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Data banner update successfully',
                'data' => $banner
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data banner not found',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $banner = Banner::query()->findOrFail($id);
            if ($banner->image) {
                Storage::disk('public')->delete($banner->image);
            }
            $banner->delete();
            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'Data banner delete successfully',
                    'data' => $banner
                ],
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Data banner not found',
                ],
                404
            );

        }

    }
}
