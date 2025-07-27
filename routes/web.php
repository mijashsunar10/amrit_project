<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\TeamMemberController;
use App\Models\AboutUs;
use App\Models\TeamMember;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/partners/create', [PartnerController::class, 'create'])->name('partners.create');
    Route::post('/partners', [PartnerController::class, 'store'])->name('partners.store');
    Route::get('/partners/{partner}/edit', [PartnerController::class, 'edit'])->name('partners.edit');
    Route::put('/partners/{partner}', [PartnerController::class, 'update'])->name('partners.update');
    Route::delete('/partners/{partner}', [PartnerController::class, 'destroy'])->name('partners.destroy');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/brands/create', [BrandController::class, 'create'])->name('brands.create');
    Route::post('/brands', [BrandController::class, 'store'])->name('brands.store');
    Route::get('/brands/{brand}/edit', [BrandController::class, 'edit'])->name('brands.edit');
    Route::put('/brands/{brand}', [BrandController::class, 'update'])->name('brands.update');
    Route::delete('/brands/{brand}', [BrandController::class, 'destroy'])->name('brands.destroy');
});

Route::get('/aboutus', [AboutUsController::class, 'index'])->name('aboutus');

Route::middleware(['auth'])->group(function() {
    Route::get('/admin/about-us/create', [AboutUsController::class, 'create'])->name('aboutus.create');
    Route::post('/admin/about-us/store', [AboutUsController::class, 'store'])->name('aboutus.store');
    Route::get('/admin/about-us/edit', [AboutUsController::class, 'edit'])->name('aboutus.edit');
    Route::post('/admin/about-us/update', [AboutUsController::class, 'update'])->name('aboutus.update');
    Route::delete('/admin/about-us/destroy', [AboutUsController::class, 'destroy'])->name('aboutus.destroy');
});

Route::prefix('ourteam')->group(function () {
    
    Route::get('/create', [TeamMemberController::class, 'create'])->name('ourteam.create');
    Route::post('/store', [TeamMemberController::class, 'store'])->name('ourteam.store');
    Route::get('/{teamMember}/edit', [TeamMemberController::class, 'edit'])->name('ourteam.edit');
    Route::put('/{teamMember}', [TeamMemberController::class, 'update'])->name('ourteam.update');
    Route::delete('/{teamMember}', [TeamMemberController::class, 'destroy'])->name('ourteam.destroy');
});


require __DIR__.'/auth.php';
