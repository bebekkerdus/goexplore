<?php
session_start();
require '../../fungsi/koneksi.php';

// Cek Login
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

// Ambil data user
$user_id = $_SESSION["user_id"];
$result = mysqli_query($conn, "SELECT * FROM user WHERE user_id = $user_id");
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya | Go-Explore</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/profile_style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
    /* Simple modal styles for Riwayat Pembelian */
    .modal-overlay{position:fixed;inset:0;background:rgba(0,0,0,0.6);display:none;align-items:center;justify-content:center;z-index:9999}
    .modal-box{background:#fff;padding:20px;border-radius:8px;max-width:900px;width:95%;max-height:80vh;overflow:auto}
    .modal-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:12px}
    .btn-close{background:#eee;border:0;padding:6px 10px;border-radius:6px;cursor:pointer}
    .history-table{width:100%;border-collapse:collapse}
    .history-table th,.history-table td{padding:8px;border:1px solid #ddd;text-align:left}
    .hidden-row{display:none}
    /* Buttons inside history modal */
    .btn-continue, .btn-cancel {
        display:inline-block;
        padding:6px 10px;
        border-radius:6px;
        font-size:14px;
        text-decoration:none;
        cursor:pointer;
        border:1px solid transparent;
        margin:0 4px;
    }
    .btn-continue{
        background:linear-gradient(180deg,#2b8cff,#0370e6);
        color:#fff;
        box-shadow:0 2px 6px rgba(3,112,230,0.2);
        border-color:rgba(0,0,0,0.04);
    }
    .btn-continue:hover{transform:translateY(-1px)}
    .btn-cancel{
        background:#fff;color:#c0392b;border:1px solid #e6a9a1;
    }
    .btn-cancel:hover{background:#fceaea}
    .pager{display:flex;gap:6px;flex-wrap:wrap;margin-top:12px}
    .pager button{background:#f1f1f1;border:1px solid #ddd;padding:6px 10px;border-radius:4px;cursor:pointer}
    .pager button.active{background:#007bff;color:#fff;border-color:#007bff}
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <section class="profile-section">
        <div class="profile-card">
            <img src="../../foto_user/<?= htmlspecialchars($user['profile_picture']); ?>" alt="Profile" class="profile-img-big">
            
            <h2><?= htmlspecialchars($user['username']); ?></h2>
            <span class="membership">Pelancong Riau</span>

            <div class="profile-info">
                <div class="info-group">
                    <label>Username</label>
                    <p><?= htmlspecialchars($user['username']); ?></p>
                </div>
                <div class="info-group">
                    <label>Email Terdaftar</label>
                    <p><?= htmlspecialchars($user['email']); ?></p>
                </div>
                <div class="info-group">
                    <label>Nomor Telepon</label>
                    <p><?= htmlspecialchars($user['phone_number']); ?></p>
                </div>
            </div>

            <div class="profile-actions">
                <?php if ($user['role'] === 'admin'): ?>
                <a href="../admin/index.php" class="btn-profile btn-edit">
                    Admin
                </a>
                <?php endif; ?>
                <a href="edit_profile.php" class="btn-profile btn-edit">
                    <i class="bi bi-pencil-square"></i> Edit Profil
                </a>
                <a href="ganti_password.php" class="btn-profile btn-password">
                    <i class="bi bi-shield-lock"></i> Ganti Password
                </a>
                <button id="btn-history" class="btn-profile btn-history">
                    <i class="bi bi-clock-history"></i> Riwayat Pembelian
                </button>
                
            </div>
        </div>
    </section>

    <!-- Modal Riwayat Pembelian -->
    <?php
    $history = getPembayaranByUser($user_id);
    ?>
    <div id="modal-history" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-header">
                <h3>Riwayat Pembelian</h3>
                <button id="close-history" class="btn-close">Tutup</button>
            </div>
            <?php if (empty($history)): ?>
                <p>Belum ada riwayat pembelian.</p>
            <?php else: ?>
                <table class="history-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal Pesan</th>
                            <th>Tanggal Bayar</th>
                            <th>Transportasi</th>
                            <th>Jumlah Orang</th>
                            <th>Jumlah Bayar</th>
                            <th>Metode</th>
                            <th>Status</th>
                            <th>edit/del</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                    <?php foreach ($history as $row): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['tanggal_kunjung'] ?? $row['tanggal_bayar'] ?? '') ?></td>
                            <td><?= htmlspecialchars($row['tanggal_bayar'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($row['transportasi'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($row['jumlah_orang'] ?? '-') ?></td>
                            <td>Rp <?= number_format((float)($row['jumlah_bayar'] ?? 0),0,',','.') ?></td>
                            <td><?= htmlspecialchars($row['metode_pembayaran'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($row['status'] ?? $row['status_pembayaran'] ?? '-') ?></td>
                            <td>
                                <?php $statusVal = $row['status'] ?? $row['status_pembayaran'] ?? ''; ?>
                                <?php if (strtolower($statusVal) === 'pending'): ?>
                                    <a class="btn-continue" href="../../destinasi/pembayaran.php?pembayaran_id=<?= $row['pembayaran_id'] ?>">Lanjut</a>
                                    &nbsp;|&nbsp;
                                    <button class="btn-cancel" data-id="<?= $row['pembayaran_id'] ?>">Batal</button>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>

    <script>
    document.getElementById('btn-history').addEventListener('click', function(){
        document.getElementById('modal-history').style.display = 'flex';
    });
    document.getElementById('close-history').addEventListener('click', function(){
        document.getElementById('modal-history').style.display = 'none';
    });
    // close when clicking outside box
    document.getElementById('modal-history').addEventListener('click', function(e){
        if (e.target === this) this.style.display = 'none';
    });

    // handle cancel buttons
    document.querySelectorAll('.btn-cancel').forEach(function(btn){
        btn.addEventListener('click', function(){
            if (!confirm('Batalkan pesanan ini?')) return;
            var id = this.dataset.id;
            this.disabled = true;
            fetch('pembayaran_action.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'action=cancel&pembayaran_id=' + encodeURIComponent(id)
            }).then(r => r.json()).then(data => {
                if (data.success) {
                    alert('Pesanan dibatalkan');
                    location.reload();
                } else {
                    alert('Gagal: ' + (data.message || ''));
                    btn.disabled = false;
                }
            }).catch(err => { alert('Terjadi error'); btn.disabled = false; });
        });
    });

    // Client-side pagination: show N rows per page and render pager buttons
    function setupPagination(pageSize = 5) {
        var rows = Array.from(document.querySelectorAll('#modal-history .history-table tbody tr'));
        var total = rows.length;
        var totalPages = Math.max(1, Math.ceil(total / pageSize));

        function showPage(page) {
            var start = (page - 1) * pageSize;
            var end = start + pageSize;
            rows.forEach(function(r, i){
                r.style.display = (i >= start && i < end) ? '' : 'none';
            });
            // update pager active
            var buttons = document.querySelectorAll('#history-pager button[data-page]');
            buttons.forEach(function(b){ b.classList.toggle('active', Number(b.dataset.page) === page); });
        }

        // build pager
        var pager = document.getElementById('history-pager');
        if (!pager) {
            pager = document.createElement('div');
            pager.id = 'history-pager';
            pager.className = 'pager';
            document.querySelector('#modal-history .modal-box').appendChild(pager);
        }
        pager.innerHTML = '';

        var prev = document.createElement('button'); prev.textContent = 'Prev';
        prev.addEventListener('click', function(){
            var cur = Number(pager.querySelector('button.active')?.dataset.page || 1);
            if (cur > 1) showPage(cur - 1);
        });
        pager.appendChild(prev);

        for (var p = 1; p <= totalPages; p++) {
            (function(page){
                var btn = document.createElement('button');
                btn.textContent = page;
                btn.dataset.page = page;
                btn.addEventListener('click', function(){ showPage(page); });
                pager.appendChild(btn);
            })(p);
        }

        var next = document.createElement('button'); next.textContent = 'Next';
        next.addEventListener('click', function(){
            var cur = Number(pager.querySelector('button.active')?.dataset.page || 1);
            if (cur < totalPages) showPage(cur + 1);
        });
        pager.appendChild(next);

        // show first page
        showPage(1);
    }

    document.getElementById('btn-history').addEventListener('click', function(){
        document.getElementById('modal-history').style.display = 'flex';
        setTimeout(function(){ setupPagination(5); }, 50);
    });
    </script>

    <footer>
        <p>Go-Explore — Platform Wisata</p>
    </footer>
</body>
</html>