<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Section: {{ $pageSection->section }} - BB88 CMS</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: system-ui, sans-serif; background: #0d1117; color: #e6edf3; padding: 2rem; min-height: 100vh; }
        header { display: flex; justify-content: space-between; align-items: center; padding-bottom: 1.5rem; border-bottom: 1px solid #30363d; margin-bottom: 2rem; }
        h1 { font-size: 1.5rem; color: #58a6ff; text-transform: capitalize; }
        .back-link { color: #8b949e; text-decoration: none; font-size: 0.9rem; }
        .back-link:hover { color: #58a6ff; }
        .editor-card { background: #161b22; border: 1px solid #30363d; border-radius: 8px; padding: 1.5rem; max-width: 900px; margin: 0 auto; }
        label { display: block; font-size: 0.9rem; margin-bottom: 0.5rem; color: #8b949e; }
        textarea { width: 100%; height: 420px; font-family: monospace, Consolas, 'Courier New'; background: #0d1117; border: 1px solid #30363d; border-radius: 6px; color: #7ee787; padding: 1rem; font-size: 0.95rem; line-height: 1.4; resize: vertical; }
        textarea:focus { outline: none; border-color: #58a6ff; }
        .btn-group { display: flex; justify-content: flex-end; gap: 1rem; margin-top: 1.2rem; }
        .btn { padding: 0.65rem 1.5rem; border-radius: 6px; font-size: 0.95rem; cursor: pointer; text-decoration: none; border: none; font-weight: 500; }
        .btn-save { background: #238636; color: white; }
        .btn-save:hover { background: #2ea043; }
        .btn-cancel { background: #30363d; color: #e6edf3; }
        .btn-cancel:hover { background: #3c444d; }
        .error { background: rgba(248,81,73,.1); border: 1px solid #f85149; border-radius: 6px; padding: 0.8rem 1rem; font-size: .9rem; color: #f85149; margin-bottom: 1.5rem; }
    </style>
</head>
<body>
    <header>
        <div>
            <h1>Edit Section: {{ $pageSection->section }}</h1>
            <a href="{{ route('admin.dashboard') }}" class="back-link">&larr; Back to Dashboard</a>
        </div>
    </header>

    @if ($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif

    <div class="editor-card">
        <form method="POST" action="{{ route('admin.sections.update', $pageSection->section) }}">
            @csrf
            <label for="content">Section JSON Content</label>
            <textarea id="content" name="content" required>{{ old('content', json_encode($pageSection->content, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)) }}</textarea>

            <div class="btn-group">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-cancel">Cancel</a>
                <button type="submit" class="btn btn-save">Save Changes</button>
            </div>
        </form>
    </div>
</body>
</html>
