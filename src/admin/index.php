<?php
require_once dirname(__DIR__, 2) . '/includes/function.php';
require_once dirname(__DIR__, 2) . '/config/database.php';
require_once dirname(__DIR__, 2) . '/includes/auth.php';


session_start();
requireLogin();

$admin =  $_SESSION['admin_username'];
$pdo = getPDO();


$stmt = $pdo->query('SELECT section, updated_at FROM page_sections ORDER BY section');
$sections = $stmt->fetchAll();

?>

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
        .admin-info { font-size: 0.95rem; color: #8b949e; }
        .logout { color: #f85149; text-decoration: none; margin-left: 0.5rem; }
        .logout:hover { text-decoration: underline; }
        h2 { font-size: 1.25rem; margin-bottom: 1rem; color: #e6edf3; }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 1rem; }
        .section-card { background: #161b22; border: 1px solid #30363d; border-radius: 8px; padding: 1.2rem; text-decoration: none; color: inherit; transition: border-color 0.2s, transform 0.2s; }
        .section-card:hover { border-color: #58a6ff; transform: translateY(-2px); }
        .name { font-size: 1.1rem; font-weight: 600; text-transform: capitalize; color: #58a6ff; margin-bottom: 0.5rem; }
        .bb88 { font-size: 0.8rem; color: #8b949e; }
    </style>
</head>
<body>
    <header>
        <h1>Admin Panel</h1>
        <div class="admin-info">
            <span>Logged in as: <strong><?= htmlspecialchars($admin) ?></strong></span>
            <a href="logout.php" class="logout">Logout</a>
        </div>
    </header>
    <main>
        <h2>Page Sections</h2>
        <div class="grid">
            <?php foreach ($sections as $row): ?>
                <div class="section-card">
                    <div class="name"><?= htmlspecialchars($row['section']) ?></div>
                    <div class='bb88'>Updated: <?= htmlspecialchars($row['updated_at']) ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
</body>
</html>
