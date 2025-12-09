<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WidgetController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckRole;

Route::aliasMiddleware('role', CheckRole::class);

Route::get('/widget', [WidgetController::class, 'show'])->name('widget.show');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'role:Manager'])
    ->group(function () {
        Route::get('/ticket', [TicketController::class, 'index'])->name('tickets.index');
        Route::get('/ticket/{id}', [TicketController::class, 'show'])->name('tickets.show');
        Route::patch('/{ticket}/status', [TicketController::class, 'updateStatus'])->name('tickets.update-status');
        Route::get('/{ticket}/files/{file}/download', [TicketController::class, 'downloadFile'])->name('tickets.files.download');
    });

Route::get('/', function () {
    if (auth()->check() && auth()->user()->hasRole('Manager')) {
        return redirect()->route('tickets.index');
    }
    return redirect()->route('login');
});
