<?php

use App\Http\Controllers\AnswersController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [QuestionController::class, 'index'])->name('index');
Route::get('/allquestions', [QuestionController::class, 'showall'])->name('showall');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'sendContact']);
Route::resource('questions', QuestionController::class);
Route::resource('answers', AnswersController::class);

Auth::routes();

Route::get('/profile/{user}', [App\Http\Controllers\PageController::class, 'profile'])->name('profile');
Route::get('/upload', [UploadController::class, 'getUpload'])->name('upload');
Route::post('/upload', [UploadController::class, 'postUpload'])->name('upload.post');
Route::get('/upload-complete', function () {
    return view('upload-complete');
})->name('upload.complete');
Route::get('/github/{username}', [ApiController::class, 'github'])->name('github');
Route::get('/weather', [ApiController::class, 'getWeather'])->name('weather');
Route::post('/weather', [ApiController::class, 'postWeather']);
