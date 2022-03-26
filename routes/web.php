<?php

use App\Http\Controllers\VideoController;
use App\Http\Controllers\VideoListController;
use Illuminate\Support\Facades\DB;
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
    $video_count = DB::table('videos')->count();
    $video_list_count=DB::table('video_lists')->count();
    return view('welcome',compact('video_count','video_list_count'));
});

//Video
Route::get('/video',[VideoController::class,'index'])->name('video.index');
Route::post('/video',[VideoController::class,'store'])->name('video.store');
Route::get('/video/edit/{id}',[VideoController::class,'edit'])->name('video.edit');
Route::post('/video/edit/{id}',[VideoController::class,'update'])->name('video.update');
Route::get('/video/delete/{id}',[VideoController::class,'destroy'])->name('video.delete');
Route::get('/video/activate/{id}',[VideoController::class,'activate'])->name('video.activate');
Route::get('/video/deactivate/{id}',[VideoController::class,'deactivate'])->name('video.deactivate');

//Video List
Route::get('/video-list',[VideoListController::class,'index'])->name('videoList.index');
Route::post('/video-list',[VideoListController::class,'store'])->name('videoList.store');
Route::get('/video-list/edit/{id}',[VideoListController::class,'edit'])->name('videoList.edit');
Route::post('/video-list/edit/{id}',[VideoListController::class,'update'])->name('videoList.update');
Route::get('/video-list/delete/{id}',[VideoListController::class,'destroy'])->name('videoList.delete');

