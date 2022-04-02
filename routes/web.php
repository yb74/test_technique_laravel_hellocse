<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CelebrityController;

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
    return view('welcome');
});

Route::get('/celebrities', [CelebrityController::class, 'index']);
Route::post('/celebrities/{id}', [CelebrityController::class, 'showDetails']);

Route::post('/celebrities', [CelebrityController::class, 'createCelebritySheet']);

Route::post('/celebrities/update/{id}', [CelebrityController::class, 'updateCelebritySheet']);

Route::delete('/celebrities/delete/{id}', [CelebrityController::class, 'delete']);

Route::get('/celebrity/{id}', [CelebrityController::class, 'show'])->name('celebrities.show');

Route::get('image/{filename}', [CelebrityController::class, 'show'])->name('image.displayImage');