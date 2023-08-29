<?php

use App\Http\Controllers\CropImageController;
use App\Http\Controllers\TutorialController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', [CropImageController::class, 'index'])->name('home');
Route::post('/crop-image-upload-ajax', [CropImageController::class, 'cropImageUploadAjax'])->name('crop-image-upload-ajax');

//view form
Route::get('/create', [CropImageController::class, 'create'])->name('form.add');

// Create
Route::post('/crop-image-upload', [CropImageController::class, 'store'])->name('store');

// view list
Route::get('/', [CropImageController::class, 'index'])->name('form.index');

// Update (Edit and Update)
Route::get('/form/{id}/edit', [CropImageController::class, 'edit'])->name('form.edit');
Route::put('/form/{id}', [CropImageController::class, 'update'])->name('form.update');

// Delete
Route::delete('/form/{id}', [CropImageController::class, 'destroy'])->name('form.destroy');

// Route::get('crop-image', [CropImageController::class, 'index'])->name('image.index');
// Route::get('crop-image/create', [CropImageController::class, 'create'])->name('image.create');
// Route::post('crop-image-upload-ajax', [CropImageController::class, 'store'])->name('crop-image-upload-ajax');

