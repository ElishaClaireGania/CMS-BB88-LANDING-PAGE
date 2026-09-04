<?php
require_once __DIR__ . '/../config/database.php';
function requireLogin(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (empty($_SESSION['admin_id'])) {
        header('Location: /src/admin/login.php');
        exit;
    }
}
function isLoggedIn(): bool
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    return !empty($_SESSION['admin_id']);
}
function getCurrentAdmin(): ?array
{
    if (!isLoggedIn()) {
        return null;
    }

    try {
        $pdo = getPDO();
        $stmt = $pdo->prepare("SELECT * FROM admins WHERE id = ? LIMIT 1");
        $stmt->execute([$_SESSION['admin_id']]);
        $admin = $stmt->fetch();
        
        return $admin ?: null;
    } catch (PDOException $e) {
        return null;
    }
}