<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});



Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'authenticate']);
Route::get('articles',  [ArticleController::class, 'index']);

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('user', [UserController::class, 'getAuthenticatedUser']);
    // Articles
    Route::get('articles/{article}', [ArticleController::class, 'show']);
    Route::post('articles',   [ArticleController::class, 'store']);
    Route::put('articles/{article}',   [ArticleController::class, 'update']);
    Route::delete('articles/{article}',  [ArticleController::class, 'delete']);

    // Comments
    Route::get('articles/{article}/comments', [CommentController::class, 'index']);
    Route::get('articles/{article}/comments/{comment}',   [CommentController::class, 'show']);
    Route::post('articles/{article}/comments',   [CommentController::class, 'store']);
    Route::put('articles/{article}/comments/{comment}',   [CommentController::class, 'update']);
    Route::delete('articles/{article}/comments/{comment}',  [CommentController::class, 'delete']);
});
