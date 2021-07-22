<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserController;
use App\Models\Image;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $images = Image::orderBy('id', 'desc')->paginate(5);
    return view('dashboard', ['images' => $images]);
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::prefix('user')->group(function () {
    Route::get('config', [UserController::class, 'config'])->name('user.config');
    Route::post('update', [UserController::class, 'update'])->name('user.update');
    Route::get('image/{filename}', [UserController::class, 'getImage'])->name('user.image');
    Route::get('profile/{id}', [UserController::class, 'profile'])->name('user.profile');
    Route::get('users', [UserController::class, 'users'])->name('user.users');
});

Route::prefix('image')->group(function () {
    Route::get('create', [ImageController::class, 'create'])->name('image.create');
    Route::post('store', [ImageController::class, 'store'])->name('image.store');
    Route::get('file/{filename}', [ImageController::class, 'getImage'])->name('image.file');
    Route::get('detail/{id}', [ImageController::class, 'detail'])->name('image.detail');
    Route::get('delete/{image}', [ImageController::class, 'delete'])->name('image.delete');
    Route::get('edit/{image}', [ImageController::class, 'edit'])->name('image.edit');
    Route::post('update/{image}', [ImageController::class, 'update'])->name('image.update');
});

Route::prefix('comment')->group(function () {
    Route::post('store', [CommentController::class, 'store'])->name('comment.store');
    Route::get('delete/{id}', [CommentController::class, 'delete'])->name('comment.delete');
});

Route::prefix('like')->group(function () {
    Route::get('save/{image_id}', [LikeController::class, 'like'])->name('like.save');
    Route::get('delete/{image_id}', [LikeController::class, 'dislike'])->name('like.delete');
    Route::get('likes', [LikeController::class, 'likes'])->name('like.likes');
});
