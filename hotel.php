<?php 
session_start(); 
require 'fungsi/koneksi.php'; 
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hotel | Go-Explore</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/hotel_style.css" />
  </head>
  <body>
    <?php include 'navbar.php'; ?>

    <!-- HERO SECTION -->
    <header class="hero hotel-hero" style="background-image: url('image/hotelbg.png')">
      <div class="overlay"></div>
      <div class="hero-content">
        <h1>Temukan Penginapan yang Nyaman</h1>
        <p>Pilihan hotel terbaik untuk menemani liburanmu di Riau</p>
        <a href="#list-hotel" class="cta-btn">Lihat Hotel</a>
      </div>
    </header>

    <!-- HOTEL LIST -->
    <section id="list-hotel" class="destinasi-section">
      <h2>Daftar Hotel Rekomendasi</h2>
      <p class="subtitle">Tempat menginap terbaik dengan kenyamanan maksimal</p>

      <div class="hotel-grid">
        <!-- HOTEL 1 -->
        <div class="hotel-card">
          <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/08/ad/8b/6a/aryaduta-hotel-pekanbaru.jpg?w=900&h=500&s=1" alt="Hotel Aryaduta Pekanbaru" />
          <div class="hotel-card-body">
            <h3>Aryaduta Hotel Pekanbaru</h3>
            <p>Hotel mewah di pusat kota dengan kolam renang luas dan fasilitas premium.</p>
            <span class="hotel-price-tag">Rp 650.000 / malam</span>
          </div>
        </div>

        <!-- HOTEL 2 -->
        <div class="hotel-card">
          <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2d/07/cb/28/building.jpg?w=900&h=500&s=1" alt="Hotel Grand Zuri" />
          <div class="hotel-card-body">
            <h3>Grand Zuri Hotel</h3>
            <p>Penginapan modern dengan kamar nyaman dan akses mudah ke pusat belanja.</p>
            <span class="hotel-price-tag">Rp 480.000 / malam</span>
          </div>
        </div>

        <!-- HOTEL 3 -->
        <div class="hotel-card">
          <img src="https://images.trvl-media.com/lodging/9000000/8240000/8231600/8231583/0a768d77.jpg?impolicy=resizecrop&rw=1200&ra=fit" alt="Hotel Pangeran Pekanbaru" />
          <div class="hotel-card-body">
            <h3>Pangeran Hotel Pekanbaru</h3>
            <p>Fasilitas lengkap, suasana tenang, serta layanan ramah dan profesional.</p>
            <span class="hotel-price-tag">Rp 520.000 / malam</span>
          </div>
        </div>

        <!-- HOTEL 4 -->
        <div class="hotel-card">
          <img src="https://lh3.googleusercontent.com/p/AF1QipMuerIbyXb6Z4fylrYN4pBzBOwZfmTm-KWPsYJu=s680-w680-h510-rw" alt="Hotel Labersa Grand" />
          <div class="hotel-card-body">
            <h3>Labersa Grand Hotel & Convention Center</h3>
            <p>Hotel besar dekat theme park dengan kamar luas dan fasilitas keluarga lengkap.</p>
            <span class="hotel-price-tag">Rp 700.000 / malam</span>
          </div>
        </div>

        <!-- HOTEL 5 -->
        <div class="hotel-card">
          <img
            src="https://s-light.tiket.photos/t/01E25EBZS3W0FY9GTG6C42E1SE/rsfit19201280gsm/tix-hotel/images-web/2020/10/28/bbb3bea0-5407-4f76-bea1-9df8e85c40d6-1603901753364-cce707f270a0bad3c8c00166e8412311.jpg"
            alt="Hotel BATIQA Pekanbaru"
          />
          <div class="hotel-card-body">
            <h3>Batiqa Hotel Pekanbaru</h3>
            <p>Hotel modern berdesain minimalis dengan harga terjangkau.</p>
            <span class="hotel-price-tag">Rp 350.000 / malam</span>
          </div>
        </div>
      </div>
    </section>

    <!-- FOOTER -->
    <footer>
      <p>Go-Explore — Platform Wisata</p>
    </footer>
  </body>
</html>
