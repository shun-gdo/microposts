<?php

// use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsersController;
use App\Http\Controllers\MicropostsController;
use App\Http\Controllers\UserFollowController; 
use App\Http\Controllers\FavoritePostsController; 
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

Route::get('/',[MicropostsController::class,'index']);

Route::get('/dashboard',[MicropostsController::class,'index'])
->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    
    Route::prefix('users/{id}')->group(function () {
        Route::post('follow', [UserFollowController::class, 'store'])->name('user.follow');
        Route::delete('unfollow', [UserFollowController::class, 'destroy'])->name('user.unfollow');
        Route::get('followings', [UsersController::class, 'followings'])->name('users.followings');
        Route::get('followers', [UsersController::class, 'followers'])->name('users.followers');
        Route::get('favorites', [UsersController::class, 'favorites'])->name('users.favorites');
    });

    Route::resource('users',UsersController::class,['only' => ['index','show']]);
    Route::resource('microposts',MicropostsController::class,['only' => ['store','destroy']]);
    Route::resource('favorites',FavoritePostsController::class,['only' => ['store','destroy']])->names(['favorites.store','favorites.destroy']);
    
});

require __DIR__.'/auth.php';
