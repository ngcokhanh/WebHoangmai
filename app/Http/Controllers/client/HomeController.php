<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Post;
use App\Models\Introduction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $intros = Introduction::where('is_home', 1)->latest()->limit(3)->get();
        $banners = Banner::all();
        $categories = Category::all(); // Lấy 7 category mới nhất
        $posts = Post::where('is_published', '1')
            ->orderBy('created_at', 'desc') // Sắp xếp theo thời gian tạo mới nhất
            ->limit(4) // Giới hạn 4 bài viết
            ->get();
        return view('Client.Home', compact('banners', 'categories', 'posts', 'intros'));
    }

    public function postdetail($id)
    {
        $categories = Category::all();
        $post = Post::findOrFail($id);
        return view('Client.Postdetail', compact('post', 'categories'));
    }

    public function category($id)
    {
        $categories = Category::all();
        $category = Category::findOrFail($id);
        $posts = Post::where('category_id', $id)
            ->where('is_published', '1')
            ->orderBy('created_at', 'desc')
            ->paginate(6);
        return view('Client.Category', compact('category', 'posts', 'categories'));
    }

    public function gioithieu()
    {
        $intros = Introduction::where('is_home', 1)->latest()->get();
        $categories = Category::all();
        return view('Client.Gioithieu', compact('intros', 'categories'));
    }

    public function viewLogin()
    {
        $categories = Category::all();
        return view('Client.Login', compact('categories'));
    }

    public function viewRegister()
    {
        $categories = Category::all();
        return view('Client.Register', compact('categories'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('home')->with('success', 'Đăng nhập thành công');
        }
        return back()->with('error', 'Đăng nhập thất bại, vui lòng kiểm tra lại thông tin');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('login')->with('success', 'Đăng ký thành công. Vui lòng đăng nhập.');
        } catch (\Exception $e) {
            return back()->with('error', 'Đăng ký thất bại vui lòng kiểm tra lại thông tin');
        }
    }

    public function detailaccount()
    {
        $categories = Category::all();
        $user = Auth::user(); // Lấy thông tin người dùng đã đăng nhập

        if (!$user) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để xem thông tin tài khoản.');
        }

        return view('Client.Account', compact('categories', 'user'));
    }
}
