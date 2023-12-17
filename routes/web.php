<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Manager_Mate\BazarsTableController;
use App\Http\Controllers\Manager_Mate\MealsTableController;
use App\Http\Controllers\Manager_Mate\RoommateController;
use App\Http\Controllers\ManagerMateController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('dashboard', [AdminController::class, 'Index'])->name('admin.dashboard');
});
Route::middleware(['auth', 'role:manager,mate'])->prefix('manager_mate')->group(function () {
    Route::get('dashboard', [ManagerMateController::class, 'Index'])->name('manager_mate.dashboard');
    Route::get('dashboard/selectmonth', [ManagerMateController::class, 'monthSelect'])->name('monthselect');
    Route::put('dashboard/otherexpences/{id}', [ManagerMateController::class, 'otherExpences'])->name('otherexpences');
    Route::get('dashboard/faq', [ManagerMateController::class, 'faq'])->name('manager_mate.faq');
    Route::resource('mealstable', MealsTableController::class);
    Route::resource('bazarstable', BazarsTableController::class);
    Route::resource('roommates', RoommateController::class);
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__ . '/auth.php';
