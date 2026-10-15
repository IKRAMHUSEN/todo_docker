<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaraTodo 🐳</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', sans-serif; background: #f0f4f8; color: #333; }
        .container { max-width: 750px; margin: 40px auto; padding: 0 20px; }
        header { background: #2563eb; color: white; padding: 20px 30px; border-radius: 12px; margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center; }
        header h1 { font-size: 1.6rem; }
        header span { font-size: 0.85rem; opacity: 0.8; }
        .alert { padding: 12px 18px; border-radius: 8px; margin-bottom: 20px; font-weight: 500; }
        .alert-success { background: #d1fae5; color: #065f46; border-left: 4px solid #10b981; }
        .alert-error { background: #fee2e2; color: #991b1b; border-left: 4px solid #ef4444; }
        .btn { display: inline-block; padding: 9px 18px; border-radius: 8px; font-size: 0.9rem; font-weight: 600; text-decoration: none; border: none; cursor: pointer; transition: opacity 0.2s; }
        .btn:hover { opacity: 0.85; }
        .btn-primary { background: #2563eb; color: white; }
        .btn-success { background: #10b981; color: white; }
        .btn-warning { background: #f59e0b; color: white; }
        .btn-danger  { background: #ef4444; color: white; }
        .btn-sm { padding: 5px 12px; font-size: 0.8rem; }
        .btn-secondary { background: #6b7280; color: white; }
        .card { background: white; border-radius: 12px; padding: 25px; box-shadow: 0 1px 4px rgba(0,0,0,0.08); margin-bottom: 15px; }
        .form-group { margin-bottom: 18px; }
        label { display: block; font-weight: 600; margin-bottom: 6px; font-size: 0.9rem; color: #555; }
        input[type="text"], textarea {
            width: 100%; padding: 10px 14px; border: 1.5px solid #d1d5db;
            border-radius: 8px; font-size: 0.95rem; transition: border-color 0.2s;
        }
        input[type="text"]:focus, textarea:focus { outline: none; border-color: #2563eb; }
        textarea { height: 90px; resize: vertical; }
        .error-msg { color: #ef4444; font-size: 0.82rem; margin-top: 4px; }
        .todo-item { display: flex; align-items: center; gap: 15px; padding: 16px 20px; background: white; border-radius: 10px; box-shadow: 0 1px 3px rgba(0,0,0,0.07); margin-bottom: 12px; border-left: 4px solid #2563eb; }
        .todo-item.completed { border-left-color: #10b981; opacity: 0.75; }
        .todo-item.completed .todo-title { text-decoration: line-through; color: #9ca3af; }
        .todo-content { flex: 1; }
        .todo-title { font-size: 1rem; font-weight: 600; }
        .todo-desc { font-size: 0.85rem; color: #6b7280; margin-top: 3px; }
        .todo-actions { display: flex; gap: 8px; flex-shrink: 0; }
        .badge { display: inline-block; padding: 2px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
        .badge-done { background: #d1fae5; color: #065f46; }
        .badge-pending { background: #fef3c7; color: #92400e; }
        .empty-state { text-align: center; padding: 50px 20px; color: #9ca3af; }
        .empty-state h3 { font-size: 1.2rem; margin-bottom: 8px; }
        .stats { display: flex; gap: 12px; margin-bottom: 20px; }
        .stat-box { flex: 1; background: white; border-radius: 10px; padding: 15px; text-align: center; box-shadow: 0 1px 3px rgba(0,0,0,0.07); }
        .stat-number { font-size: 1.8rem; font-weight: 700; color: #2563eb; }
        .stat-label { font-size: 0.8rem; color: #6b7280; margin-top: 2px; }
    </style>
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
