<?php

use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('posts', PostController::class);

Route::controller(PostController::class)->group(function () {
    Route::get('group/posts/{id}', 'show');
    Route::get('group/posts', 'index');
    Route::post('group/posts', 'store');
    Route::delete('group/posts/{id}', 'destroy');
    Route::put('group/posts/{id}', 'update');
});
