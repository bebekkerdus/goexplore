<?php
session_start();
require 'fungsi/koneksi.php';

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST["change"])) {
    $user_id = $_SESSION["user_id"];
    $old_pass = $_POST["old_password"];
    $new_pass = $_POST["new_password"];
    $confirm_pass = $_POST["confirm_password"];

    $res = mysqli_query($conn, "SELECT password FROM user WHERE user_id = $user_id");
    $row = mysqli_fetch_assoc($res);

    if (password_verify($old_pass, $row["password"])) {
        if ($new_pass === $confirm_pass) {
            $hashed_pass = password_hash($new_pass, PASSWORD_DEFAULT);
            mysqli_query($conn, "UPDATE user SET password = '$hashed_pass' WHERE user_id = $user_id");
            echo "<script>alert('Password berhasil diganti!'); window.location.href='profile.php';</script>";
        } else {
            echo "<script>alert('Konfirmasi password tidak sesuai!');</script>";
        }
    } else {
        echo "<script>alert('Password lama salah!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ganti Password | Go-Explore</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/profile_style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <section class="profile-section">
        <div class="profile-card">
            <h2>Ganti Password</h2>
            <form action="" method="post" class="profile-info">
                <div class="info-group">
                    <label>Password Lama</label>
                    <input type="password" name="old_password" required style="width:100%; padding:8px; border:1px solid #ddd; border-radius:5px;">
                </div>
                <div class="info-group">
                    <label>Password Baru</label>
                    <input type="password" name="new_password" required style="width:100%; padding:8px; border:1px solid #ddd; border-radius:5px;">
                </div>
                <div class="info-group">
                    <label>Konfirmasi Password Baru</label>
                    <input type="password" name="confirm_password" required style="width:100%; padding:8px; border:1px solid #ddd; border-radius:5px;">
                </div>

                <div class="profile-actions">
                    <button type="submit" name="change" class="btn-profile btn-edit" style="border:none; cursor:pointer;">Perbarui Password</button>
                    <a href="profile.php" class="btn-profile btn-password">Batal</a>
                </div>
            </form>
        </div>
    </section>
</body>
</html>