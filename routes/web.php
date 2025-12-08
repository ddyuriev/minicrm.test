<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WidgetController;
use App\Http\Controllers\TicketController;

Route::get('/widget', [WidgetController::class, 'show'])->name('widget.show');

Route::get('/ticket', [TicketController::class, 'index'])->name('tickets.index');
Route::get('/ticket/{id}', [TicketController::class, 'show'])->name('tickets.show');
