<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\QuoteController;
use App\Http\Controllers\Frontend\SitemapController;
use Illuminate\Support\Facades\Route;

/* ----------------------------- SITE PUBLIC ----------------------------- */
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/a-propos', [PageController::class, 'about'])->name('about');
Route::get('/nos-activites', [PageController::class, 'activities'])->name('activities');
Route::get('/nos-services', [PageController::class, 'services'])->name('services');
Route::get('/nos-realisations', [PageController::class, 'projects'])->name('projects');
Route::get('/nos-realisations/{slug}', [PageController::class, 'projectShow'])->name('projects.show');

Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:6,1')->name('contact.store');
Route::post('/devis', [QuoteController::class, 'store'])->middleware('throttle:6,1')->name('quote.store');

Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');

/* ------------------------------- ADMIN -------------------------------- */
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [Admin\AuthController::class, 'show'])->name('login');
        Route::post('/login', [Admin\AuthController::class, 'login'])->middleware('throttle:5,1')->name('login.post');
    });

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::post('/logout', [Admin\AuthController::class, 'logout'])->name('logout');
        Route::get('/', Admin\DashboardController::class)->name('dashboard');

        Route::resource('activities', Admin\ActivityController::class)->except('show');
        Route::resource('services', Admin\ServiceController::class)->except('show');
        Route::resource('projects', Admin\ProjectController::class)->except('show');
        Route::delete('/project-images/{image}', [Admin\ProjectController::class, 'destroyImage'])->name('project-images.destroy');

        Route::get('/messages', [Admin\MessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{message}', [Admin\MessageController::class, 'show'])->name('messages.show');
        Route::patch('/messages/{message}/handled', [Admin\MessageController::class, 'toggleHandled'])->name('messages.handled');
        Route::delete('/messages/{message}', [Admin\MessageController::class, 'destroy'])->name('messages.destroy');

        Route::get('/devis', [Admin\QuoteRequestController::class, 'index'])->name('quotes.index');
        Route::patch('/devis/{quote}', [Admin\QuoteRequestController::class, 'update'])->name('quotes.update');
        Route::delete('/devis/{quote}', [Admin\QuoteRequestController::class, 'destroy'])->name('quotes.destroy');

        Route::get('/parametres', [Admin\SettingController::class, 'edit'])->name('settings.edit');
        Route::put('/parametres', [Admin\SettingController::class, 'update'])->name('settings.update');
    });
});
