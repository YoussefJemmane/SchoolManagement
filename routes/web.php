<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
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


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
        Route::get('/admin/{admin}', [AdminController::class, 'show'])->name('admin.show');
        Route::post('/admin', [AdminController::class, 'store'])->name('admin.store');
        Route::get('/admin/{admin}/edit', [AdminController::class, 'edit'])->name('admin.edit');
        Route::put('/admin/{admin}', [AdminController::class, 'update'])->name('admin.update');
        Route::delete('/admin/{admin}', [AdminController::class, 'destroy'])->name('admin.destroy');
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/student', [StudentController::class, 'index'])->name('student.index');
        Route::get('/student/create', [StudentController::class, 'create'])->name('student.create');
        Route::post('/student', [StudentController::class, 'store'])->name('student.store');
        Route::get('/student/{student}', [StudentController::class, 'show'])->name('student.show');
        Route::get('/student/{student}/edit', [StudentController::class, 'edit'])->name('student.edit');
        Route::put('/student/{student}', [StudentController::class, 'update'])->name('student.update');
        Route::delete('/student/{student}', [StudentController::class, 'destroy'])->name('student.destroy');
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/enseignant', [EnseignantController::class, 'index'])->name('enseignant.index');
        Route::get('/enseignant/create', [EnseignantController::class, 'create'])->name('enseignant.create');
        Route::get('/enseignant/{enseignant}', [EnseignantController::class, 'show'])->name('enseignant.show');
        Route::post('/enseignant', [EnseignantController::class, 'store'])->name('enseignant.store');
        Route::get('/enseignant/{enseignant}/edit', [EnseignantController::class, 'edit'])->name('enseignant.edit');
        Route::put('/enseignant/{enseignant}', [EnseignantController::class, 'update'])->name('enseignant.update');
        Route::delete('/enseignant/{enseignant}', [EnseignantController::class, 'destroy'])->name('enseignant.destroy');
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/library', [LibraryController::class, 'index'])->name('library.index');
        Route::get('/library/create', [LibraryController::class, 'create'])->name('library.create');
        Route::get('/library/{library}', [LibraryController::class, 'show'])->name('library.show');
        Route::post('/library', [LibraryController::class, 'store'])->name('library.store');
        Route::get('/library/{library}/edit', [LibraryController::class, 'edit'])->name('library.edit');
        Route::put('/library/{library}', [LibraryController::class, 'update'])->name('library.update');
        Route::delete('/library/{library}', [LibraryController::class, 'destroy'])->name('library.destroy');
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/book', [BookController::class, 'index'])->name('book.index');
        Route::post('/book/{library}', [BookController::class, 'store'])->name('book.store');
        Route::get('/book/create/{library}', [BookController::class, 'create'])->name('book.create');
        Route::get('/book/{book}/{library}', [BookController::class, 'show'])->name('book.show');
        Route::get('/book/{book}/edit/{library}', [BookController::class, 'edit'])->name('book.edit');
        Route::put('/book/{book}/{library}', [BookController::class, 'update'])->name('book.update');
        Route::delete('/book/{book}/{library}', [BookController::class, 'destroy'])->name('book.destroy');
    });
});

require __DIR__ . '/auth.php';
