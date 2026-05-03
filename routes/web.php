<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\QuizController as AdminQuizController;
use App\Http\Controllers\PageViewerController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/dashboard', function () {
    return redirect()->route('home');
})->name('dashboard');

Route::get('/home', function () { return view('pages.home'); });
Route::get('/p/{slug}', [PageViewerController::class, 'show'])->name('page.show');
Route::get('/map', function () { return view('pages.dummy', ['title' => 'Map', 'icon' => 'fas fa-map']); })->name('map');
Route::get('/gallery', function () { return view('pages.dummy', ['title' => 'Gallery', 'icon' => 'fas fa-images']); })->name('gallery');
Route::get('/scan', function () { return view('pages.scan'); })->name('scan');

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
    Route::middleware([\App\Http\Middleware\AdminMiddleware::class])->group(function () {
        Route::get('/admin', function () { 
            return view('admin.dashboard'); 
        })->name('admin.dashboard');
        
        Route::get('/admin/pages', [PageController::class, 'index'])->name('admin.pages.index');
        Route::get('/admin/pages/create', [PageController::class, 'create'])->name('admin.pages.create');
        Route::post('/admin/pages', [PageController::class, 'store'])->name('admin.pages.store');
        
        Route::get('/admin/quizzes', [AdminQuizController::class, 'index'])->name('admin.quizzes.index');
        Route::get('/admin/quizzes/create', [AdminQuizController::class, 'create'])->name('admin.quizzes.create');
        Route::post('/admin/quizzes', [AdminQuizController::class, 'store'])->name('admin.quizzes.store');

        Route::resource('/admin/events', \App\Http\Controllers\Admin\EventController::class)->names([
            'index' => 'admin.events.index',
            'create' => 'admin.events.create',
            'store' => 'admin.events.store',
            'destroy' => 'admin.events.destroy',
        ]);
    });
});

require __DIR__.'/auth.php';
