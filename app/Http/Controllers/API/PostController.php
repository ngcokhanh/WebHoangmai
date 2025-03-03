<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Post::query()->latest('id')->paginate(5);
        return response()->json(
            [
                'status' => 'success',
                'message' => 'List data post' . request()->page,
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
                'title' => 'required|string|max:255',
                'content' => 'nullable',
                'category_id' => 'required|exists:categories,id',
                'is_published' => 'required|boolean',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'video' => 'nullable|mimes:mp4,mov,avi,wmv|max:512000',
                'user_id' => 'required|exists:users,id',
            ]);

            if ($request->hasFile('image')) {
                $validatedData['image'] = $request->file('image')->store('posts', 'public');
            }

            if ($request->hasFile('video')) {
                $validatedData['video'] = $request->file('video')->store('posts', 'public');
            }

            $post = Post::create($validatedData);

            return response()->json([
                'status' => 'success',
                'message' => 'Post created successfully',
                'data' => $post
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create post',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $data = Post::findOrFail($id); // Tìm bài viết, nếu không có sẽ ném lỗi

            return response()->json([
                'status' => 'success',
                'message' => 'Detail data post with id ' . $id,
                'data' => $data
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Post not found',
                'error' => $e->getMessage()
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $post = Post::findOrFail($id);

            $validatedData = $request->validate([
                'title' => 'sometimes|required|string|max:255',
                'content' => 'nullable',
                'category_id' => 'sometimes|required|exists:categories,id',
                'is_published' => 'sometimes|required|boolean',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'video' => 'nullable|mimes:mp4,mov,avi,wmv|max:512000',
                'user_id' => 'sometimes|required|exists:users,id',
            ]);

            if ($request->hasFile('image')) {

                if ($post->image) {
                    Storage::disk('public')->delete($post->image);
                }
                $validatedData['image'] = $request->file('image')->store('posts', 'public');
            }

            if ($request->hasFile('video')) {

                if ($post->video) {
                    Storage::disk('public')->delete($post->video);
                }
                $validatedData['video'] = $request->file('video')->store('posts', 'public');
            }

            $post->update($validatedData);
            return response()->json([
                'status' => 'success',
                'message' => 'Post updated successfully',
                'data' => $post
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Post not found',
                'error' => $e->getMessage()
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update post',
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
            $post = Post::findOrFail($id);

            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }


            if ($post->video) {
                Storage::disk('public')->delete($post->video);
            }


            $post->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Post deleted successfully',
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Post not found',
                'error' => $e->getMessage()
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete post',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
