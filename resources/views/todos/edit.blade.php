@extends('todos.layout')

@section('content')
<header>
    <div>
        <h1>🐳 LaraTodo</h1>
        <span>Edit Todo</span>
    </div>
    <a href="{{ route('todos.index') }}" class="btn btn-secondary">← Back</a>
</header>

<div class="card">
    <h2 style="margin-bottom:20px; font-size:1.2rem;">✏️ Edit Todo</h2>

    <form action="{{ route('todos.update', $todo) }}" method="POST">
        @csrf
        @method('PUT') {{-- HTML forms only support GET/POST, @method('PUT') tricks Laravel --}}

        <div class="form-group">
            <label for="title">Title <span style="color:red">*</span></label>
            <input type="text" id="title" name="title"
                   value="{{ old('title', $todo->title) }}"
                   autofocus>
            @error('title')
                <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description">{{ old('description', $todo->description) }}</textarea>
        </div>

        <div class="form-group" style="display:flex; align-items:center; gap:10px;">
            <input type="checkbox" id="is_completed" name="is_completed"
                   {{ $todo->is_completed ? 'checked' : '' }}
                   style="width:18px; height:18px; cursor:pointer;">
            <label for="is_completed" style="margin:0; cursor:pointer;">Mark as Completed</label>
        </div>

        <button type="submit" class="btn btn-primary">Update Todo</button>
        <a href="{{ route('todos.index') }}" class="btn btn-secondary" style="margin-left:8px">Cancel</a>
    </form>
</div>
@endsection
