<?php
if (session_status() === PHP_SESSION_NONE) {
  @session_start();
}
// Ensure DB connection is available
if (!isset($conn)) {
  @include __DIR__ . '../../fungsi/koneksi.php';
}

$logged = false;
$profile = null;
if (!empty($_SESSION['login'])) {
  $logged = true;
  $user_id = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : null;
  if ($user_id && isset($conn)) {
    $res = mysqli_query(
      $conn,
      "SELECT username, profile_picture FROM user WHERE user_id = " . $user_id
    );

    if ($res && mysqli_num_rows($res) > 0) {
      $row = mysqli_fetch_assoc($res);
      $profile = $row['profile_picture'];
      $_SESSION['username'] = $row['username']; // ✅ SIMPAN KE SESSION
    }
  }
}
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Go Explore</title>
  <link rel="stylesheet" href="../../css/style.css?v=2">
</head>

<nav class="navbar">
  <div class="container">
    <a class="navbar-brand" href="beranda.php">
      Go-Explore<span>Tour & Travel Agency</span>
    </a>

    <!-- DESKTOP MENU -->
    <ul class="navbar-nav desktop-menu">
      <li class="nav-item"><a href="beranda.php" class="nav-link">Beranda</a></li>
      <li class="nav-item"><a href="about.php" class="nav-link">Tentang</a></li>
      <li class="nav-item"><a href="destination.php" class="nav-link">Destinasi</a></li>
      <li class="nav-item"><a href="hotel.php" class="nav-link">Hotel</a></li>
      <li class="nav-item"><a href="contact.php" class="nav-link">Kontak</a></li>

      <?php if ($logged && $profile): ?>
        <li class="nav-item profile-item">
          <a href="#" class="nav-link profile-toggle">
            <img src="<?= '../../foto_user/' . htmlspecialchars($profile) ?>" class="nav-avatar">
          </a>
          <div class="profile-dropdown">
            <a href="profile.php" class="dropdown-item">Profil</a>
            <a href="../../fungsi/logout.php" class="dropdown-item logout-link">Logout</a>
          </div>
        </li>
      <?php else: ?>
        <li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>
      <?php endif; ?>
    </ul>

    <!-- HAMBURGER -->
    <button class="navbar-toggler" id="navToggle">
      <span></span><span></span><span></span>
    </button>
  </div>
</nav>

<!-- OFFCANVAS MENU -->
<div class="mobile-menu" id="mobileMenu">
  <div class="mobile-menu-header">
    <button class="close-btn" id="closeMenu">×</button>

    <?php if ($logged && $profile): ?>
      <img src="<?= '../../foto_user/' . htmlspecialchars($profile) ?>"
        class="mobile-avatar"
        alt="Profile">
    <?php endif; ?>
  </div>



  <!-- MOBILE MENU -->
  <ul class="mobile-nav">
    <li><a href="beranda.php">Beranda</a></li>
    <li><a href="about.php">Tentang</a></li>
    <li><a href="destination.php">Destinasi</a></li>
    <li><a href="hotel.php">Hotel</a></li>
    <li><a href="contact.php">Kontak</a></li>
    <?php if ($logged): ?>
      <li><a href="profile.php">Profil</a></li>
  </ul>
  <a href="../fungsi/logout.php" class="mobile-logout logout-link">Logout</a>
<?php else: ?>
  </ul>
  <a href="login.php" class="login-btn">Login</a>
<?php endif; ?>
</div>

<div class="menu-overlay" id="menuOverlay"></div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const profileToggles = document.querySelectorAll('.profile-toggle');

    profileToggles.forEach(toggle => {
      const dropdown = toggle.nextElementSibling; // dropdown harus tepat setelah toggle
      if (!dropdown) return;

      toggle.addEventListener('click', function(e) {
        e.preventDefault();
        const isShown = dropdown.classList.toggle('show');
        toggle.setAttribute('aria-expanded', isShown ? 'true' : 'false');
        e.stopPropagation();
      });

      // Klik di luar dropdown
      document.addEventListener('click', function(ev) {
        if (!toggle.parentElement.contains(ev.target)) {
          if (dropdown.classList.contains('show')) {
            dropdown.classList.remove('show');
            toggle.setAttribute('aria-expanded', 'false');
          }
        }
      });

      // Esc untuk menutup
      document.addEventListener('keydown', function(ev) {
        if (ev.key === 'Escape' && dropdown.classList.contains('show')) {
          dropdown.classList.remove('show');
          toggle.setAttribute('aria-expanded', 'false');
        }
      });
    });

    // Logout confirmation untuk semua link
    const logoutLinks = document.querySelectorAll('.logout-link');
    logoutLinks.forEach(link => {
      link.addEventListener('click', function(e) {
        const ok = confirm('Apakah Anda yakin ingin keluar?');
        if (!ok) e.preventDefault();
      });
    });

    // Mobile menu toggle (tetap sama)
    const toggle = document.getElementById('navToggle');
    const menu = document.getElementById('mobileMenu');
    const overlay = document.getElementById('menuOverlay');
    const closeBtn = document.getElementById('closeMenu');

    function openMenu() {
      menu.classList.add('active');
      overlay.classList.add('active');
      document.body.style.overflow = 'hidden';
    }

    function closeMenu() {
      menu.classList.remove('active');
      overlay.classList.remove('active');
      document.body.style.overflow = '';
    }

    toggle.addEventListener('click', openMenu);
    closeBtn.addEventListener('click', closeMenu);
    overlay.addEventListener('click', closeMenu);
  });


  document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.getElementById('navToggle');
    const menu = document.getElementById('mobileMenu');
    const overlay = document.getElementById('menuOverlay');
    const closeBtn = document.getElementById('closeMenu');

    function openMenu() {
      menu.classList.add('active');
      overlay.classList.add('active');
      document.body.style.overflow = 'hidden';
    }

    function closeMenu() {
      menu.classList.remove('active');
      overlay.classList.remove('active');
      document.body.style.overflow = '';
    }

    toggle.addEventListener('click', openMenu);
    closeBtn.addEventListener('click', closeMenu);
    overlay.addEventListener('click', closeMenu);
  });
</script>