<?php

use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\QuizController as AdminQuizController;
use App\Http\Controllers\PageViewerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/dashboard', function () {
    return redirect()->route('home');
})->name('dashboard');

Route::get('/home', function () {
    return view('pages.home');
});
Route::get('/p/{slug}', [PageViewerController::class, 'show'])->name('page.show');
Route::get('/map', function () {
    return view('pages.map');
})->name('map');
Route::get('/gallery', function () {
    return view('pages.dummy', ['title' => 'Gallery', 'icon' => 'fas fa-images']);
})->name('gallery');
Route::get('/scan', function () {
    return view('pages.scan');
})->name('scan');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

// User Quiz Routes (Publicly accessible)
Route::get('/quiz', [QuizController::class, 'index'])->name('quiz.index');
Route::get('/quiz/{quiz}', [QuizController::class, 'show'])->name('quiz.show');
Route::post('/quiz/{quiz}', [QuizController::class, 'submit'])->name('quiz.submit');
Route::get('/quiz/{quiz}/result/{score}', [QuizController::class, 'result'])->name('quiz.result');

Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        return view('profile.edit', ['user' => auth()->user()]);
    })->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Routes
    Route::middleware([AdminMiddleware::class])->group(function () {
        Route::get('/admin', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        Route::get('/admin/pages', [PageController::class, 'index'])->name('admin.pages.index');
        Route::get('/admin/pages/create', [PageController::class, 'create'])->name('admin.pages.create');
        Route::post('/admin/pages', [PageController::class, 'store'])->name('admin.pages.store');
        Route::get('/admin/pages/{page}/edit', [PageController::class, 'edit'])->name('admin.pages.edit');
        Route::put('/admin/pages/{page}', [PageController::class, 'update'])->name('admin.pages.update');
        Route::delete('/admin/pages/{page}', [PageController::class, 'destroy'])->name('admin.pages.destroy');
        Route::post('/admin/pages/{page}/toggle-status', [PageController::class, 'toggleStatus'])->name('admin.pages.toggleStatus');

        Route::get('/admin/quizzes', [AdminQuizController::class, 'index'])->name('admin.quizzes.index');
        Route::get('/admin/quizzes/create', [AdminQuizController::class, 'create'])->name('admin.quizzes.create');
        Route::post('/admin/quizzes', [AdminQuizController::class, 'store'])->name('admin.quizzes.store');
        Route::get('/admin/quizzes/{quiz}/edit', [AdminQuizController::class, 'edit'])->name('admin.quizzes.edit');
        Route::put('/admin/quizzes/{quiz}', [AdminQuizController::class, 'update'])->name('admin.quizzes.update');
        Route::delete('/admin/quizzes/{quiz}', [AdminQuizController::class, 'destroy'])->name('admin.quizzes.destroy');
        Route::post('/admin/quizzes/{quiz}/toggle-status', [AdminQuizController::class, 'toggleStatus'])->name('admin.quizzes.toggleStatus');

        Route::resource('/admin/events', EventController::class)->names([
            'index' => 'admin.events.index',
            'create' => 'admin.events.create',
            'store' => 'admin.events.store',
            'destroy' => 'admin.events.destroy',
        ]);
    });
});

require __DIR__.'/auth.php';
