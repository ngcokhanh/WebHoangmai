<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('admin.dashboard', compact('user'));
    }

    public function adminaccount(){
        $user = Auth::user();
        return view('admin.adminaccount', compact('user'));
    }
}
