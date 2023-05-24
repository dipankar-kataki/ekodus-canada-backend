<?php

use App\Http\Controllers\Api\Blog\BlogApiController;
use App\Http\Controllers\Candidate\CandidateController;
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

Route::group(['prefix' => 'candidate'], function(){
    Route::post('register', [CandidateController::class, 'register']);
});

Route::group(['prefix' => 'blogs'], function(){
    Route::get('get', [BlogApiController::class, 'getBlogs']);
    Route::get('details', [BlogApiController::class, 'getBlogs']);
});
