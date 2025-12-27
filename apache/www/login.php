<?php
session_start();
require 'fungsi/koneksi.php';

$error = "";

if (isset($_POST["login"])) {
    $email = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
    
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            $_SESSION["login"] = true;
            $_SESSION["user_id"] = $row["user_id"];
            $_SESSION["email"] = $row["email"];
            header("Location: beranda.php");
            exit();
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Email tidak ditemukan!";
    }
}

?>

<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="css/logres.css?v=1" />
  </head>
  <body>
    <div class="container">
      <form class="form-box" method="POST" action="">
        <a href="beranda.php" class="back-btn" title="Kembali ke Beranda">
          <i class="bi bi-arrow-left"></i>
        </a>
        <h2>Login</h2>

        <?php if ($error): ?>
          <div class="alert alert-danger" style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px; border: 1px solid #f5c6cb;">
            <?php echo $error; ?>
          </div>
        <?php endif; ?>

        <div class="input-group">
          <label>Email</label>
          <input type="email" name="username" placeholder="Masukkan email" required />
        </div>

        <div class="input-group">
          <label>Password</label>
          <input type="password" name="password" placeholder="Masukkan password" required />
        </div>

        <button name="login" class="btn">Login</button>

        <p class="text">Belum punya akun? <a href="register.php">Registrasi</a></p>
      </form>
    </div>
  </body>
</html> 