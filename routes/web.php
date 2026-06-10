<?php

use App\Http\Controllers\Admin\CollectionItemController as AdminCollectionItemController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\QuizController as AdminQuizController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\StoryController as AdminStoryController;
use App\Http\Controllers\CollectionItemController;
use App\Http\Controllers\PageViewerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\StoryController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\CollectionItem;
use App\Models\Event;
use App\Models\Page;
use App\Models\Story;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $aboutPage = Page::where('slug', 'about')->first();
    $koleksi = CollectionItem::latest()->first();
    $cerita = Story::latest()->first();
    $activities = Event::latest()->take(2)->get();
    $events = Event::latest()->get();

    return view('pages.home', compact('aboutPage', 'koleksi', 'cerita', 'activities', 'events'));
})->name('home');

Route::get('/dashboard', function () {
    return redirect()->route('home');
})->name('dashboard');

Route::get('/home', function () {
    return redirect()->route('home');
});
Route::get('/p/{slug}', [PageViewerController::class, 'show'])->name('page.show');
Route::get('/map', function () {
    return view('pages.map');
})->name('map');
Route::get('/events/{event}', [App\Http\Controllers\EventController::class, 'show'])->name('events.show');
Route::get('/events/{event}/plan', [App\Http\Controllers\EventController::class, 'plan'])->name('events.plan');
Route::post('/events/{event}/save', [App\Http\Controllers\EventController::class, 'toggleSave'])->name('events.save')->middleware('auth');
Route::get('/gallery', function () {
    return view('pages.dummy', ['title' => 'Gallery', 'icon' => 'fas fa-images']);
})->name('gallery');
Route::get('/scan', function () {
    return view('pages.scan');
})->name('scan');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/collection', [CollectionItemController::class, 'index'])->name('collection.index');
Route::get('/stories', [StoryController::class, 'index'])->name('stories.index');
Route::get('/stories/{story}', [StoryController::class, 'show'])->name('stories.show');

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

        Route::post('/admin/settings', [SettingController::class, 'update'])->name('admin.settings.update');

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
            'edit' => 'admin.events.edit',
            'update' => 'admin.events.update',
            'destroy' => 'admin.events.destroy',
        ]);

        Route::resource('/admin/collections', AdminCollectionItemController::class)->names([
            'index' => 'admin.collections.index',
            'create' => 'admin.collections.create',
            'store' => 'admin.collections.store',
            'edit' => 'admin.collections.edit',
            'update' => 'admin.collections.update',
            'destroy' => 'admin.collections.destroy',
        ]);

        Route::resource('/admin/stories', AdminStoryController::class)->names([
            'index' => 'admin.stories.index',
            'create' => 'admin.stories.create',
            'store' => 'admin.stories.store',
            'edit' => 'admin.stories.edit',
            'update' => 'admin.stories.update',
            'destroy' => 'admin.stories.destroy',
        ]);
    });
});

require __DIR__.'/auth.php';
