<?php

use App\Http\Controllers\Main\KelasController;
use App\Http\Controllers\Main\MajorController;
use App\Http\Controllers\Main\PermissionController;
use App\Http\Controllers\Main\RoleController;
use App\Http\Controllers\Main\UserController;
use App\Http\Controllers\Main\YearController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('splade')->group(function () {
    // Registers routes to support the interactive components...
    Route::spladeWithVueBridge();

    // Registers routes to support password confirmation in Form and Link components...
    Route::spladePasswordConfirmation();

    // Registers routes to support Table Bulk Actions and Exports...
    Route::spladeTable();

    // Registers routes to support async File Uploads with Filepond...
    Route::spladeUploads();

    Route::get('/', function () {
        return view('welcome');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['verified'])->name('dashboard');

        // Route User
        Route::resource('/users', UserController::class);

        // Route Role
        Route::resource('/roles', RoleController::class);

        // Route Major
        Route::resource('majors', MajorController::class);

        // Route Year
        Route::resource('/years', YearController::class);
        
        // Route Class
        Route::prefix('/kelases')->name('kelases.')->group(function() {
            Route::get('/', [KelasController::class, 'index'])->name('index');
            Route::get('/create', [KelasController::class, 'create'])->name('create');
            Route::post('/create', [KelasController::class, 'store'])->name('store');
            Route::get('/edit/{kelas}', [KelasController::class, 'edit'])->name('edit');
            Route::put('/edit/{kelas}', [KelasController::class, 'update'])->name('update');
            Route::delete('/delete/{kelas}', [KelasController::class, 'destroy'])->name('destroy');
        });

        // Route permission
        Route::resource('/permissions', PermissionController::class);
        Route::delete('/{role}/permission/{permission}', [RoleController::class, 'deletePermission'])->name('roles.remove_permission');

        // Route Profile
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__.'/auth.php';
});
