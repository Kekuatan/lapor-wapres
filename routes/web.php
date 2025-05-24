<?php

use App\Livewire\Auth\Login;
use App\Livewire\Pages\ProblemManagement;
use App\Livewire\Pages\RoleAndPermissionSetting;
use App\Livewire\Pages\UserManagement;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', Login::class)->name('home');
Route::get('/login', Login::class)->name('login');

Route::get('/dashboard', UserManagement::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::post('logout', App\Livewire\Actions\Logout::class)->name('logout');
    Route::get('/role-and-permission', RoleAndPermissionSetting::class)->name('role-and-permission');
    Route::get('/user', UserManagement::class)->name('user');
    Route::get('/problem', ProblemManagement::class)->name('problem');
});

//require __DIR__.'/auth.php';
