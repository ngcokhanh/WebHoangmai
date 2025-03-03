<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::query()->latest('id')->paginate(5);
        return response()->json(
            [
                'status' => 'success',
                'message' => 'List data category' . request()->page,
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
        $category = Category::query()->create($request->all());
        return response()->json(
            [
                'status' => 'success',
                'message' => 'Data category add successfully',
                'data' => $category
            ],
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $data = Category::query()->findOrFail($id);
            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'Detail data category with id' . $id,
                    'data' => $data
                ],
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Data category not found',
                ],
                404
            );
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::query()->findOrFail($id);
        $category->update($request->all());
        return response()->json(
            [
                'status' => 'success',
                'message' => 'Data category update successfully',
                'data' => $category
            ],
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::query()->findOrFail($id);
        $category->delete();
        return response()->json(
            [
                'status' => 'success',
                'message' => 'Data category delete successfully',
                'data' => $category
            ],
            200
        );
    }
}
