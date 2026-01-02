<?php
session_start();
require '../fungsi/koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: ../halaman/user/destination.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: info_destinasi.php');
    exit;
}

// =====================
// DATA DARI FORM
// =====================
$destinasi = $_POST['destinasi'] ?? '';
$tanggal   = $_POST['tanggal'] ?? '';
$jumlah    = (int)($_POST['jumlah'] ?? 1);
$transport = $_POST['transportasi'] ?? 'Tanpa';

// =====================
// HITUNG BIAYA TRANSPORT
// =====================
$biaya_transport = 0;
if ($transport === "Motor") $biaya_transport = 10000;
if ($transport === "Mobil") $biaya_transport = 25000;
if ($transport === "Bus")   $biaya_transport = 30000;

// =====================
// TOTAL PEMBAYARAN
// =====================
$total = $jumlah * $biaya_transport;

// =====================
// SIMPAN PEMBAYARAN (PENDING)
// =====================
$pembayaran_id = null;
if (!empty($_SESSION['user_id'])) {
    $user_id = (int)$_SESSION['user_id'];
    $pembayaran_id = createPembayaranPending(
        $user_id,
        $transport,
        $jumlah,
        $tanggal,
        $total
    );
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran | Go-Explore</title>
    <link rel="stylesheet" href="style/pembayaran.css">
</head>
<body>

<header class="payment-header">
    <a href="../halaman/user/destination.php" class="btn-back">Kembali</a>
    <h1>Konfirmasi & Pembayaran</h1>
</header>

<form method="POST" action="status.php">
<div class="payment-container">

    <input type="hidden" name="destinasi" value="<?= htmlspecialchars($destinasi) ?>">
    <input type="hidden" name="tanggal" value="<?= htmlspecialchars($tanggal) ?>">
    <input type="hidden" name="jumlah" value="<?= $jumlah ?>">
    <input type="hidden" name="transportasi" value="<?= htmlspecialchars($transport) ?>">
    <input type="hidden" name="total" value="<?= $total ?>">
    <input type="hidden" name="pembayaran_id" value="<?= $pembayaran_id ?>">

    <!-- RINGKASAN -->
    <section class="order-summary">
        <h2>Ringkasan Pesanan</h2>

        <div class="summary-item">
            <span>Destinasi</span>
            <strong><?= htmlspecialchars($destinasi) ?></strong>
        </div>

        <div class="summary-item">
            <span>Tanggal Kunjungan</span>
            <strong><?= htmlspecialchars(date('d F Y', strtotime($tanggal))) ?></strong>
        </div>

        <div class="summary-item">
            <span>Jumlah Orang</span>
            <strong><?= $jumlah ?> Orang</strong>
        </div>

        <div class="summary-item">
            <span>Transportasi</span>
            <strong><?= htmlspecialchars($transport) ?></strong>
        </div>
    </section>

    <!-- RINCIAN -->
    <section class="price-detail">
        <h2>Rincian Biaya</h2>

        <div class="price-row">
            <span>Tiket (<?= $jumlah ?> × Rp <?= number_format($biaya_transport) ?>)</span>
            <span>Rp <?= number_format($total) ?></span>
        </div>

        <div class="price-row total">
            <strong>Total Pembayaran</strong>
            <strong>Rp <?= number_format($total) ?></strong>
        </div>
    </section>

    <!-- METODE -->
    <section class="payment-method">
        <h2>Metode Pembayaran</h2>

        <label class="method-item">
            <input type="radio" name="payment" value="Transfer Bank" checked>
            Transfer Bank
        </label>

        <label class="method-item">
            <input type="radio" name="payment" value="E-Wallet">
            E-Wallet
        </label>

        <label class="method-item">
            <input type="radio" name="payment" value="QRIS">
            QRIS
        </label>
    </section>

    <button type="submit" class="btn-pay">Bayar Sekarang</button>

</div>
</form>

<footer>
    <p>Go-Explore © 2025</p>
</footer>

</body>
</html>
