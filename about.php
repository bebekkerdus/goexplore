<?php 
session_start(); 
require 'fungsi/koneksi.php'; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami | Go-Explore</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/about_style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <!-- ABOUT HERO -->
    <header class="about-hero">
        <div class="overlay"></div>
        <div class="about-content">
            <h1>Tentang Go-Explore</h1>
            <p>Membawa keindahan Riau lebih dekat dengan para wisatawan.</p>
        </div>
    </header>

    <!-- ABOUT SECTION -->
    <section class="about-section">
        <div class="about-container">

            <div class="about-text">
                <h2>Siapa Kami?</h2>
                <p>
                    Go-Explore adalah platform pariwisata yang berfokus pada destinasi-destinasi wisata Indonesia terbaik. 
                    Kami hadir untuk membantu wisatawan menemukan pengalaman yang otentik, mulai dari wisata sejarah, alam, hingga budaya Melayu yang hangat.
                </p>

                <p>
                    Dengan data yang terkurasi, tampilan yang nyaman, serta informasi lengkap, 
                    kami berharap setiap perjalanan menjadi lebih mudah, aman, dan meninggalkan kesan mendalam.
                </p>

                <h3>Misi Kami</h3>
                <ul>
                    <li>Mempromosikan keindahan dan kekayaan wisata Riau.</li>
                    <li>Menyediakan informasi destinasi yang akurat dan mudah diakses.</li>
                    <li>Mendukung pengembangan ekonomi lokal melalui pariwisata.</li>
                </ul>
            </div>

            <div class="about-image">
                <img src="image/image1.png" alt="Tentang Go-Explore">
            </div>

        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <p>Go-Explore — Platform Wisata</p>
    </footer>
</body>
</html>
