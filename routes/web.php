<?php

use App\Livewire\AccountsController;
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
// }) -> name('index');

//mail24h.store|gmail79.store

Route::get('/', AccountsController::class) -> name('inbox');
Route::get('inbox', AccountsController::class) -> name('inbox');

Route::get('/email/{mail}', [
    AccountsController::class,
    'show' 
]);
