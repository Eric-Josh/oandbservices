<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\JobTypesController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\MerchandiseController;
use App\Http\Controllers\GeneralMerchandiseController;
use App\Http\Controllers\HandyManController;
use App\Http\Controllers\AdminController;

use App\Models\Jobs;
use App\Models\GeneralMerchandise;
use App\Models\User;

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

// handyman registration page
Route::get('/handyman-register', function () {

    return view('auth.handyman-register');
    
})->name('handyman-register');

// handyman registration post route
Route::post('/handyman-register', [HandyManController::class, 'register'])->name('handyman-register.register');

// user dashboard
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

    /* This is for recent jobs table list */
    $recentJobs = Jobs::where('user_id', auth()->user()->id)
                ->orderBy('id', 'desc')->take(10)->get();
    
    /* This is for recent merchandise jobs table list */
    $recentMerchantJobs = GeneralMerchandise::where('user_id', auth()->user()->id)
                ->orderBy('id', 'desc')->take(10)->get();

    /* This is for job count */
    $totalJobs1 = Jobs::where('user_id', auth()->user()->id)
                    ->where('deleted_at',null)->get();
    $totalJobs2 = GeneralMerchandise::where('user_id', auth()->user()->id)
                    ->where('deleted_at',null)->get();

    $totalJobCum = $totalJobs1->count() + $totalJobs2->count();
    $statusCompleted = $totalJobs1->where('status','Completed')->count() + $totalJobs2->where('status','Completed')->count();
    $statusPending = $totalJobs1->where('status','Pending')->count() + $totalJobs2->where('status','Pending')->count();

    return view('dashboard', compact(['recentJobs','recentMerchantJobs','totalJobCum','statusCompleted','statusPending']));

})->name('dashboard');


/* protect registered user views from guest/spy */
Route::middleware(['auth', 'verified'])->group(function () {
   
    // accessible only when registration is completed
    Route::middleware(['auth', 'handyman_registration_completed'])->group(function () {

        Route::get('/handyman/dashboard', [HandyManController::class, 'index'])->name('handyman.dashboard');

    });

    // handyman registration step 2 which must be after step 1
    Route::get('/handyman-register-step-2', [HandyManController::class, 'create'])->name('handyman-register-step-2.create');
    Route::put('/handyman-register-step-2/{id}', [HandyManController::class, 'update'])->name('handyman-register-step-2.update');
    Route::get('/handyman/job/show/{id}', [HandyManController::class, 'show'])->name('handyman-job.show');
    Route::get('/handyman/jobs', [HandyManController::class, 'history'])->name('handyman-job.history');
    
    // admin routes
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/job-view/{id}', [AdminController::class, 'jobView'])->name('admin.job-view');
    Route::get('/admin/merchandise-view/{id}', [AdminController::class, 'merchandiseView'])->name('admin.merchandise-view');
    Route::get('/admin/job-history', [AdminController::class, 'jobHistory'])->name('admin.job-history');
    Route::get('/admin/merchandise-history', [AdminController::class, 'merchandiseHistory'])->name('admin.merchandise-history');
    Route::put('/admin/js/{id}',[AdminController::class, 'jobStatus'])->name('admin.job-status');
    Route::put('/admin/ms/{id}',[AdminController::class, 'merchandiseStatus'])->name('admin.merchandise-status');
    Route::get('/admin/handyman-search/',[AdminController::class, 'handymanSearch'])->name('admin.handyman-search');
    Route::put('/admin/assign-job/{id}',[AdminController::class, 'assignJob'])->name('admin.assign-job');
    Route::get('/admin/users',[AdminController::class, 'userList'])->name('admin.user-list');
    Route::get('/admin/user/create',[AdminController::class, 'userCreate'])->name('admin.user-create');
    Route::get('/admin/user/search',[AdminController::class, 'userSearch'])->name('admin.user-search');
    

    Route::get('/jobtypes', [JobTypesController::class, 'index'])->name('jobtypes');
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

