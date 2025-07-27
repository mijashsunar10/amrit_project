<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FaqController;
use Illuminate\Support\Facades\Route;
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


Route::get('/contact',[ContactController::class,'contact'])->name('contact');
 Route::post('/contact/send', [ContactController::class, 'submitContactForm'])->name('contact.send');
require __DIR__.'/auth.php';
