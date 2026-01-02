<?php 
session_start(); 
require '../fungsi/koneksi.php';

if(!isset($_SESSION['login'])){
    echo " 
    <script>
    alert('anda harus login terlebih dahulu');
    document.location.href = '../halaman/user/login.php';
    </script>
    ";
  }

// Accept either an integer id (?id=123) or a query string (?q=nama)
$destination = [];
if (isset($_GET['destinasi_id']) && is_numeric($_GET['destinasi_id'])) {
    $id = (int) $_GET['destinasi_id'];
    $destination = query("SELECT * FROM destinasi_wisata WHERE destinasi_id = $id LIMIT 1");
} else if (isset($_GET['q']) && strlen(trim($_GET['q'])) > 0) {
    $q = trim($_GET['q']);
    $q_esc = mysqli_real_escape_string($conn, $q);
    $destination = query("SELECT * FROM destinasi_wisata WHERE nama_destinasi = '$q_esc' LIMIT 1");
    if (empty($destination)) {
        $destination = query("SELECT * FROM destinasi_wisata WHERE nama_destinasi LIKE '%$q_esc%' LIMIT 1");
    }
}

if (empty($destination)) {
    $destination = [[
        'nama_destinasi' => 'Destinasi Tidak Ditemukan',
        'deskripsi' => 'Maaf, destinasi yang Anda pilih tidak ditemukan di database.',
        'foto_url' => 'default.jpg'
    ]];
}

$c = query("SELECT * FROM user WHERE user_id = " . (int)$_SESSION['user_id']);

$ulasan = [];
if (isset($_GET['destinasi_id'])) {
    $destinasi_id = (int)$_GET['destinasi_id'];
    $ulasan = query("
        SELECT nama, rating, komentar
        FROM ulasan
        WHERE dest_id = $destinasi_id
        ORDER BY id DESC
    ");
}


?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Info Destinasi | Go-Explore</title>
    <link rel="stylesheet" href="style/info.css">
</head>
<body>

<!-- HEADER -->
<header class="hero">
    <div class="hero-overlay">
        <?php if (!empty($_GET)): ?>

        <?php endif; ?>
        <a href="../halaman/user/destination.php" class="btn-back">Kembali</a>
        <h1><?php echo htmlspecialchars($destination[0]['nama_destinasi']); ?></h1>
    </div>
    <img src="../foto_wisata/<?php echo htmlspecialchars($destination[0]['foto']); ?>" alt="<?php echo htmlspecialchars($destination[0]['nama_destinasi']); ?>">
</header>

<!-- MAIN CONTENT -->
<div class="content">
    <div class="main">
        <h2>Deskripsi Destinasi</h2>
        <p>
            <?php echo htmlspecialchars($destination[0]['deskripsi']); ?>
        </p>

        <h3>Harga Tiket</h3>
        <p class="price">Rp 10.000 / orang</p><br>

        <!-- ULASAN -->
        <h2>Beri rating kami</h2>

        <form id="review-form" method="post" action="info_destinasi.php?destinasi_id=<?= (int)$_GET['destinasi_id'] ?>" >
            <p><?php echo htmlspecialchars($c[0]['username']); ?></p>
            <input type="hidden" name="nama" id="nama" value="<?php echo htmlspecialchars($c[0]['username']); ?>">

            <input type="hidden" name="destinasi_id" value="<?= (int)$_GET['destinasi_id'] ?>">

            <div class="rating" id="rating-stars">
                <span data-value="1">★</span>
                <span data-value="2">★</span>
                <span data-value="3">★</span>
                <span data-value="4">★</span>
                <span data-value="5">★</span>
            </div>

            <input type="hidden" name="rating" id="rating" required>

            <textarea id="komentar" name="komentar" placeholder="Tulis ulasan..." required></textarea>
            <button class="review-btn" id="submit-review" name="submit_review" type="submit">Kirim Ulasan</button>
        </form><br>

        <h2>Ulasan pengunjung</h2>
        <div class="review-container">
        <?php if (empty($ulasan)): ?>
            <p>Belum ada ulasan.</p>
        <?php else: ?>
            <?php foreach ($ulasan as $u): ?>
                <div class="review-item">
                    <strong><?= htmlspecialchars($u['nama']) ?></strong>

                    <div class="stars">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <?= $i <= $u['rating'] ? '★' : '☆' ?>
                        <?php endfor; ?>
                    </div>

                    <p><?= nl2br(htmlspecialchars($u['komentar'])) ?></p>
                </div>
                <hr>
            <?php endforeach; ?>
        <?php endif; ?>
        </div>
    </div>

    <!-- SIDEBAR -->
<aside class="sidebar booking-box">
    <h2>Pemesanan Tiket</h2>

    <form action="pembayaran.php" method="POST">
    <input type="hidden" name="destinasi" value="<?php echo htmlspecialchars($destination[0]['nama_destinasi']); ?>">
    <input type="hidden" name="destinasi_id" value="<?= (int)$_GET['destinasi_id'] ?>">

        <label>Tanggal Kunjungan</label>
        <input type="date" name="tanggal" required> 

        <label>Jumlah Orang</label>
        <input type="number" name="jumlah" min="1" value="1" required>

        <label>Transportasi</label>
        <select name="transportasi" required>
        <option value="Tanpa">-----------</option>
        <option value="Motor">Motor</option>
        <option value="Mobil">Mobil</option>
        <option value="Bus">Bus</option>
        </select>

        <!-- CTA -->
        <div class="booking-footer">
            <button type="submit" class="btn-primary">
                Pesan Sekarang
            </button>
        </div>
    </form>
</aside>

</div>

<footer>
    <p>Go-Explore © 2025</p>
</footer>

<script src="js/script.js" ></script>



<?php
if (isset($_POST['submit_review'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $rating = (int)$_POST['rating'];
    $komentar = mysqli_real_escape_string($conn, $_POST['komentar']);
    $destinasi_id = (int)$_POST['destinasi_id'];

    $insert_query = "
        INSERT INTO ulasan (dest_id, nama, rating, komentar)
        VALUES ($destinasi_id, '$nama', $rating, '$komentar')
    ";

    if (mysqli_query($conn, $insert_query)) {
        echo "<script>
            alert('Ulasan berhasil dikirim!');
            window.location.href='info_destinasi.php?destinasi_id=$destinasi_id';
        </script>";
    } else {
        echo "<script>alert('Gagal mengirim ulasan!');</script>";
    }
}


?>
</body>
</html>
