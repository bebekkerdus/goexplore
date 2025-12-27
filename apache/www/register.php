<?php
require 'fungsi/koneksi.php';

if (isset($_POST["submit"])) {
    if (RegisUser($_POST) > 0) {
        echo "<script>
            alert('Registrasi berhasil!');
            window.location.href = 'login.php';
        </script>";
    } else {
        echo "<script>alert('Registrasi gagal!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registrasi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="css/logres.css?v=1" />
  </head>
  <body>
    <div class="container">
      <form class="form-box" method="POST" action="" enctype="multipart/form-data">
        <a href="beranda.php" class="back-btn" title="Kembali ke Beranda">
          <i class="bi bi-arrow-left"></i> 
        </a>

        <h2>Registrasi</h2>

        <div class="input-group">
          <label>Username</label>
          <input type="text" name="username" placeholder="Masukkan username" required />
        </div>

        <div class="input-group">
          <label>Email</label>
          <input type="email" name="email" placeholder="Masukkan email" required />
        </div>

        <div class="input-group">
          <label>Password</label>
          <input type="password" name="password" placeholder="Buat password" required />
        </div>

        <div class="input-group">
          <label>No. Telepon</label>
          <input type="number" name="phone_number" placeholder="Masukkan No. HP" required />
        </div>

        <div class="input-group">
          <label>Foto Profil</label>
          <input type="file" name="foto" accept="image/*" placeholder="Pilih foto" />
          <small style="color: #666; display: block; margin-top: 5px;">Format: JPG, PNG, GIF (Max: 2MB)</small>
        </div>

        <button class="btn" type="submit" name="submit">Daftar</button>

        <p class="text">Sudah punya akun? <a href="login.php">Login</a></p>
      </form>
    </div>
  </body>
</html>
