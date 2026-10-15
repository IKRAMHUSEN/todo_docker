<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * INDEX — Show all todos
     * Route: GET /todos
     */
    public function index()
    {
        // Fetch all todos, newest first
        $todos = Todo::latest()->get();
        return view('todos.index', compact('todos'));
    }

    /**
     * CREATE — Show the form to create a new todo
     * Route: GET /todos/create
     */
    public function create()
    {
        return view('todos.create');
    }

    /**
     * STORE — Save new todo to MySQL database
     * Route: POST /todos
     */
    public function store(Request $request)
    {
        // Validate input from the form
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Create and save to database
        Todo::create([
            'title'       => $request->title,
            'description' => $request->description,
            'is_completed' => false,
        ]);

        return redirect()->route('todos.index')
            ->with('success', '✅ Todo created successfully!');
    }

    /**
     * EDIT — Show form to edit an existing todo
     * Route: GET /todos/{id}/edit
     */
    public function edit(Todo $todo)
    {
        return view('todos.edit', compact('todo'));
    }

    /**
     * UPDATE — Save changes to existing todo
     * Route: PUT /todos/{id}
     */
    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $todo->update([
            'title'        => $request->title,
            'description'  => $request->description,
            'is_completed' => $request->has('is_completed'),
        ]);

        return redirect()->route('todos.index')
            ->with('success', '✏️ Todo updated successfully!');
    }

    /**
     * DESTROY — Delete a todo from the database
     * Route: DELETE /todos/{id}
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->route('todos.index')
            ->with('success', '🗑️ Todo deleted successfully!');
    }

    /**
     * TOGGLE — Toggle completed/pending status
     * Route: POST /todos/{id}/toggle
     */
    public function toggle(Todo $todo)
    {
        $todo->update(['is_completed' => !$todo->is_completed]);
        return redirect()->route('todos.index')
            ->with('success', $todo->is_completed ? '✅ Marked as complete!' : '🔄 Marked as pending!');
    }
}
