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

Route::get('/', function () { // Displays homepage
    return view('welcome');
});

Route::get('/celebrities', [CelebrityController::class, 'index']); // Displays celebrities list
Route::post('/celebrities/{id}', [CelebrityController::class, 'showDetails']); // send the id of a specific celebrity to the backend (ajax request)

Route::post('/celebrities', [CelebrityController::class, 'createCelebritySheet']); // create a celebrity sheet

Route::post('/celebrities/update/{id}', [CelebrityController::class, 'updateCelebritySheet']); // update a celebrity sheet

Route::delete('/celebrities/delete/{id}', [CelebrityController::class, 'delete']); // delete a celebrity sheet

Route::get('/celebrity/{id}', [CelebrityController::class, 'show'])->name('celebrities.show'); // show the details of a specific celebrity