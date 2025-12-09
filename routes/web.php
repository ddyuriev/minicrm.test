<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WidgetController;
use App\Http\Controllers\TicketController;

Route::get('/widget', [WidgetController::class, 'show'])->name('widget.show');

Route::get('/ticket', [TicketController::class, 'index'])->name('tickets.index');
Route::get('/ticket/{id}', [TicketController::class, 'show'])->name('tickets.show');

Route::patch('/{ticket}/status', [TicketController::class, 'updateStatus'])->name('tickets.update-status');
Route::get('/{ticket}/files/{file}/download', [TicketController::class, 'downloadFile'])->name('tickets.files.download');
