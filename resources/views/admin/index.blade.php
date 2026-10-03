<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - BB88 CMS</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: system-ui, sans-serif; background: #0d1117; color: #e6edf3; padding: 2rem; min-height: 100vh; }
        header { display: flex; justify-content: space-between; align-items: center; padding-bottom: 1.5rem; border-bottom: 1px solid #30363d; margin-bottom: 2rem; }
        h1 { font-size: 1.6rem; color: #58a6ff; }
        .admin-info { font-size: 0.95rem; color: #8b949e; display: flex; align-items: center; gap: 1rem; }
        .logout-btn { background: none; border: none; color: #f85149; font-size: 0.95rem; cursor: pointer; text-decoration: none; }
        .logout-btn:hover { text-decoration: underline; }
        h2 { font-size: 1.25rem; margin-bottom: 1rem; color: #e6edf3; }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 1.2rem; }
        .section-card { background: #161b22; border: 1px solid #30363d; border-radius: 8px; padding: 1.4rem; text-decoration: none; color: inherit; transition: border-color 0.2s, transform 0.2s; display: block; }
        .section-card:hover { border-color: #58a6ff; transform: translateY(-2px); }
        .name { font-size: 1.15rem; font-weight: 600; text-transform: capitalize; color: #58a6ff; margin-bottom: 0.5rem; }
        .bb88 { font-size: 0.8rem; color: #8b949e; margin-bottom: 0.8rem; }
        .edit-badge { display: inline-block; font-size: 0.75rem; background: #238636; color: white; padding: 0.2rem 0.5rem; border-radius: 4px; }
        .success { background: rgba(63,185,80,.1); border: 1px solid #3fb950; border-radius: 6px; padding: 0.8rem 1rem; font-size: .9rem; color: #3fb950; margin-bottom: 1.5rem; }
        .view-site { color: #58a6ff; text-decoration: none; }
    </style>
</head>
<body>
    <header>
        <div>
            <h1>Admin Panel (Laravel)</h1>
            <a href="{{ route('home') }}" target="_blank" class="view-site">&larr; View Live Landing Page</a>
        </div>
        <div class="admin-info">
            <span>Logged in as: <strong>{{ auth('admin')->user()->username ?? 'Admin' }}</strong></span>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </header>

    @if (session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <main>
        <h2>Editable Page Sections</h2>
        <div class="grid">
            @forelse ($sections as $row)
                <a href="{{ route('admin.sections.edit', $row->section) }}" class="section-card">
                    <div class="name">{{ $row->section }}</div>
                    <div class="bb88">Last Updated: {{ $row->updated_at ?? 'Default' }}</div>
                    <span class="edit-badge">Edit Section Content &rarr;</span>
                </a>
            @empty
                <p>No sections found in database. Run database seeder to populate.</p>
            @endforelse
        </div>
    </main>
</body>
</html>
