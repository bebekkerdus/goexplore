<?php 
session_start(); 
require 'fungsi/koneksi.php'; 
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Destinasi | Go-Explore</title>
    <link rel="stylesheet" href="css/destination_style.css" />
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <?php include 'navbar.php'; ?>

    <!-- HERO SECTION -->
    <header class="hero" style="background-image: url('https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&w=1200&q=80')">
      <div class="overlay"></div>
      <div class="hero-content">
        <h1>Jelajahi Keindahan Riau</h1>
        <p>Temukan destinasi wisata terbaik di seluruh penjuru Riau</p>
        <a href="#list-destinasi" class="cta-btn">Lihat Destinasi</a>
      </div>
    </header>

    <!-- FILTER SECTION -->
    <section class="filter-box">
      <div class="container filter-container">
        <!-- SEARCH -->
        <div class="search-box">
          <input type="text" placeholder="Cari destinasi... (nonaktif)" />
          <button>Cari</button>
        </div>

        <!-- FILTER -->
        <div class="price-filter">
          <label>Filter Harga:</label>
          <select onchange="location = this.value;">
            <option value="#all">Semua</option>
            <option value="#low">Rp 10.000 - Rp 50.000</option>
            <option value="#mid">Rp 50.000 - Rp 100.000</option>
            <option value="#high">Rp 100.000+</option>
          </select>
        </div>
      </div>
    </section>

    <!-- DESTINASI LIST -->
    <section id="list-destinasi" class="destinasi-section">
      <h2>Daftar Destinasi Wisata</h2>
      <p class="subtitle">Nikmati pengalaman wisata yang mengesankan di Riau</p>

      <div class="card-container">
        <!-- DEST 1 -->
        <div class="card" id="low">
          <img src="image/dest1.png" alt="Masjid Agung An-Nur" />
          <div class="card-body">
            <h3>Masjid Agung An-Nur</h3>
            <p>Ikon Pekanbaru dengan arsitektur megah, sering disebut sebagai Taj Mahal Riau.</p>
            <span class="price-tag">Gratis</span>
          </div>
        </div>

        <!-- DEST 2 -->
        <div class="card" id="mid">
          <img src="image/dest2.png" alt="Danau Zamrud" />
          <div class="card-body">
            <h3>Danau Zamrud</h3>
            <p>Danau sunyi di tengah hutan, cocok untuk menikmati panorama alam.</p>
            <span class="price-tag">Rp 50.000</span>
          </div>
        </div>

        <!-- DEST 3 -->
        <div class="card" id="high">
          <img src="image/dest3.png" alt="Bono Sungai Kampar" />
          <div class="card-body">
            <h3>Bono Sungai Kampar</h3>
            <p>Fenomena ombak sungai raksasa yang sangat populer untuk surfing ekstrem.</p>
            <span class="price-tag">Rp 150.000</span>
          </div>
        </div>

        <!-- DEST 4 -->
        <div class="card" id="mid">
          <img src="image/dest4.png" alt="Air Terjun Guruh Gemurai" />
          <div class="card-body">
            <h3>Air Terjun Guruh Gemurai</h3>
            <p>Air terjun deras di tengah hutan tropis dengan suasana alami.</p>
            <span class="price-tag">Rp 40.000</span>
          </div>
        </div>

        <!-- DEST 5 -->
        <div class="card" id="low">
          <img src="image/dest5.png" alt="Istana Siak" />
          <div class="card-body">
            <h3>Istana Siak Sri Indrapura</h3>
            <p>Bangunan kerajaan bersejarah yang megah dengan arsitektur Eropa–Melayu.</p>
            <span class="price-tag">Rp 10.000</span>
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
