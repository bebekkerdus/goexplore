<?php
session_start();
require '../../fungsi/koneksi.php';

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["user_id"];
$res = mysqli_query($conn, "SELECT * FROM user WHERE user_id = $user_id");
$user = mysqli_fetch_assoc($res);

if (isset($_POST["submit"])) {
    $username = htmlspecialchars($_POST["username"]);
    $email = htmlspecialchars($_POST["email"]);
    $phone = htmlspecialchars($_POST["phone_number"]);
    $gambarLama = $_POST["gambarLama"];

    // Cek apakah user pilih gambar baru
    if ($_FILES['foto']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $query = "UPDATE user SET 
                username = '$username', 
                email = '$email', 
                phone_number = '$phone', 
                profile_picture = '$gambar' 
              WHERE user_id = $user_id";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil diubah!'); window.location.href='profile.php';</script>";
    } else {
        echo "<script>alert('Gagal mengubah data!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Profil | Go-Explore</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/profile_style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <section class="profile-section">
        <div class="profile-card">
            <h2>Edit Profil</h2>
            <form action="" method="post" enctype="multipart/form-data" class="profile-info">
                <input type="hidden" name="gambarLama" value="<?= $user["profile_picture"]; ?>">
                
                <div class="info-group">
                    <label>Foto Profil Baru</label>
                    <input type="file" name="foto" style="margin-top:10px;">
                </div>
                <div class="info-group">
                    <label>Username</label>
                    <input type="text" name="username" value="<?= $user['username']; ?>" required style="width:100%; padding:8px; border:1px solid #ddd; border-radius:5px;">
                </div>
                <div class="info-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?= $user['email']; ?>" required style="width:100%; padding:8px; border:1px solid #ddd; border-radius:5px;">
                </div>
                <div class="info-group">
                    <label>Nomor Telepon</label>
                    <input type="text" name="phone_number" value="<?= $user['phone_number']; ?>" required style="width:100%; padding:8px; border:1px solid #ddd; border-radius:5px;">
                </div>

                <div class="profile-actions">
                    <button type="submit" name="submit" class="btn-profile btn-edit" style="border:none; cursor:pointer;">Simpan Perubahan</button>
                    <a href="profile.php" class="btn-profile btn-password">Batal</a>
                </div>
            </form>
        </div>
    </section>
</body>
</html>