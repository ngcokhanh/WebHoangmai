<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate dữ liệu đầu vào
            $validate = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
                'role' => 'required|in:admin,client', // Kiểm tra role hợp lệ
                'phone' => 'nullable|numeric',
                'address' => 'nullable|string|max:255',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Xử lý avatar nếu có
            $avatarPath = $request->hasFile('avatar')
                ? $request->file('avatar')->store('avatars', 'public')
                : null;

            // Tạo user mới
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password), // Mã hóa password
                'role' => $request->role,
                'phone' => $request->phone,
                'address' => $request->address,
                'avatar' => $avatarPath, // Lưu đường dẫn avatar
            ]);

            // Chuyển hướng về danh sách user với thông báo thành công
            return redirect()->route('admin.users.index')->with('success', 'Người dùng đã được tạo thành công.');

        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput(); // Trả về lỗi validate chi tiết
        } catch (\Exception $e) {
            return redirect()->route('admin.users.create')->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
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
        //
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
            $user = User::findOrFail($id);
    
            // Kiểm tra nếu user đang đăng nhập thì không cho xóa
            if (Auth::id() == $user->id) {
                return redirect()->route('admin.users.index')->with('error', 'Bạn không thể xóa tài khoản của chính mình.');
            }
    
            // Kiểm tra nếu user có role là 'admin' thì không cho xóa
            if ($user->role === 'admin') {
                return redirect()->route('admin.users.index')->with('error', 'Bạn không thể xóa tài khoản admin.');
            }
    
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', 'Người dùng đã được xóa thành công.');
        } catch (\Exception $e) {
            return redirect()->route('admin.users.index')->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
        }
    }
    

}
