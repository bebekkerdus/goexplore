<?php 
session_start(); 
require '../../fungsi/koneksi.php'; 
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Beranda | Go-Explore</title>
    <link rel="stylesheet" href="../../css/style.css" />
  </head>
  <body>
    <?php include 'navbar.php'; ?>
    
    <header class="hero">
      <div class="overlay"></div>
      <div class="hero-content">
        <h1>Temukan Petualangan mu!</h1>
        <p>Destinasi wisata terbaik dan budaya yang unik</p>
        <a href="#destinasi" class="cta-btn">Mulai Eksplorasi</a>
      </div>
    </header>

    <!-- DESTINASI -->
    <section id="destinasi" class="destinasi-section">
      <h2>Destinasi Wisata Unggulan</h2>
      <p class="subtitle">Beberapa tempat menarik yang bisa ditemukan</p>

      <div class="card-container">
        <!-- CARD 1 -->
        <div class="card">
          <img src="https://www.djkn.kemenkeu.go.id/files/images/2022/03/IMG_8409.JPG" alt="Istana Siak" />
          <div class="card-body">
            <h3>Istana Siak Sri Indrapura</h3>
            <p>Bangunan bersejarah peninggalan Kesultanan Siak dengan arsitektur megah dan koleksi artefak kerajaan.</p>
          </div>
        </div>

        <!-- CARD 2 -->
        <div class="card">
          <img src="https://jadesta.kemenparekraf.go.id/imgpost/27096.jpg" alt="Danau Zamrud" />
          <div class="card-body">
            <h3>Danau Zamrud</h3>
            <p>Danau alami di tengah suaka margasatwa dengan suasana sunyi dan pemandangan hijau yang menenangkan.</p>
          </div>
        </div>

        <!-- CARD 3 -->
        <div class="card">
          <img src="https://kuansingterkini.com/application/views/web/berita/27616223087-aisr.jpg" alt="Air Terjun Guruh Gemurai" />
          <div class="card-body">
            <h3>Air Terjun Guruh Gemurai</h3>
            <p>Air terjun yang mengalir deras di tengah hutan tropis, menghasilkan suara gemuruh yang khas.</p>
          </div>
        </div>

        <!-- CARD 4 -->
        <div class="card">
          <img src="https://smarttourism.pekanbaru.go.id/storage/destinations/63422-masjid-raya-an-nur.jpg" alt="Masjid Agung An-Nur" />
          <div class="card-body">
            <h3>Masjid Agung An-Nur</h3>
            <p>Ikon kota Pekanbaru dengan arsitektur megah bergaya Melayu modern, sering disebut “Taj Mahal Riau”.</p>
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
