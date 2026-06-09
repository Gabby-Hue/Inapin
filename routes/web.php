<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ModerationController;
use App\Http\Controllers\Admin\TransportController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FerryController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\Partner\BookingController as PartnerBookingController;
use App\Http\Controllers\Partner\DashboardController as PartnerDashboardController;
use App\Http\Controllers\Partner\PropertyController as PartnerPropertyController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::get('/register', [AuthController::class, 'showRegister'])->middleware('guest')->name('register');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');
Route::get('/login', [AuthController::class, 'showLogin'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/flights', [FlightController::class, 'index'])->name('flights.index');
Route::get('/flights/search', [FlightController::class, 'search'])->name('flights.search');
Route::get('/flights/{flight}', [FlightController::class, 'show'])->name('flights.show');
Route::get('/ferries', [FerryController::class, 'index'])->name('ferries.index');
Route::get('/ferries/search', [FerryController::class, 'search'])->name('ferries.search');
Route::get('/ferries/{ferry}', [FerryController::class, 'show'])->name('ferries.show');
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/recommendations', [PropertyController::class, 'recommendations'])->name('properties.recommendations');
Route::get('/properties/{property}', [PropertyController::class, 'show'])->name('properties.show');
Route::get('/properties/{id}/reviews', [ReviewController::class, 'propertyReviews'])->name('properties.reviews');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::put('/bookings/{booking}', [BookingController::class, 'update'])->name('bookings.update');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favorites', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/favorites/{favorite}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

    Route::prefix('partner')->name('partner.')->group(function () {
        Route::get('/dashboard', PartnerDashboardController::class)->name('dashboard');
        Route::resource('/properties', PartnerPropertyController::class)->except(['show']);
        Route::get('/bookings', [PartnerBookingController::class, 'index'])->name('bookings.index');
        Route::put('/bookings/{booking}', [PartnerBookingController::class, 'update'])->name('bookings.update');
    });

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', AdminDashboardController::class)->name('dashboard');
        Route::get('/users', [ModerationController::class, 'users'])->name('users.index');
        Route::get('/partners', [ModerationController::class, 'partners'])->name('partners.index');
        Route::put('/partners/{partner}', [ModerationController::class, 'updatePartner'])->name('partners.update');
        Route::get('/properties', [ModerationController::class, 'properties'])->name('properties.index');
        Route::put('/properties/{property}', [ModerationController::class, 'updateProperty'])->name('properties.update');
        Route::get('/reviews', [ModerationController::class, 'reviews'])->name('reviews.index');
        Route::delete('/reviews/{review}', [ModerationController::class, 'destroyReview'])->name('reviews.destroy');
        Route::get('/flights', [TransportController::class, 'flights'])->name('flights.index');
        Route::post('/airports', [TransportController::class, 'storeAirport'])->name('airports.store');
        Route::post('/flights', [TransportController::class, 'storeFlight'])->name('flights.store');
        Route::get('/ferries', [TransportController::class, 'ferries'])->name('ferries.index');
        Route::post('/ports', [TransportController::class, 'storePort'])->name('ports.store');
        Route::post('/ferries', [TransportController::class, 'storeFerry'])->name('ferries.store');
    });
});
