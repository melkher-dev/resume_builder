<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ResumeController;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/resume', [ResumeController::class, 'resume'])->name('resume');
Route::post('/upload', [ResumeController::class, 'upload'])->name('upload');
Route::get('/resume/show/{id}', [ResumeController::class, 'show'])->name('resume.show');

Route::get('/images/{filename}', [ImageController::class, 'show'])->name('images.show');
