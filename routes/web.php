<?php

use App\Http\Controllers\Blog\BlogController;
use App\Http\Controllers\Candidate\CandidateController;
use App\Http\Controllers\Career\CareerController;
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
    Route::get('blog-details/{id}', [BlogController::class, 'viewBlogDetails'])->name('admin.view.blog.details');
});

Route::group(['prefix' => 'create'], function(){
    Route::post('blog', [BlogController::class, 'createBlog'])->name('admin.create.blog');
});

Route::group(['prefix' => 'edit'], function(){
    Route::post('blog', [BlogController::class, 'editBlog'])->name('admin.edit.blog');
});

Route::group(['prefix' => 'opening'], function(){
    Route::get('all-openings', [CareerController::class, 'viewAllOpenings'])->name('admin.view.all.openings');
    Route::post('create', [CareerController::class, 'createOpening'])->name('admin.create.openings');
    Route::post('change-status', [CareerController::class, 'changeStatus'])->name('admin.change.status');
    Route::get('view/{id}', [CareerController::class, 'viewOpening'])->name('admin.view.opening');
    Route::post('edit', [CareerController::class, 'editOpening'])->name('admin.edit.opening');
});

Route::group(['prefix' => 'candidate'], function(){
    Route::get('all-candidates', [CandidateController::class, 'allCandidates'])->name('admin.all.candidates');
});
