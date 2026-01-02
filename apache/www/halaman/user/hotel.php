<?php 
session_start(); 
require '../../fungsi/koneksi.php'; 

// Load all hotels server-side, filtering will be done client-side (like destination.php)
$hotel = query("SELECT * FROM hotel");
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hotel | Go-Explore</title>
    <link rel="stylesheet" href="../../css/style.css" />
    <link rel="stylesheet" href="../../css/hotel_style.css" />
    <style>
      .search-box {
    display: flex;
    gap: 10px;
}

.search-box input {
    width: 260px;
    padding: 10px 14px;
    border-radius: 8px;
    border: 1px solid #ccc;
    outline: none;
    font-size: 0.95rem;
    transition: 0.25s ease;
    background: #fafafa;
}

.search-box input:focus {
    border-color: #ffd369;
    background: #fff7dd;
}

.search-box button {
    padding: 10px 18px;
    background: #ffd369;
    color: #333;
    font-weight: 600;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.25s ease;
}

.search-box button:hover {
    background: #ffcf5d;
}

/* Specific styling for hotel search (bigger, centered) */
.hotel-search {
    justify-content: center;
    margin: 18px 0 0 0;
}

.hotel-search input {
    width: 420px;
    max-width: 90%;
    padding: 12px 16px;
    font-size: 1rem;
    border-radius: 999px;
    border: 1px solid #e6d6a6;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    background: #fffdf6;
}

.hotel-search button {
    padding: 12px 20px;
    border-radius: 999px;
    background: #ffb84d;
    color: #fff;
    font-weight: 700;
    border: none;
}
    </style>
  </head>
  <body>
    <?php include 'navbar.php'; ?>

    

    <!-- HERO SECTION -->
    <header class="hero hotel-hero" style="background-image: url('../../image/hotelbg.png')">
      <div class="overlay"></div>
      <div class="hero-content">
        <h1>Temukan Penginapan yang Nyaman</h1>
        <p>Pilihan hotel terbaik untuk menemani liburanmu di Riau</p>
        <a href="#list-hotel" class="cta-btn">Lihat Hotel</a>
      </div>
    </header>

     <!-- FILTER SECTION -->
    <section class="filter-box">
      <div class="container filter-container">
        <!-- SEARCH -->
        <div class="search-box hotel-search">
          <input id="searchHotel" type="text" placeholder="Cari hotel atau deskripsi..." />
          <button id="searchHotelBtn" type="button">Cari</button>
        </div>

    </section>

    <!-- HOTEL LIST -->
    <section id="list-hotel" class="destinasi-section">
      <h2>Daftar Hotel Rekomendasi</h2>
      <p class="subtitle">Tempat menginap terbaik dengan kenyamanan maksimal</p>

      <div class="hotel-grid">
         <?php foreach ($hotel as $h): ?>
        <div class="hotel-card">
          <div class="hotel-card-body">
            <img src="../../foto_hotel/<?php echo htmlspecialchars($h['foto']); ?>" alt="<?php echo htmlspecialchars($h['nama_hotel']); ?>">
            <h3><?php echo $h['nama_hotel']; ?></h3>
            <p><?php echo $h['deskripsi']; ?></p>
            <span class="hotel-price-tag">
                <a href="<?php echo $h['url_hotel']; ?>" target="_blank">Pilih</a>
            </span>
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
      // Client-side filter for hotel cards (same behavior as destination.php)
      (function(){
        var input = document.getElementById('searchHotel');
        var btn = document.getElementById('searchHotelBtn');

        function filterHotel(){
          var q = (input.value || '').toLowerCase().trim();
          var cards = document.querySelectorAll('.hotel-grid .hotel-card');
          cards.forEach(function(card){
            var titleEl = card.querySelector('.hotel-card-body h3');
            var descEl = card.querySelector('.hotel-card-body p');
            var title = titleEl ? titleEl.textContent.toLowerCase() : '';
            var desc = descEl ? descEl.textContent.toLowerCase() : '';
            if (q === '' || title.indexOf(q) !== -1 || desc.indexOf(q) !== -1) {
              card.style.display = '';
            } else {
              card.style.display = 'none';
            }
          });
        }

        btn.addEventListener('click', filterHotel);
        input.addEventListener('input', filterHotel);
      })();
    </script>
  </body>
</html>
