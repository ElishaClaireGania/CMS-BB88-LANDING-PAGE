<?php
require_once dirname(__DIR__) . '/../config/database.php';
require_once dirname(__DIR__) . '/../includes/auth.php';
require_once dirname(__DIR__) . '/../includes/function.php';

session_start();

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitize($_POST['username'] ?? '')[cite: 12];
    $password = $_POST['password'] ?? ''[cite: 12];
    $confirm  = $_POST['confirm'] ?? ''[cite: 12];

    // Validation
    if (empty($username) || empty($password)) {
        $error = 'All fields are required.';[cite: 12]
    } elseif (strlen($password) < 8) {
        $error = 'Password must be at least 8 characters.';[cite: 12]
    } elseif ($password !== $confirm) {
        $error = 'Passwords do not match.';[cite: 12]
    } else {
        $pdo = getPDO();[cite: 12]

        // Check kung nagagamit na ang username
        $stmt = $pdo->prepare('SELECT id FROM admins WHERE username = ?');[cite: 12]
        $stmt->execute([$username]);[cite: 12]

        if ($stmt->fetch()) {
            $error = 'That username is already taken.';[cite: 12]
        } else {
            // Hash ng password gamit ang bcrypt
            $hash = password_hash($password, PASSWORD_DEFAULT);[cite: 12]

            $stmt = $pdo->prepare('INSERT INTO admins (username, password_hash) VALUES (?, ?)');[cite: 12]
            $stmt->execute([$username, $hash]);[cite: 12]

            $success = 'Account created! <a href="/src/admin/login.php">Log in</a>';[cite: 12]
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - BB88 CMS</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }[cite: 13]
        body { font-family: system-ui, sans-serif; background: #0d1117; color: #e6edf3; display: flex; align-items: center; justify-content: center; min-height: 100vh; }[cite: 13]
        .card { background: #161b22; border: 1px solid #30363d; border-radius: 12px; padding: 2rem; width: 100%; max-width: 380px; }[cite: 13]
        h1 { font-size: 1.4rem; margin-bottom: 1.5rem; text-align: center; }[cite: 13]
        label { display: block; font-size: 0.85rem; margin-bottom: 4px; color: #8b949e; }[cite: 13]
        input { width: 100%; padding: 0.6rem 0.8rem; background: #0d1117; border: 1px solid #30363d; border-radius: 6px; color: #e6edf3; font-size: 1rem; margin-bottom: 1rem; }[cite: 13]
        input:focus { outline: none; border-color: #1e88e5; }[cite: 13]
        .btn { width: 100%; padding: 0.65rem; background: #1e88e5; color: white; border: none; border-radius: 6px; font-size: 1rem; cursor: pointer; }[cite: 13]
        .btn:hover { background: #1a6aab; }[cite: 13]
        .error { background: rgba(248,81,73,.1); border: 1px solid #f85149; border-radius: 6px; padding: 0.6rem 0.8rem; font-size: .85rem; color: #f85149; margin-bottom: 1rem; }[cite: 13]
        .success { background: rgba(63,185,80,.1); border: 1px solid #3fb950; border-radius: 6px; padding: 0.6rem 0.8rem; font-size: .85rem; color: #3fb950; margin-bottom: 1rem; }[cite: 13]
        .sub { text-align: center; margin-top: 1rem; font-size: .85rem; color: #8b949e; }[cite: 13]
        .sub a { color: #1e88e5; text-decoration: none; }[cite: 13]
    </style>
</head>
<body>
<div class="card">
    <h1>Create Admin</h1>

    <?php if ($error): ?><div class="error"><?= $error ?></div><?php endif; ?>[cite: 11]
    <?php if ($success): ?><div class="success"><?= $success ?></div><?php endif; ?>[cite: 11]

    <?php if (!$success): ?>
    <form method="POST">
        <label>Username</label>
        <input type="text" name="username" required value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">[cite: 11]

        <label>Password</label>
        <input type="password" name="password" required>[cite: 11]

        <label>Confirm Password</label>
        <input type="password" name="confirm" required>[cite: 11]

        <button class="btn" type="submit">Create Account</button>[cite: 11]
    </form>
    <?php endif; ?>
</div>
</body>
</html>