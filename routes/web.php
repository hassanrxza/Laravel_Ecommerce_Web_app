<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return view('pages.home.index');
});

Route::get('/jewellery', function () {
    return view('pages.home.jewellery');
});

Route::get('/contact', function () {
    return view('pages.home.contact-us');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('/redirect', [HomeController::class, 'redirect'])->middleware('auth');
Route::resource('/adminDashboard', AdminController::class)->middleware('auth');
Route::get('/category', [AdminController::class, 'category']);
Route::post('/addCategory', [AdminController::class, 'addCategory']);
Route::post('updateStatus/{id}', [AdminController::class, 'updateStatus']);
Route::resource('/product', ProductController::class);


