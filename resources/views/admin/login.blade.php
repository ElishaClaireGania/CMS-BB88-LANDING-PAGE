<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - BB88 CMS</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: system-ui, sans-serif; background: #0d1117; color: #e6edf3; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
        .card { background: #161b22; border: 1px solid #30363d; border-radius: 12px; padding: 2rem; width: 100%; max-width: 380px; }
        h1 { font-size: 1.4rem; margin-bottom: 1.5rem; text-align: center; }
        label { display: block; font-size: 0.85rem; margin-bottom: 4px; color: #8b949e; }
        input { width: 100%; padding: 0.6rem 0.8rem; background: #0d1117; border: 1px solid #30363d; border-radius: 6px; color: #e6edf3; font-size: 1rem; margin-bottom: 1rem; }
        input:focus { outline: none; border-color: #1e88e5; }
        .btn { width: 100%; padding: 0.65rem; background: #1e88e5; color: white; border: none; border-radius: 6px; font-size: 1rem; cursor: pointer; }
        .btn:hover { background: #1a6aab; }
        .error { background: rgba(248,81,73,.1); border: 1px solid #f85149; border-radius: 6px; padding: 0.6rem 0.8rem; font-size: .85rem; color: #f85149; margin-bottom: 1rem; }
        .success { background: rgba(63,185,80,.1); border: 1px solid #3fb950; border-radius: 6px; padding: 0.6rem 0.8rem; font-size: .85rem; color: #3fb950; margin-bottom: 1rem; }
        .sub { text-align: center; margin-top: 1rem; font-size: .85rem; color: #8b949e; }
        .sub a { color: #1e88e5; text-decoration: none; }
        .back-link { display: block; text-align: center; margin-top: 0.5rem; font-size: 0.8rem; color: #8b949e; text-decoration: none; }
    </style>
</head>
<body>
<div class="card">
    <h1>Admin Login</h1>

    @if (session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <label for="username">Username</label>
        <input
            type="text"
            id="username"
            name="username"
            required
            autocomplete="username"
            value="{{ old('username') }}"
        >

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required autocomplete="current-password">

        <button class="btn" type="submit">Log In</button>
    </form>

    <p class="sub"><a href="{{ route('register') }}">Create an admin account &rarr;</a></p>
    <a href="{{ route('home') }}" class="back-link">&larr; Back to Landing Page</a>
</div>
</body>
</html>
