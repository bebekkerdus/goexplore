<?php 
session_start(); 
require '../../fungsi/koneksi.php';

$destinations = query("SELECT * FROM destinasi_wisata");
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Destinasi | Go-Explore</title>
    <link rel="stylesheet" href="../../css/destination_style.css" />
    <link rel="stylesheet" href="../../css/style.css" />
  </head>
  <body>
    <?php include 'navbar.php'; ?>

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
          <input id="searchDest" type="text" placeholder="Cari destinasi..." />
          <button id="searchBtn" type="button">Cari</button>
        </div>
    </section>

    <!-- DESTINASI LIST -->
    <section id="list-destinasi" class="destinasi-section">
      <h2>Daftar Destinasi Wisata</h2>
      <p class="subtitle">Nikmati pengalaman wisata yang mengesankan di Riau</p>

      <div class="card-container">
        <?php foreach ($destinations as $dest): ?>
        <div class="card" id="low">
          <img src="../../foto_wisata/<?php echo htmlspecialchars($dest['foto']); ?>" alt="<?php echo htmlspecialchars($dest['nama_destinasi']); ?>">
          <div class="card-body">
            <h3><?php echo $dest['nama_destinasi']; ?></h3>
            <p><?php echo $dest['deskripsi']; ?></p>
            <a class="card-btn" href="../../destinasi/info_destinasi.php?destinasi_id=<?php echo (int)$dest['destinasi_id']; ?>">
               <button>Pilih</button>
            </a>

          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- FOOTER -->
    <footer>
      <p>Go-Explore — Platform Wisata</p>
    </footer>
    <script>
      // Client-side filter for static destination cards
      (function(){
        var input = document.getElementById('searchDest');
        var btn = document.getElementById('searchBtn');

        function filterDest(){
          var q = (input.value || '').toLowerCase().trim();
          var cards = document.querySelectorAll('.card-container .card');
          cards.forEach(function(card){
            var titleEl = card.querySelector('.card-body h3');
            var descEl = card.querySelector('.card-body p');
            var title = titleEl ? titleEl.textContent.toLowerCase() : '';
            var desc = descEl ? descEl.textContent.toLowerCase() : '';
            if (q === '' || title.indexOf(q) !== -1 || desc.indexOf(q) !== -1) {
              card.style.display = '';
            } else {
              card.style.display = 'none';
            }
          });
        }

        btn.addEventListener('click', filterDest);
        input.addEventListener('input', filterDest);
      })();
    </script>
  </body>
</html>
