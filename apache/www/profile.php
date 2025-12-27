<?php
session_start();
require 'fungsi/koneksi.php';

// Cek Login
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

// Ambil data user
$user_id = $_SESSION["user_id"];
$result = mysqli_query($conn, "SELECT * FROM user WHERE user_id = $user_id");
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya | Go-Explore</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/profile_style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <section class="profile-section">
        <div class="profile-card">
            <img src="foto_user/<?= htmlspecialchars($user['profile_picture']); ?>" alt="Profile" class="profile-img-big">
            
            <h2><?= htmlspecialchars($user['username']); ?></h2>
            <span class="membership">Pelancong Riau</span>

            <div class="profile-info">
                <div class="info-group">
                    <label>Username</label>
                    <p><?= htmlspecialchars($user['username']); ?></p>
                </div>
                <div class="info-group">
                    <label>Email Terdaftar</label>
                    <p><?= htmlspecialchars($user['email']); ?></p>
                </div>
                <div class="info-group">
                    <label>Nomor Telepon</label>
                    <p><?= htmlspecialchars($user['phone_number']); ?></p>
                </div>
            </div>

            <div class="profile-actions">
                <a href="edit_profile.php" class="btn-profile btn-edit">
                    <i class="bi bi-pencil-square"></i> Edit Profil
                </a>
                <a href="ganti_password.php" class="btn-profile btn-password">
                    <i class="bi bi-shield-lock"></i> Ganti Password
                </a>
            </div>
        </div>
    </section>

    <footer>
        <p>Go-Explore — Platform Wisata</p>
    </footer>
</body>
</html>