<?php

use App\Livewire\Pages\ProblemManagement;
use App\Livewire\Pages\RoleAndPermissionSetting;
use App\Livewire\Pages\UserManagement;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

//Route::view('dashboard', 'dashboard')
//    ->middleware(['auth', 'verified'])
//    ->name('dashboard');

Route::get('/dashboard', UserManagement::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/role-and-permission', RoleAndPermissionSetting::class)->name('role-and-permission');
    Route::get('/user', UserManagement::class)->name('user');
    Route::get('/problem', ProblemManagement::class)->name('problem');
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
