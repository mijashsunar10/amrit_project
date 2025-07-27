<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FaqController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\TeamMemberController;
use App\Models\AboutUs;
use App\Models\TeamMember;
use App\Http\Controllers\ContactController;

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

Route::get('/index',[HomeController::class,'index'])->name('index');
Route::controller(FaqController::class)->group(function () {
    // Publicly accessible route
    Route::get('faqs', 'index')->name('faqs.index');

    // Authenticated and verified routes
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('faqs/create', 'create')->name('faqs.create');
        Route::post('faqs', 'store')->name('faqs.store');
        Route::get('faqs/{faq:slug}/edit', 'edit')->name('faqs.edit');
        Route::put('faqs/{faq:slug}', 'update')->name('faqs.update');
        Route::delete('faqs/{faq:slug}', 'destroy')->name('faqs.destroy');
    });
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



Route::get('/contact',[ContactController::class,'contact'])->name('contact');
 Route::post('/contact/send', [ContactController::class, 'submitContactForm'])->name('contact.send');
require __DIR__.'/auth.php';
