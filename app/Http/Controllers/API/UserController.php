<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;
use App\Models\User;
use PhpParser\Node\Expr\Instanceof_;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = user::query()->latest('id')->paginate(5);
        return response()->json(
            [
                'status' => 'success',
                'message' => 'List data user' . request()->page,
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
        $user = User::query()->create($request->all());

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Data user add successfully',
                'data' => $user
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
            $data = user::query()->findOrFail($id);
            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'Detail data user with id' . $id,
                    'data' => $data
                ],
                200
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Data user not found with id ' . $id,
                    'data' => null
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
        $user = User::query()->findOrFail($id);
        $user->update(request()->all());
        return response()->json(
            [
                'status' => 'success',
                'message' => 'Data user update successfully',
                'data' => $user
            ],
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::query()->findOrFail($id)->delete();
        return response()->json(
            [
                'status' => 'success',
                'message' => 'Data user delete successfully',
                'data' => null
            ],
            200
        );
    }
}
