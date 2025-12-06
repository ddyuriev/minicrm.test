<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WidgetController;

Route::name('api.')->group(function () {
    Route::post('/tickets', [WidgetController::class, 'store'])->name('widget.store');
});
