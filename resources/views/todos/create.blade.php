@extends('todos.layout')

@section('content')
<header>
    <div>
        <h1>🐳 LaraTodo</h1>
        <span>Create New Todo</span>
    </div>
    <a href="{{ route('todos.index') }}" class="btn btn-secondary">← Back</a>
</header>

<div class="card">
    <h2 style="margin-bottom:20px; font-size:1.2rem;">➕ Add New Todo</h2>

    <form action="{{ route('todos.store') }}" method="POST">
        @csrf {{-- Laravel security token — prevents CSRF attacks --}}

        <div class="form-group">
            <label for="title">Title <span style="color:red">*</span></label>
            <input type="text" id="title" name="title"
                   value="{{ old('title') }}"
                   placeholder="e.g. Learn Docker Compose"
                   autofocus>
            @error('title')
                <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description <span style="color:#9ca3af">(optional)</span></label>
            <textarea id="description" name="description"
                      placeholder="Add more details...">{{ old('description') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Save Todo</button>
        <a href="{{ route('todos.index') }}" class="btn btn-secondary" style="margin-left:8px">Cancel</a>
    </form>
</div>
@endsection
