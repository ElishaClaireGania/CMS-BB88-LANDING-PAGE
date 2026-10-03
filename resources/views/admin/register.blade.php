<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Admin - BB88 CMS</title>
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
    </style>
</head>
<body>
<div class="card">
    <h1>Create Admin</h1>

    @if ($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <label for="username">Username</label>
        <input type="text" id="username" name="username" required value="{{ old('username') }}">

        <label for="password">Password (min 8 chars)</label>
        <input type="password" id="password" name="password" required>

        <label for="password_confirmation">Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>

        <button class="btn" type="submit">Create Account</button>
    </form>

    <p class="sub"><a href="{{ route('login') }}">Already have an account? Log in &rarr;</a></p>
</div>
</body>
</html>
