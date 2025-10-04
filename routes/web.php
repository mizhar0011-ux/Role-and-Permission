<?php

use App\Livewire\Users\UserCreate;
use App\Livewire\Users\UserIndex;
use App\Livewire\Users\UserEdit;
use App\Livewire\Users\UserShow;

use App\Livewire\Products\productIndex;
use App\Livewire\Products\productCreate;
use App\Livewire\Products\productEdit;
use App\Livewire\Products\productShow;

use App\Livewire\Role\Roleindex;
use App\Livewire\Role\RoleCreate;
use App\Livewire\Role\RoleEdit;
use App\Livewire\Role\RoleShow;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

Route::get('user',UserIndex::class)->name('user.index');
Route::get('user/create',UserCreate::class)->name('user.create');
Route::get('user/{id}/edit', UserEdit::class)->name('user.edit'); 
Route::get('user/{id}',UserShow::class)->name('user.show');

Route::get('product',ProductIndex::class)->name('product.index')->middleware("permission:product.view|product.create|product.edit|product.delete");
Route::get('product/create',ProductCreate::class)->name('product.create')->middleware("permission:product.create");
Route::get('product/{id}/edit', ProductEdit::class)->name('product.edit')->middleware("permission:product.edit"); 
Route::get('product/{id}',ProductShow::class)->name('product.show')->middleware("permission:product.view");

Route::get('role',roleindex::class)->name('role.index')->middleware("permission:role.view|role.create|role.edit|role.delete");
Route::get('role/create',RoleCreate::class)->name('role.create')->middleware("permission:role.create");
Route::get('role/{id}/edit',RoleEdit::class)->name('role.edit')->middleware("permission:role.edit");
Route::get('role/{id}',RoleShow::class)->name('role.show')->middleware("permission:role.view");

Route::middleware(['user.role'])->group(function () {
    // ...
});


// Multiple roles allowed
Route::middleware(['member.role:gold,silver'])->group(function () {
    Route::get('/member/general-dashboard', function () {
        return 'Dashboard for Gold or Silver Members';
    });
});


    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

require __DIR__.'/auth.php';
