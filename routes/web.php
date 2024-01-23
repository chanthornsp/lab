<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckLogin;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\RedirectToDashboardIfLogedin;
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



Route::middleware('checkAuth')->group(function () {

    Route::prefix('/room')->controller(RoomController::class)->name('room.')->group(function () {
        // Rooms
        // 1. List all roomsuser@email.com
        Route::get('/',  'index')->name('index');
        // 2. Create a room
        Route::get('/create',  'create')->name('create');
        // 3. show edit form

        Route::get('/edit/{id}',  'edit')->name('edit');

        // 4. Store or Update a room
        Route::post('/store/{id?}',  'store')->name('store');
        // 5. Delete a room

    });


    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);
});



// show login page

Route::get('/login', [UserController::class, 'login'])
    ->middleware(RedirectToDashboardIfLogedin::class)
    ->name('login');

// get login data from user input
Route::post('/login', [UserController::class, 'verifyLogin'])->name('login.verify');



Route::get('/is-admin', function () {
    dd(auth()->guard('admin')->user());
})->middleware(IsAdmin::class);





// require __DIR__ . '/auth.php';
