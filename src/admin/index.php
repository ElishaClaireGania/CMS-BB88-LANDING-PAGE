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
    <title>Document</title>
</head>
<body>
    <header>
        <h1>Admin Panel</h1>
        <div class="admin-info">
            <span>Logged in as: <strong><?= htmlspecialchars($admin) ?></strong></span> &nbsp; | &nbsp;
            <a href="/src/admin/logout.php" class="logout">Logout</a>
        </div>

    </header>
    <main>
        <h2>Page Sections</h2>
        <?php foreach ($sections as $row): ?>
            <a href="/src/admin/sections/<?=  $row['section'] ?>.php">
                <div class="name"><?= htmlspecialchars($row['section']) ?></div>
                <div class='bb88'>Updated: <?= $row['updated_at'] ?></div>
            </a>
        <?php endforeach; ?>
    </main>
</body>
</html>
