<?php

use App\Http\Controllers\Blog\BlogController;
use App\Http\Controllers\Dashboard\DashboardController;
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
    return view('dashboard.dashboard');
});

Route::group(['prefix' => 'view'], function(){
    Route::get('dashboard', [DashboardController::class, 'viewDashboard'])->name('admin.view.dashboard');
    Route::get('blog/{id?}', [BlogController::class, 'viewBlog'])->name('admin.view.blog');
});
