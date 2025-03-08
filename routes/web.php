<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\client\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AdminUserController;
use App\Http\Controllers\admin\AdminPostController;
use App\Http\Controllers\admin\AdminBannerController;
use App\Http\Controllers\admin\AdminIntroController;
use App\Http\Controllers\admin\AdminCategoryController;
use App\Http\Controllers\CKEditorController;







/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

route::get('gioithieu', [HomeController::class, 'gioithieu'])->name('gioithieu');
Route::get('category/{id}', [HomeController::class, 'category'])->name('category');
route::get('post/{id}', [HomeController::class, 'postdetail'])->name('post.detail');
route::get('login', [HomeController::class, 'viewLogin'])->name('login');
Route::post('/login', [HomeController::class, 'login']); // Xử lý đăng nhập
route::get('register', [HomeController::class, 'viewRegister'])->name('register');
Route::post('register', [HomeController::class, 'register']);
route::get('logout', [HomeController::class, 'logout'])->name('logout');
route::get('account', [HomeController::class, 'detailaccount'])->name('account');


route::get('admin', [AdminController::class, 'index'])->name('admin.dashboard')->middleware('admin');
Route::resource('admin/users', AdminUserController::class)->names([
    'index' => 'admin.users.index',
    'create' => 'admin.users.create',
    'store' => 'admin.users.store',
    'edit' => 'admin.users.edit',
    'update' => 'admin.users.update',
    'destroy' => 'admin.users.destroy'
])->middleware('admin');

Route::resource('admin/posts', AdminPostController::class)->names([
    'index' => 'admin.posts.index',
    'create' => 'admin.posts.create',
    'store' => 'admin.posts.store',
    'edit' => 'admin.posts.edit',
    'update' => 'admin.posts.update',
    'destroy' => 'admin.posts.destroy'
])->middleware('admin');

Route::resource('admin/banners', AdminBannerController::class)->names([
    'index' => 'admin.banners.index',
    'create' => 'admin.banners.create',
    'store' => 'admin.banners.store',
    'edit' => 'admin.banners.edit',
    'update' => 'admin.banners.update',
    'destroy' => 'admin.banners.destroy'
])->middleware('admin');

Route::resource('admin/intros', AdminIntroController::class)->names([
    'index' => 'admin.intros.index',
    'create' => 'admin.intros.create',
    'store' => 'admin.intros.store',
    'edit' => 'admin.intros.edit',
    'update' => 'admin.intros.update',
    'destroy' => 'admin.intros.destroy'
])->middleware('admin');

Route::resource('admin/categories', AdminCategoryController::class)->names([
    'index' => 'admin.categories.index',
    'create' => 'admin.categories.create',
    'store' => 'admin.categories.store',
    'edit' => 'admin.categories.edit',
    'update' => 'admin.categories.update',
    'destroy' => 'admin.categories.destroy'
])->middleware('admin');

route::get('admin/account', [AdminController::class, 'adminaccount'])->name('admin.account')->middleware('admin');

Route::post('/ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.upload');

