<?php 
session_start(); 
require 'fungsi/koneksi.php'; 
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Blog | Go-Explore</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/blog_style.css" />
  </head> 

  <body>
    <?php include 'navbar.php'; ?>
    <!-- HERO SECTION -->
    <header class="hero" style="background-image: url('https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&w=1200&q=80')">
      <div class="overlay"></div>
      <div class="hero-content">
        <h1>Blog & Artikel Wisata</h1>
        <p>Temukan cerita, tips perjalanan, dan inspirasi menjelajahi Riau.</p>
      </div>
    </header>

    <!-- BLOG SECTION -->
    <section class="blog-section">
      <div class="container">
        <div class="blog-grid">
          <!-- Item 1 -->
          <article class="blog-card">
            <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/0c/81/43/11/pantai-rupat-utara.jpg?w=700&h=400&s=1" alt="Pantai Rupat" />
            <div class="text">
              <h3>Pesona Pantai Rupat Utara</h3>
              <p>Pantai berpasir putih yang menenangkan dengan hamparan laut biru yang seolah tak berujung.</p>
              <a href="#" class="read-btn">Baca Selengkapnya</a>
            </div>
          </article>

          <!-- Item 2 -->
          <article class="blog-card">
            <img src="https://www.djkn.kemenkeu.go.id/files/images/2022/03/IMG_8409.JPG" alt="Istana Siak" />
            <div class="text">
              <h3>Menelusuri Sejarah di Istana Siak</h3>
              <p>Bangunan megah peninggalan Kesultanan Siak yang penuh cerita dan keanggunan.</p>
              <a href="#" class="read-btn">Baca Selengkapnya</a>
            </div>
          </article>

          <!-- Item 3 -->
          <article class="blog-card">
            <img src="https://jadesta.kemenparekraf.go.id/imgpost/27096.jpg" alt="Danau Zamrud" />
            <div class="text">
              <h3>Danau Zamrud, Surga Tersembunyi di Riau</h3>
              <p>Sebuah kawasan konservasi yang menghadirkan ketenangan alami nan menakjubkan.</p>
              <a href="#" class="read-btn">Baca Selengkapnya</a>
            </div>
          </article>

          <!-- Item 4 -->
          <article class="blog-card">
            <img src="https://static.tripzilla.id/media/12389/conversions/Preview-Makanan-Khas-Riau-w1024.webp" alt="Kuliner Riau" />
            <div class="text">
              <h3>5 Kuliner Riau yang Wajib Dicoba</h3>
              <p>Dari mie sagu hingga gulai belacan, cita rasa khas Riau siap memanjakan lidah.</p>
              <a href="#" class="read-btn">Baca Selengkapnya</a>
            </div>
          </article>
        </div>
      </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer">
      <p>Go-Explore — Platform Wisata</p>
    </footer>
  </body>
</html>
