<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientAuthController;
use App\Http\Controllers\SupportAuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AgentController;

Route::get('/', function () {
    return view('landing');
});

Route::patch('/tickets/{ticket}/update-status', [TicketController::class, 'updateStatus'])->name('tickets.updateStatus');

Route::get('/client/dashboard', [DashboardController::class, 'client'])->name('dashboard')->middleware('auth');
Route::get('/agent/dashboard', [DashboardController::class, 'agent'])->name('agent.dashboard')->middleware('auth');
Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/client/login', [ClientAuthController::class, 'showLoginForm'])->name('client.login');
Route::post('/client/login', [ClientAuthController::class, 'login']);
Route::get('/client/register', [ClientAuthController::class, 'showRegistrationForm'])->name('client.register');
Route::post('/client/register', [ClientAuthController::class, 'register']);
Route::post('/client/logout', [ClientAuthController::class, 'logout'])->name('client.logout');

Route::get('/support/login', [SupportAuthController::class, 'showLoginForm'])->name('support.login');
Route::post('/support/login', [SupportAuthController::class, 'login']);
Route::get('/support/register', [SupportAuthController::class, 'showRegistrationForm'])->name('support.register');
Route::post('/support/register', [SupportAuthController::class, 'register']);
Route::post('/support/logout', [SupportAuthController::class, 'logout'])->name('support.logout');

Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::get('/admin/register', [AdminAuthController::class, 'showRegistrationForm'])->name('admin.register');
Route::post('/admin/register', [AdminAuthController::class, 'register']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth', 'support_agent'])->group(function () {
    Route::get('/agent/create', [AgentController::class, 'create'])->name('agent.create');
    Route::post('/agent/store', [AgentController::class, 'store'])->name('agent.store');
});

// Password Reset Routes
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Email Verification Routes
Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

// Ticket CRUD routes (for client)
Route::middleware('auth')->group(function () {
    Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/createAgent', [TicketController::class, 'createAgent'])->name('tickets.createAgent');
    Route::post('/ticketsAgent', [TicketController::class, 'storeAgent'])->name('tickets.storeAgent');
    Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
    Route::get('/tickets/{ticket}/edit', [TicketController::class, 'edit'])->name('tickets.edit');
    Route::put('/tickets/{ticket}', [TicketController::class, 'update'])->name('tickets.update');
    Route::delete('/tickets/{id}', [TicketController::class, 'destroy'])->name('tickets.destroy');
    Route::get('tickets/{id}/download', [TicketController::class, 'downloadAttachment'])->name('tickets.downloadAttachment');
});

// Admin routes
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('support_agents/create', [AdminAuthController::class, 'create'])->name('admin.support_agents.create');
    Route::post('support_agents', [AdminAuthController::class, 'store'])->name('admin.support_agents.store');
    Route::get('support_agents/{id}/edit', [AdminAuthController::class, 'edit'])->name('admin.support_agents.edit');
    Route::put('support_agents/{id}', [AdminAuthController::class, 'update'])->name('admin.support_agents.update');
    Route::delete('support_agents/{id}', [AdminAuthController::class, 'destroy'])->name('admin.support_agents.destroy');
    Route::get('/tickets', [TicketController::class, 'adminIndex'])->name('admin.tickets.index');
    Route::get('/tickets/create', [TicketController::class, 'createAgent'])->name('admin.tickets.create');
    Route::post('/tickets', [TicketController::class, 'storeAgent'])->name('admin.tickets.store');
    Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('admin.tickets.show');
    Route::get('/tickets/{ticket}/edit', [TicketController::class, 'edit'])->name('admin.tickets.edit');
    Route::put('/tickets/{ticket}', [TicketController::class, 'update'])->name('admin.tickets.update');
    Route::delete('/tickets/{ticket}', [TicketController::class, 'destroy'])->name('admin.tickets.destroy');
    Route::get('/support-agents', [AgentController::class, 'index'])->name('admin.support-agents.index');
    Route::get('/support-agents/create', [AgentController::class, 'create'])->name('admin.support-agents.create');
    Route::post('/support-agents', [AgentController::class, 'store'])->name('admin.support-agents.store');
    Route::get('/support-agents/{agent}', [AgentController::class, 'show'])->name('admin.support-agents.show');
    Route::get('/support-agents/{agent}/edit', [AgentController::class, 'edit'])->name('admin.support-agents.edit');
    Route::put('/support-agents/{agent}', [AgentController::class, 'update'])->name('admin.support-agents.update');
    Route::delete('/support-agents/{agent}', [AgentController::class, 'destroy'])->name('admin.support-agents.destroy');
});

require __DIR__.'/auth.php';
