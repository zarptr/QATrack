<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BugController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Models\Bug;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.read-all');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::delete('/notifications', [NotificationController::class, 'clearAll'])->name('notifications.clear-all');

    Route::get('/', function () {
        $user = auth()->user();
        if ($user->role === 'developer') {
            return redirect()->route('bugs');
        }
        $query = Bug::query();
        if ($user->role === 'support_dev') {
            $query->where('reporter_id', $user->id);
        }
        // Bug automatically rises to top if priority is high/important (P1 Critical -> P2 High -> P3 Medium)
        $recentBugs = $query->orderByRaw("CASE priority WHEN 'p1' THEN 1 WHEN 'p2' THEN 2 WHEN 'p3' THEN 3 ELSE 4 END ASC")
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact('recentBugs'));
    })->name('dashboard');

    // Projects (Folder Project)
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

    // Bugs
    Route::get('/bugs', [BugController::class, 'index'])->name('bugs');
    Route::get('/bugs/create', [BugController::class, 'create'])->name('bugs.create');
    Route::post('/bugs', [BugController::class, 'store'])->name('bugs.store');
    Route::get('/bugs/{bug}', [BugController::class, 'show'])->name('bugs.show');
    Route::patch('/bugs/{bug}/status', [BugController::class, 'updateStatus'])->name('bugs.status.update');
    Route::delete('/bugs/{bug}', [BugController::class, 'destroy'])->name('bugs.destroy');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports');
    Route::get('/reports/export-excel', [ReportController::class, 'exportExcel'])->name('reports.export.excel');

    Route::get('/settings', [ProfileController::class, 'edit'])->name('settings');
    Route::patch('/settings/profile', [ProfileController::class, 'updateProfile'])->name('settings.profile.update');
    Route::put('/settings/password', [ProfileController::class, 'updatePassword'])->name('settings.password.update');
    Route::resource('users', UserController::class);

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/forgot-password', [LoginController::class, 'resetPassword'])->name('password.reset.guest');
});
