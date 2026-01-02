<?php
if (session_status() === PHP_SESSION_NONE) session_start();

require_once __DIR__ . '/koneksi.php';

function requireAdmin() {
    if (session_status() === PHP_SESSION_NONE) session_start();

    if (empty($_SESSION['user_id'])) {
        // not logged in
        header('Location: ../../index.php');
        exit;
    }

    $user_id = intval($_SESSION['user_id']);
    global $conn;

    $stmt = $conn->prepare('SELECT role FROM user WHERE user_id = ? LIMIT 1');
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $res = $stmt->get_result();
    $row = $res->fetch_assoc();

    if (!$row || ($row['role'] ?? '') !== 'admin') {
        // not an admin
        header('Location: ../../index.php');
        exit;
    }
}

?>
