<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\FirebaseController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReportController;
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

Route::get('/', function () {
    return view('welcome');
    
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');
    Route::get('/report', [ReportController::class, 'index'])->name('report');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

});

Route::middleware('auth','role:admin')->group(function () {
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('/createUser', [ProfileController::class, 'create'])->name('users.create');
    Route::post('/storeUser', [ProfileController::class, 'store'])->name('users.store');
    Route::get('/admin/edit/{id}', [ProfileController::class, 'adminEdit'])->name('admin.edit');
    Route::patch('/profile/update/{id}', [ProfileController::class, 'adminUpdate'])->name('adminProfile.update');
    Route::delete('/profile/delete/{id}', [ProfileController::class, 'destroyOtherAccount'])->name('profile.destroy');   
    Route::get('/notification', [NotificationController::class, 'index'])->name('sendNotification');
    Route::post('/notification/send', [NotificationController::class, 'sendNotification'])->name('notification.send');
});

Route::middleware('auth')->group(function () {
    Route::get('/map',[MapController::class, 'index'])->name('map.index');
    Route::get('/incidentDetail/{key}',[MapController::class, 'getIncident'])->name('map.getIncident');
    Route::patch('/store-firebase-data', [MapController::class, 'store'])->name('map.store');
});

	
Route::get('/get-firebase-data', [FirebaseController::class, 'index'])->name('firebase.index');

require __DIR__.'/auth.php';
