<?php
session_start();
require '../../fungsi/koneksi.php';
header('Content-Type: application/json');

if (!isset($_SESSION['login'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

$action = $_POST['action'] ?? '';
$pembayaran_id = intval($_POST['pembayaran_id'] ?? 0);

if ($action === 'cancel') {
    if ($pembayaran_id <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid id']);
        exit;
    }

    $res = updatePembayaranStatus($pembayaran_id, 'Gagal');
    if ($res === false) {
        echo json_encode(['success' => false, 'message' => 'Update failed']);
    } else {
        echo json_encode(['success' => true, 'message' => 'Pembayaran dibatalkan']);
    }
    exit;
}

echo json_encode(['success' => false, 'message' => 'Unknown action']);
