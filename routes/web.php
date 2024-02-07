<?php

use App\Http\Controllers\ComputerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\StatusController;
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
    return redirect()->route('dashboard');
});



Route::middleware('checkAuth')->group(function () {

    Route::prefix('/room')
        ->controller(RoomController::class)
        ->name('room.')->group(function () {
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

            Route::delete('/delete/{id}', 'destroy')->name('destroy');


            Route::post('/update/{id}', 'update')->name('update');
        });

    Route::prefix('/status')->controller(StatusController::class)
        ->name('status.')
        ->group(function () {
            // your code here
            // list status and create or edit form

            Route::get('/', 'index')->name('index');

            // store or update status
            Route::post('/store/{id?}', 'store')->name('store');

            Route::get('/edit/{id}', 'edit')->name('edit');

            // delete status
            Route::delete('/delete/{id}', 'destroy')->name('destroy');
        });


    // logout
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    // computer
    Route::resource('/computer', ComputerController::class);





    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
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
