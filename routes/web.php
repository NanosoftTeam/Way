<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\WelcomeController::class, 'show'])->name('welcome');

Route::middleware(['auth'])->group(function(){
    Route::middleware(['can:isAdmin'])->group(function(){


        Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
        Route::post('/users/store', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}', [App\Http\Controllers\UserController::class, 'show'])->name('users.show');
        Route::get('/users/e/{user}', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
        Route::post('/users/u/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
        Route::post('/users/u-p/{user}', [App\Http\Controllers\UserController::class, 'update_pass'])->name('users.update_pass');
        Route::get('/users/d/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');

        Route::get('/changes', [App\Http\Controllers\ChangeController::class, 'index'])->name('changes.index');

        Route::get('/files', [App\Http\Controllers\MessageController::class, 'files'])->name('messages.files');
        Route::get('/messages/del-file/{message}', [App\Http\Controllers\MessageController::class, 'del_file'])->name('messages.del_file');

        Route::get('/settings2/edit', [App\Http\Controllers\Settings2Controller::class, 'edit'])->name('settings2.edit');
        Route::post('/settings2/update', [App\Http\Controllers\Settings2Controller::class, 'update'])->name('settings2.update');
    });

    Route::middleware(['can:isIT'])->group(function(){

        /*OLD
        Route::get('/films', [App\Http\Controllers\FilmController::class, 'index'])->name('films.index');
        Route::get('/films/{film}', [App\Http\Controllers\FilmController::class, 'show'])->name('films.show');
        Route::get('/films/m/{film}', [App\Http\Controllers\FilmController::class, 'show2'])->name('films.show2');
        Route::get('/films/info/{film}', [App\Http\Controllers\FilmController::class, 'tab_info'])->name('films.tab_info');
        Route::get('/films/tasks/{film}', [App\Http\Controllers\FilmController::class, 'tab_tasks'])->name('films.tab_tasks');
        Route::post('/films/edit/{id}', [App\Http\Controllers\FilmController::class, 'edit'])->name('films.edit');
        Route::get('/films/plan/edit/{film}', [App\Http\Controllers\FilmController::class, 'plan_edit'])->name('films.plan.edit');
        Route::post('/films/plan/update/{film}', [App\Http\Controllers\FilmController::class, 'plan_update'])->name('films.plan.update');
        Route::get('/films/plan/calendar/{film}', [App\Http\Controllers\FilmController::class, 'plan_calendar'])->name('films.plan.calendar');
        Route::post('/films/plan/calendar/action', [App\Http\Controllers\FilmController::class, 'plan_action'])->name('films.plan.action');
        Route::post('/films/update/{film}', [App\Http\Controllers\FilmController::class, 'update'])->name('films.update');
        Route::get('/films/d/{film}', [App\Http\Controllers\FilmController::class, 'destroy'])->name('films.destroy');
        Route::post('/films', [App\Http\Controllers\FilmController::class, 'store'])->name('films.store');*/


        Route::get('/calendar', [App\Http\Controllers\CalendarController::class, 'index'])->name('calendar.index');
        Route::post('/calendar/action', [App\Http\Controllers\CalendarController::class, 'action'])->name('calendar.action');

        //users - przeniesione

        Route::get('/messages', [App\Http\Controllers\MessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/sent', [App\Http\Controllers\MessageController::class, 'index2'])->name('messages.index2');
        Route::get('/messages/archived', [App\Http\Controllers\MessageController::class, 'index3'])->name('messages.index3');
        Route::get('/messages/new', [App\Http\Controllers\MessageController::class, 'create'])->name('messages.create');
        Route::post('/messages/new', [App\Http\Controllers\MessageController::class, 'store'])->name('messages.store');
        Route::get('/messages/{message}', [App\Http\Controllers\MessageController::class, 'show'])->name('messages.show');
        Route::post('/messages/unread/{message}', [App\Http\Controllers\MessageController::class, 'unread'])->name('messages.unread');
        Route::get('/messages/re/{message}', [App\Http\Controllers\MessageController::class, 'create2'])->name('messages.re');
        Route::post('/messages/archive/{message}', [App\Http\Controllers\MessageController::class, 'archive'])->name('messages.archive');
        Route::get('/messages/download/{message}', [App\Http\Controllers\MessageController::class, 'download'])->name('messages.download');
        Route::get('/messages/d/{message}', [App\Http\Controllers\MessageController::class, 'destroy'])->name('messages.destroy');


        Route::get('/courses', [App\Http\Controllers\CourseController::class, 'index'])->name('courses.index');
        Route::get('/courses/{course}', [App\Http\Controllers\CourseController::class, 'show'])->name('courses.show');
        Route::get('/courses/m/{course}', [App\Http\Controllers\CourseController::class, 'show2'])->name('courses.show2');
        Route::get('/courses/info/{course}', [App\Http\Controllers\CourseController::class, 'tab_info'])->name('courses.tab_info');
        Route::get('/courses/films/{course}', [App\Http\Controllers\CourseController::class, 'tab_films'])->name('courses.tab_films');
        Route::post('/courses/edit/{id}', [App\Http\Controllers\CourseController::class, 'edit'])->name('courses.edit');
        Route::post('/courses/update/{course}', [App\Http\Controllers\CourseController::class, 'update'])->name('course.update');
        Route::get('/courses/d/{course}', [App\Http\Controllers\CourseController::class, 'destroy'])->name('courses.destroy');
        Route::post('/courses', [App\Http\Controllers\CourseController::class, 'store'])->name('courses.store');

        Route::get('/tasks/editdate', [App\Http\Controllers\TaskController::class, 'edit_date'])->name('task.editdate');
        Route::post('/tasks/change_date', [App\Http\Controllers\TaskController::class, 'change_date'])->name('task.date');
        Route::get('/tasks', [App\Http\Controllers\TaskController::class, 'index'])->name('tasks.index');
        Route::get('/tasks/{task}', [App\Http\Controllers\TaskController::class, 'show'])->name('tasks.show');
        Route::get('/tasks/m/{task}', [App\Http\Controllers\TaskController::class, 'show2'])->name('tasks.show2');
        Route::post('/tasks/edit/{id}', [App\Http\Controllers\TaskController::class, 'edit'])->name('tasks.edit');
        Route::get('/tasks/edit2/{id}', [App\Http\Controllers\TaskController::class, 'edit2'])->name('tasks.edit2');
        Route::post('/tasks/update/{task}', [App\Http\Controllers\TaskController::class, 'update'])->name('task.update');
        Route::post('/tasks/update2/{task}', [App\Http\Controllers\TaskController::class, 'update2'])->name('task.update2');
        Route::get('/tasks/d/{task}', [App\Http\Controllers\TaskController::class, 'destroy'])->name('tasks.destroy');
        Route::post('/tasks/new', [App\Http\Controllers\TaskController::class, 'store'])->name('tasks.store');



        Route::get('/notes/search', [App\Http\Controllers\NoteController::class, 'auto_complete'])->name('notes.search');
        Route::get('/notes', [App\Http\Controllers\NoteController::class, 'index'])->name('notes.index');
        Route::get('/notes/{note}', [App\Http\Controllers\NoteController::class, 'show'])->name('notes.show');
        Route::get('/notes/m/{note}', [App\Http\Controllers\NoteController::class, 'show2'])->name('notes.show2');
        Route::post('/notes/edit/{id}', [App\Http\Controllers\NoteController::class, 'edit'])->name('notes.edit');
        Route::post('/notes/update/{note}', [App\Http\Controllers\NoteController::class, 'update'])->name('notes.update');
        Route::get('/notes/d/{note}', [App\Http\Controllers\NoteController::class, 'destroy'])->name('notes.destroy');
        Route::post('/notes/new', [App\Http\Controllers\NoteController::class, 'store'])->name('notes.store');

        Route::get('/clothes/index2', [App\Http\Controllers\ClothesController::class, 'index2'])->name('clothes.index2');
        Route::post('/clothes/update2', [App\Http\Controllers\ClothesController::class, 'update2'])->name('clothes.update2');


        Route::post('/word/{word}/update', [App\Http\Controllers\WordController::class, 'update'])->name('words.update');
        Route::post('/wordlists/{wordlist}/word/store', [App\Http\Controllers\WordController::class, 'store'])->name('words.store');
        Route::get('/wordlists/{wordlist}/word/create', [App\Http\Controllers\WordController::class, 'create'])->name('words.create');

        Route::get('/wordlist/{wordlist}/export', [App\Http\Controllers\WordlistController::class, 'export'])->name('wordlists.export');
        Route::post('/wordlist/{wordlist}/import', [App\Http\Controllers\WordlistController::class, 'import'])->name('wordlists.import');

        Route::get('/wordlists/{wordlist}#w{id}', [App\Http\Controllers\WordlistController::class, 'show'])->name('wordlists.show2');

        Route::get('/word/{word}/edit', [App\Http\Controllers\WordController::class, 'edit'])->name('words.edit');

        Route::get('/contacts/show2/{contact}', [App\Http\Controllers\ContactController::class, 'show2'])->name('contacts.show2');
        Route::get('/contacts/show3/{contact}', [App\Http\Controllers\ContactController::class, 'show3'])->name('contacts.show3');

        Route::get('/debts/index2', [App\Http\Controllers\DebtController::class, 'index2'])->name('debts.index2');

        Route::resource('importants', App\Http\Controllers\ImportantController::class);
        Route::resource('goals', App\Http\Controllers\GoalController::class);
        Route::resource('deadlines', App\Http\Controllers\DeadlineController::class);
        Route::resource('clothes', App\Http\Controllers\ClothesController::class);
        Route::resource('contacts', App\Http\Controllers\ContactController::class);
        Route::resource('debts', App\Http\Controllers\DebtController::class);
        Route::resource('wordlists', App\Http\Controllers\WordlistController::class);
        Route::resource('lessons', App\Http\Controllers\LessonController::class);


        Route::get('/changes/show2', [App\Http\Controllers\ChangeController::class, 'show2'])->name('changes.show2');
    });

    Route::middleware(['can:isReader'])->group(function(){
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

        Route::get('/dashboard2', [App\Http\Controllers\HomeController::class, 'dashboard2'])->name('dashboard2');
        Route::get('/settings', [App\Http\Controllers\SettingsController::class, 'edit'])->name('settings');
        Route::post('/settings/update', [App\Http\Controllers\SettingsController::class, 'update'])->name('settings.update');
        Route::post('/settings/update-pass', [App\Http\Controllers\SettingsController::class, 'update_pass'])->name('settings.update_pass');

    });
});




//Auth::routes();



//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
