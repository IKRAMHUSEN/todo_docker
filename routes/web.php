<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

// Redirect homepage to todos list
Route::get('/', function () {
    return redirect()->route('todos.index');
});

// Resource routes — creates all 7 CRUD routes automatically:
// GET    /todos           → index()   (list all todos)
// GET    /todos/create    → create()  (show create form)
// POST   /todos           → store()   (save new todo)
// GET    /todos/{id}/edit → edit()    (show edit form)
// PUT    /todos/{id}      → update()  (save changes)
// DELETE /todos/{id}      → destroy() (delete todo)
Route::resource('todos', TodoController::class);

// Extra route: toggle completed status
Route::post('/todos/{todo}/toggle', [TodoController::class, 'toggle'])->name('todos.toggle');
