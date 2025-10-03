<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AiSuggestionController;

// Public routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Protected routes using JWT guard
Route::middleware(['auth:api'])->group(function () {

    // Current user info
    Route::get('me', [AuthController::class, 'me']);

    // Ticket routes
    Route::get('tickets', [TicketController::class, 'index']);
    Route::post('tickets', [TicketController::class, 'store']);
    Route::get('tickets/{ticket}', [TicketController::class, 'show']);
    Route::put('tickets/{ticket}', [TicketController::class, 'update']);
    Route::delete('tickets/{ticket}', [TicketController::class, 'destroy']);

    // AI Suggestion
    Route::post('tickets/{ticket}/suggest', [AiSuggestionController::class, 'getSuggestion']);
});
