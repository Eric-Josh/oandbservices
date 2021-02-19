<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobTypesController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\MerchandiseController;
use App\Http\Controllers\GeneralMerchandiseController;

use App\Models\Jobs;

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
    return view('guest');
});


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $jobs = Jobs::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->take(10)->get();
    $job = Jobs::where('user_id', auth()->user()->id)->get();
    return view('dashboard', compact(['jobs','job']));
})->name('dashboard');

// protect a registered user page
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/jobtypes', [JobTypesController::class, 'index']);
    Route::get('/jobtypes/create', [JobTypesController::class, 'create'])->name('jobtypes.create');
    Route::post('jobtypes', [JobTypesController::class, 'store'])->name('jobtypes.store');
    Route::get('/jobtypes/edit/{id}',[JobTypesController::class, 'edit'])->name('jobtypes.edit');
    Route::put('/jobtypes/{id}',[JobTypesController::class, 'update'])->name('jobtypes.update'); 
    Route::delete('/jobtypes/{id}',[JobTypesController::class, 'destroy'])->name('jobtypes.destroy');
    
    Route::get('/jobs', [JobsController::class, 'index'])->name('jobs');
    Route::get('/jobs/create', [JobsController::class, 'create'])->name('jobs.create');
    Route::post('jobs', [JobsController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/edit/{id}',[JobsController::class, 'edit'])->name('jobs.edit');
    Route::get('jobs/show/{id}', [JobsController::class, 'show'])->name('jobs.show');
    Route::put('/jobs/{id}',[JobsController::class, 'update'])->name('jobs.update'); 
    Route::delete('/jobs/{id}',[JobsController::class, 'destroy'])->name('jobs.destroy');

    Route::get('/merchandise', [MerchandiseController::class, 'index'])->name('merchndise');
    Route::get('/merchandise/create', [MerchandiseController::class, 'create'])->name('merchandise.create');
    Route::post('merchandise', [MerchandiseController::class, 'store'])->name('merchandise.store');
    Route::get('/merchandise/edit/{id}',[MerchandiseController::class, 'edit'])->name('merchandise.edit');
    Route::put('/merchandise/{id}',[MerchandiseController::class, 'update'])->name('merchandise.update'); 
    Route::delete('/merchandise/{id}',[MerchandiseController::class, 'destroy'])->name('merchandise.destroy');

    Route::get('/general-merchandise', [GeneralMerchandiseController::class, 'index'])->name('gmerchandise');
    Route::get('/general-merchandise/create', [GeneralMerchandiseController::class, 'create'])->name('gmerchandise.create');
    Route::post('general-merchandise', [GeneralMerchandiseController::class, 'store'])->name('gmerchandise.store');
    Route::get('/general-merchandise/edit/{id}',[GeneralMerchandiseController::class, 'edit'])->name('gmerchandise.edit');
    Route::put('/general-merchandise/{id}',[GeneralMerchandiseController::class, 'update'])->name('gmerchandise.update'); 
    Route::delete('/general-merchandise/{id}',[GeneralMerchandiseController::class, 'destroy'])->name('gmerchandise.destroy');
    Route::get('/general-merchandise/show/{id}',[GeneralMerchandiseController::class, 'show'])->name('gmerchandise.show');
});


