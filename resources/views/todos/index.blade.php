@extends('todos.layout')

@section('content')
<header>
    <div>
        <h1>🐳 LaraTodo</h1>
        <span>Laravel + MySQL + Docker</span>
    </div>
    <a href="{{ route('todos.create') }}" class="btn btn-success">+ New Todo</a>
</header>

{{-- Flash Messages --}}
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

{{-- Stats --}}
@php
    $total = $todos->count();
    $done  = $todos->where('is_completed', true)->count();
    $pending = $total - $done;
@endphp

<div class="stats">
    <div class="stat-box">
        <div class="stat-number">{{ $total }}</div>
        <div class="stat-label">Total Todos</div>
    </div>
    <div class="stat-box">
        <div class="stat-number" style="color:#10b981">{{ $done }}</div>
        <div class="stat-label">Completed</div>
    </div>
    <div class="stat-box">
        <div class="stat-number" style="color:#f59e0b">{{ $pending }}</div>
        <div class="stat-label">Pending</div>
    </div>
</div>

{{-- Todos List --}}
@forelse($todos as $todo)
    <div class="todo-item {{ $todo->is_completed ? 'completed' : '' }}">
        <div class="todo-content">
            <div class="todo-title">{{ $todo->title }}</div>
            @if($todo->description)
                <div class="todo-desc">{{ $todo->description }}</div>
            @endif
            <div style="margin-top:6px">
                <span class="badge {{ $todo->is_completed ? 'badge-done' : 'badge-pending' }}">
                    {{ $todo->is_completed ? '✅ Done' : '⏳ Pending' }}
                </span>
                <span style="font-size:0.75rem; color:#9ca3af; margin-left:8px">
                    {{ $todo->created_at->diffForHumans() }}
                </span>
            </div>
        </div>
        <div class="todo-actions">
            {{-- Toggle Done/Pending --}}
            <form action="{{ route('todos.toggle', $todo) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-sm {{ $todo->is_completed ? 'btn-warning' : 'btn-success' }}">
                    {{ $todo->is_completed ? 'Undo' : 'Done' }}
                </button>
            </form>

            {{-- Edit --}}
            <a href="{{ route('todos.edit', $todo) }}" class="btn btn-sm btn-warning">Edit</a>

            {{-- Delete --}}
            <form action="{{ route('todos.destroy', $todo) }}" method="POST"
                  onsubmit="return confirm('Delete this todo?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </form>
        </div>
    </div>
@empty
    <div class="empty-state">
        <h3>No todos yet!</h3>
        <p>Click "+ New Todo" to add your first task.</p>
    </div>
@endforelse
@endsection
