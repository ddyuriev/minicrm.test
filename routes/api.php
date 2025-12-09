<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TicketController;

Route::name('api.')->group(function () {
    Route::post('/tickets', [TicketController::class, 'store'])->name('widget.store');
    Route::get('/tickets/statistics', [TicketController::class, 'statistics']);
});
