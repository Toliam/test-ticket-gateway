<?php

use App\Http\Controllers\EventWithPlacesController;
use App\Http\Controllers\ReservePlacesController;
use App\Http\Controllers\ShowsListController;
use App\Http\Controllers\ShowWithEventsController;
use Illuminate\Support\Facades\Route;

/**
 * Note: showId and eventId are integers. See AppServiceProvider@boot
 */

Route::group(['prefix' => 'shows'], function () {
    Route::get('/', ShowsListController::class)->name('shows.index');
    Route::get('/{showId}', ShowWithEventsController::class);
});

Route::group(['prefix' => 'events'], function () {
    Route::get('/{eventId}', EventWithPlacesController::class);
    Route::post('/{eventId}', ReservePlacesController::class);
});

