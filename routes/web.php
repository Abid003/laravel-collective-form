<?php

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

Route::get('/', [StudentController::class, 'home'])->name('home'); // Home page with student list

Route::get('/create-new', [StudentController::class, 'create'])->name('createNew'); // Add new form
Route::post('/create-new', [StudentController::class, 'store'])->name('storeNew'); // Store new student

Route::get('/edit-student/{id}', [StudentController::class, 'edit'])->name('editStudent'); // Edit page
Route::put('/update-student/{id}', [StudentController::class, 'update'])->name('updateStudent'); // Update student
