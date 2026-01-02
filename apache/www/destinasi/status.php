<?php 
session_start(); 
require '../fungsi/koneksi.php'; 

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../halaman/user/beranda.php");
    exit;
}

if(!isset($_SESSION['login'])){
     header("Location:../halman/user/destination.php");
  }

// ini cuma data dummy, ganti2 aja sesuai keperluan, buat ngetes alur
$destinasi     = $_POST['destinasi'] ?? '-';
$tanggal       = $_POST['tanggal'] ?? '-';
$jumlah        = $_POST['jumlah'] ?? '-';
$transportasi  = $_POST['transportasi'] ?? '-';
$total         = $_POST['total'] ?? '-';
$metode        = $_POST['payment'] ?? '-';
$pembayaran_id = intval($_POST['pembayaran_id'] ?? 0);

// If we have a pembayaran id, mark it as completed (Berhasil)
if ($pembayaran_id > 0) {
    $update = updatePembayaranStatus($pembayaran_id, 'Berhasil', $metode);
    // If update failed, you could handle/log here. For now continue to show success page.
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Status Pembayaran | Go-Explore</title>
    <link rel="stylesheet" href="style/status.css">
</head>
<body>

<div class="success-box">
    <div class="success-icon">
        <img src="../image/success.png" alt="Pembayaran Berhasil">
    </div>

    <h1>Pembayaran Berhasil</h1>

    <p><strong>Destinasi:</strong> <?= $destinasi ?></p>
    <p><strong>Tanggal:</strong> <?= $tanggal ?></p>
    <p><strong>Jumlah Orang:</strong> <?= $jumlah ?></p>
    <p><strong>Transportasi:</strong> <?= $transportasi ?></p>
    <p><strong>Metode Bayar:</strong> <?= $metode ?></p>
    <p><strong>Total:</strong> Rp <?= number_format($total, 0, ',', '.') ?></p>

    <a href="../halaman/user/destination.php" class="btn-home">Kembali</a>
</div>

</body>
</html>

<script>
    document.addEventListener("DOMContentLoaded", () => {
    const btn = document.querySelector(".btn-home");

    setTimeout(() => {
        btn.style.transform = "scale(1.05)";
        setTimeout(() => {
            btn.style.transform = "scale(1)";
        }, 200);
    }, 1200);
});

</script>
</html>
