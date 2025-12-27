<?php 
session_start(); 
require 'fungsi/koneksi.php'; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak | Go-Explore</title>
    <link rel="stylesheet" href="css/contact_style.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'navbar.php'; ?>
     <!-- HERO SECTION -->
    <header class="hero" style="background-image: url('https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&w=1200&q=80');">
        <div class="overlay"></div>
        <div class="hero-content">
        <h1>Kontak Kami</h1>
        <p>Kirim pesan atau pertanyaanmu melalui formulir berikut.</p>
        </div>
    </header>
    <!-- CONTACT FORM -->
    <section class="contact-section">
        <div class="container contact-grid">

            <!-- Info -->
            <div class="contact-info">
                <h2>Informasi Kontak</h2>
                <p>Email: goexplores@gmail.com</p>
                <p>Telepon: +62 812-3456-7890</p>
                <p>Alamat: Pekanbaru, Riau, Indonesia</p>
            </div>

            <!-- Form -->
            <form class="contact-form">
                <h2>Kirim Pesan</h2>

                <input type="text" placeholder="Nama" required>
                <input type="email" placeholder="Email" required>
                <textarea placeholder="Pesanmu..." required></textarea>

                <button type="submit">Kirim</button>
            </form>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer">
        <p>Go-Explore — Platform Wisata</p>
    </footer>

</body>
</html>