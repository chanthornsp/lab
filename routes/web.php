<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return 'Home';
});

// Rooms
// 1. List all rooms
Route::get('/room', [RoomController::class, 'index'])->name('room.index');
// 2. Create a room
Route::get('/room/create', [RoomController::class, 'create'])->name('room.create');
// 3. show edit form
// 4. Store or Update a room
Route::post('/room/store/{id?}', [RoomController::class, 'store'])->name('room.store');
// 5. Delete a room


// show login page

Route::get('/login', [UserController::class, 'login'])->name('login');

// get login data from user input
Route::post('/login', [UserController::class, 'verifyLogin'])->name('login.verify');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
});




// require __DIR__ . '/auth.php';
