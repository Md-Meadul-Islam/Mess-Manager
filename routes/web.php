<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Manager_Mate\BazarsTableController;
use App\Http\Controllers\Manager_Mate\MealsTableController;
use App\Http\Controllers\Manager_Mate\RoommateController;
use App\Http\Controllers\Manager_Mate\ToletsController;
use App\Http\Controllers\ManagerMateController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

// frontend 
Route::get('/config-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('route:cache');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    return "<h1>Cache Cleared!</h1>";
});
Route::get('/linkstorage', function () {
    $targetFolder = base_path() . '/storage/app/public';
    $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/symstorage';
    symlink($targetFolder, $linkFolder);
});
Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');
Route::get('/viewtolet', [WelcomeController::class, 'viewTolet'])->name('viewtolet');
Route::post('/maketolet', [WelcomeController::class, 'makeTolet'])->name('maketolet');
Route::get('/searchkey', [WelcomeController::class, 'searchKey'])->name('searchKey');
Route::post('/searchtolet', [WelcomeController::class, 'searchTolet'])->name('searchtolet');
Route::get('/toletpagination', [WelcomeController::class, 'toletPagination'])->name('toletpagination');
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('dashboard', [AdminController::class, 'Index'])->name('admin.dashboard');
});
Route::middleware(['auth', 'role:manager,mate'])->prefix('manager_mate')->group(function () {
    Route::get('dashboard', [ManagerMateController::class, 'Index'])->name('manager_mate.dashboard');
    Route::get('dashboard/selectmonth', [ManagerMateController::class, 'monthSelect'])->name('monthselect');
    Route::put('dashboard/otherexpences/{id}', [ManagerMateController::class, 'otherExpences'])->name('otherexpences');
    Route::resource('mealstable', MealsTableController::class);
    Route::resource('bazarstable', BazarsTableController::class);
    Route::post('bazarstatus/{id}', [BazarsTableController::class, 'bazarstatus'])->name('bazarstatus');
    Route::resource('roommates', RoommateController::class);
    Route::get('/dashboardtolet', [ToletsController::class, 'dashboardTolet'])->name('dashboard.tolet');
    Route::get('/edittolet', [ToletsController::class, 'editTolet'])->name('edit.tolet');
    Route::post('/updatetolet', [ToletsController::class, 'updateTolet'])->name('tolet.update');
    Route::post('/deletetolet', [ToletsController::class, 'deleteTolet'])->name('tolet.delete');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__ . '/auth.php';
