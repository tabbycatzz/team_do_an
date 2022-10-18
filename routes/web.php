<?php

use App\Http\Controllers\User\Auth\ChangePasswordController;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\User\Auth\ForgotPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\Auth\SocialAccountController;
use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\ContactController;
use App\Http\Controllers\User\Auth\SocialLoginController;

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
    return view('welcome');
});

Route::GET('login', [LoginController::class, 'index'])->name('login');
Route::POST('login', [LoginController::class, 'login'])->name('login_save');

// Login social
Route::GET('login/{social}', [SocialAccountController::class, 'redirectToProvider'])->name('login.redirect_provider');
Route::GET('login/{social}/callback', [SocialAccountController::class, 'handleProviderCallback'])->name('login.handle_provider');

Route::GET('register', [RegisterController::class, 'index'])->name('register');
Route::POST('register', [RegisterController::class, 'register'])->name('register_save');
Route::GET('forgot-password', [ForgotPasswordController::class, 'index'])->name('forgot_password');
Route::POST('forgot-password', [ForgotPasswordController::class, 'findEmail'])->name('forgot_password.find_email');
// Show post details
Route::get('/post/detail/{post}', [PostController::class, 'show'])->name('post.detail');

Route::get('/post/list/{category}', [PostController::class, 'index'])->name('post.index');
Route::get('/post/search', [PostController::class, 'search'])->name('post.search');
Route::GET('/', [HomeController::class, 'index'])->name('dashboard');

Route::group(['middleware' => 'localization'], function() {
    //Contact us
    Route::get('/contact-us', [ContactController::class, 'index'])->name('contact_us');
    Route::post('/contact-us/{language}', [ContactController::class, 'store'])->name('contact_us.store');
});

Route::group(['middleware' => ['auth.user']], function () {
    
    Route::GET('logout', [LoginController::class, 'logout'])->name('logout');

    //post user
    Route::get('/post/new', [PostController::class, 'create'])->name('post.create');
    Route::post('/post/add', [PostController::class, 'store'])->name('post.store');
    Route::get('/findCategoryChildren', [PostController::class, 'findCategoryChildren'])->name('post.find');
    Route::post('/post/upload', [PostController::class, 'upload'])->name('post.upload');

    //User profile
    Route::prefix('/profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile');
        Route::get('/info', [ProfileController::class, 'getUserProfile'])->name('profile.info');
        Route::post('/update', [ProfileController::class, 'updateUserProfile'])->name('profile.update');
        Route::get('post/viewed', [ProfileController::class, 'postUserViewed'])->name('profile.post_viewed');
    });
   
    // comment user
    Route::post('/post/comment', [CommentController::class, 'saveComment'])->name('post.comment');
    Route::delete('/post/comment/{comment}', [CommentController::class, 'deteteComment'])->name('post.delete_comment');
    Route::post('/post/comment/update/{comment}', [CommentController::class, 'updateComment'])->name('post.update_comment');

    //change password
    Route::GET('/profile/change-password', [ChangePasswordController::class, 'changePassword'])->name('change_password');
    Route::POST('/profile/update-password', [ChangePasswordController::class, 'saveNewPassword'])->name('change_password.save');
});
