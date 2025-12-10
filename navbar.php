<?php
if (session_status() === PHP_SESSION_NONE) {
  @session_start();
}
// Ensure DB connection is available
if (!isset($conn)) {
  @include __DIR__ . '/fungsi/koneksi.php';
}

$logged = false;
$profile = null;
if (!empty($_SESSION['login'])) {
  $logged = true;
  $user_id = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : null;
  if ($user_id && isset($conn)) {
    $res = mysqli_query($conn, "SELECT profile_picture FROM user WHERE user_id = " . $user_id);
    if ($res && mysqli_num_rows($res) > 0) {
      $row = mysqli_fetch_assoc($res);
      $profile = $row['profile_picture'];
    }
  }
}
?>
<!-- Include navbar stylesheet -->
<link rel="stylesheet" href="css/style.css?v=2">
<!-- NAVBAR -->
<nav class="navbar">
  <div class="container">
    <a class="navbar-brand" href="beranda.php"> Go-Explore<span>Tour & Travel Agency</span> </a>
    
    <div class="collapse navbar-collapse" id="ftco-nav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a href="beranda.php" class="nav-link">Beranda</a></li>
        <li class="nav-item"><a href="about.php" class="nav-link">Tentang</a></li>
        <li class="nav-item"><a href="destination.php" class="nav-link">Destinasi</a></li>
        <li class="nav-item"><a href="hotel.php" class="nav-link">Hotel</a></li>
        <li class="nav-item"><a href="blog.php" class="nav-link">Blog</a></li>
        <li class="nav-item"><a href="contact.php" class="nav-link">Kontak</a></li>
        <?php if ($logged && $profile): ?>
          <li class="nav-item profile-item" id="profileItem">
            <a href="#" class="nav-link profile-toggle" title="Lihat Profil" aria-haspopup="true" aria-expanded="false">
              <img src="<?php echo 'foto_user/' . htmlspecialchars($profile); ?>" alt="Profile" class="nav-avatar" style="width:42px;height:42px;object-fit:cover;">
            </a>
            <div class="profile-dropdown" id="profileDropdown" role="menu" aria-label="Profile menu">
              <a href="profile.php" class="dropdown-item" role="menuitem">Profil</a>
              <a href="fungsi/logout.php" class="dropdown-item logout-link" role="menuitem">Logout</a>
            </div>
          </li>
        <?php else: ?>
          <li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<script>

document.addEventListener('DOMContentLoaded', function() {
  
  const currentPage = (window.location.pathname.split('/').pop() || 'beranda.php').split('?')[0].split('#')[0];
  const navItems = document.querySelectorAll('.navbar-nav .nav-item');

  navItems.forEach(item => {
    const link = item.querySelector('.nav-link');
    if (!link) return;


    let href = link.getAttribute('href') || '';
    try {
      
      const resolved = new URL(href, window.location.origin);
      href = resolved.pathname.split('/').pop();
    } catch (e) {
      
      href = href.split('?')[0].split('#')[0];
    }

   
    const normalizedCurrent = (currentPage === '' || currentPage === 'index.php') ? 'beranda.php' : currentPage;
    const normalizedHref = (href === '' || href === 'index.php') ? 'beranda.php' : href;

    if (normalizedHref === normalizedCurrent) {
      item.classList.add('active');
    } else {
      item.classList.remove('active');
    }
  });
});

document.addEventListener('DOMContentLoaded', function() {
  const profileToggle = document.querySelector('.profile-toggle');
  const dropdown = document.getElementById('profileDropdown');
  const profileItem = document.getElementById('profileItem');

  if (profileToggle && dropdown && profileItem) {
    profileToggle.addEventListener('click', function(e) {
      e.preventDefault();
      const isShown = dropdown.classList.toggle('show');
      profileToggle.setAttribute('aria-expanded', isShown ? 'true' : 'false');
      e.stopPropagation();
    });

    document.addEventListener('click', function(ev) {
      if (!profileItem.contains(ev.target)) {
        if (dropdown.classList.contains('show')) {
          dropdown.classList.remove('show');
          profileToggle.setAttribute('aria-expanded', 'false');
        }
      }
    });

    document.addEventListener('keydown', function(ev) {
      if (ev.key === 'Escape' && dropdown.classList.contains('show')) {
        dropdown.classList.remove('show');
        profileToggle.setAttribute('aria-expanded', 'false');
      }
    });
  }

  // Logout 
  const logoutLinks = document.querySelectorAll('.logout-link');
  if (logoutLinks.length) {
    logoutLinks.forEach(link => {
      link.addEventListener('click', function(e) {
        const ok = confirm('Apakah Anda yakin ingin keluar?');
        if (!ok) e.preventDefault();
      });
    });
  }
});

</script>
