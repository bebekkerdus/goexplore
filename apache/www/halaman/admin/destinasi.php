<?php
require_once '../../fungsi/koneksi.php';
require_once '../../fungsi/auth.php';
requireAdmin();

$user = query("SELECT * FROM user WHERE user_id = " . intval($_SESSION['user_id']))[0];

// Handle form submissions (insert / update)
if (isset($_POST['submit'])){
        if (insertDestinasi($_POST) > 0){
                echo "<script>
                                alert('Data destinasi berhasil ditambahkan!');
                                document.location.href = 'destinasi.php';
                            </script>";
        } else {
                echo "<script>
                                alert('Data destinasi gagal ditambahkan!');
                                document.location.href = 'destinasi.php';
                            </script>";
        }
}

if (isset($_POST['update'])){
        if (updateDestinasi($_POST) > 0){
                echo "<script>
                                alert('Data destinasi berhasil diupdate!');
                                document.location.href = 'destinasi.php';
                            </script>";
        } else {
                echo "<script>
                                alert('Data destinasi gagal diupdate!');
                                document.location.href = 'destinasi.php';
                            </script>";
        }

        
}

$data = getDestinasi();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Destinasi - E-Tourism Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../../css/admin.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <?php require_once '../../fungsi/auth.php'; $active = 'destinasi'; include 'navbar.php'; ?>
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Destinasi</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Destinasi</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <div>
                                    <i class="fas fa-table me-1"></i>
                                    Destinasi List
                                </div>
                                <div>
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addDestinasiModal">
                                        <i class="fas fa-plus"></i>
                                        Tambah Destinasi
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <?php if (empty($data)): ?>
                                    <p class="text-muted">No destinasi found.</p>
                                <?php else: ?>
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Wisata</th>
                                            <th>Deskripsi</th>
                                            <th>Foto</th>
                                            <th>Kategori</th>
                                            <th>Lokasi</th>
                                            <th>edit/del</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Wisata</th>
                                            <th>Deskripsi</th>
                                            <th>Foto</th>
                                            <th>Kategori</th>
                                            <th>Lokasi</th>
                                            <th>edit/del</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($data as $row): ?>
                                        <tr id="row-<?php echo $row['destinasi_id']; ?>">
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo htmlspecialchars($row['nama_destinasi'] ?? '-'); ?></td>
                                            <td><?php echo htmlspecialchars($row['deskripsi'] ?? '-'); ?></td>
                                            <td>
                                                <?php if (!empty($row['foto'])): ?>
                                                    <img src="<?php echo '../../foto_wisata/' . htmlspecialchars($row['foto']); ?>" style="max-width:100px; height:auto;" />
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo htmlspecialchars($row['kategori'] ?? '-');?></td>
                                            <td><?php echo htmlspecialchars($row['lokasi'] ?? '-'); ?></td>
                                            <td>
                                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editDestinasiModal" data-destinasi-id="<?php echo htmlspecialchars($row['destinasi_id']); ?>" data-destinasi-nama="<?php echo htmlspecialchars($row['nama_destinasi']); ?>" data-destinasi-lokasi="<?php echo htmlspecialchars($row['lokasi']); ?>" data-destinasi-deskripsi="<?php echo htmlspecialchars($row['deskripsi']); ?>" data-destinasi-kategori="<?php echo htmlspecialchars($row['kategori']); ?>">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger ms-2" onclick="deleteDestinasi(<?= $row['destinasi_id'] ?>)">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <?php endif; ?>

                                <!-- Add Destinasi Modal -->
                                <div class="modal fade" id="addDestinasiModal" tabindex="-1" aria-labelledby="addDestinasiModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <form method="post" action="" enctype="multipart/form-data">
                                                <input type="hidden" name="type" value="destinasi">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="addDestinasiModalLabel">Tambah Destinasi</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row g-3">
                                                        <div class="col-12 col-md-6">
                                                            <label class="form-label">Nama Wisata</label>
                                                            <input name="nama_destinasi" type="text" class="form-control" required>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label class="form-label">Lokasi</label>
                                                            <input name="lokasi" type="text" class="form-control" required>
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label">Deskripsi</label>
                                                            <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label class="form-label">Kategori</label>
                                                            <select name="kategori" class="form-select">
                                                                <option value="">-- Pilih Kategori --</option>
                                                                <option value="Alam">Alam</option>
                                                                <option value="Budaya">Budaya</option>
                                                                <option value="Sejarah">Sejarah</option>
                                                                <option value="Kuliner">Kuliner</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label class="form-label">Foto (upload)</label>
                                                            <input name="foto" type="file" class="form-control" accept="image/*">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Edit Destinasi Modal -->
                                <div class="modal fade" id="editDestinasiModal" tabindex="-1" aria-labelledby="editDestinasiModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <form method="post" action="" enctype="multipart/form-data">
                                                <input type="hidden" name="type" value="destinasi">
                                                <input type="hidden" name="destinasi_id" id="editDestinasiId">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editDestinasiModalLabel">Edit Destinasi</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row g-3">
                                                        <div class="col-12 col-md-6">
                                                            <label class="form-label">Nama Wisata</label>
                                                            <input name="nama_destinasi" type="text" class="form-control" id="editNamaDestinasi" required>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label class="form-label">Lokasi</label>
                                                            <input name="lokasi" type="text" class="form-control" id="editLokasi" required>
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label">Deskripsi</label>
                                                            <textarea name="deskripsi" class="form-control" rows="3" id="editDeskripsi"></textarea>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label class="form-label">Kategori</label>
                                                            <select name="kategori" class="form-select" id="editKategori">
                                                                <option value="">-- Pilih Kategori --</option>
                                                                <option value="Alam">Alam</option>
                                                                <option value="Budaya">Budaya</option>
                                                                <option value="Sejarah">Sejarah</option>
                                                                <option value="Kuliner">Kuliner</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label class="form-label">Foto (upload)</label>
                                                            <input name="foto" type="file" class="form-control" accept="image/*">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; E-Tourism Admin 2024</div>
                            <div>
                                <a href="#!">Privacy Policy</a>
                                &middot;
                                <a href="#!">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables.js"></script>
        <script>
            // Handle Edit Destinasi Modal
            document.addEventListener('DOMContentLoaded', function() {
                const editModal = document.getElementById('editDestinasiModal');
                if (editModal) {
                    editModal.addEventListener('show.bs.modal', function(event) {
                        const button = event.relatedTarget;
                        const id = button.getAttribute('data-destinasi-id');
                        const nama = button.getAttribute('data-destinasi-nama');
                        const lokasi = button.getAttribute('data-destinasi-lokasi');
                        const deskripsi = button.getAttribute('data-destinasi-deskripsi');
                        const kategori = button.getAttribute('data-destinasi-kategori');

                        document.getElementById('editDestinasiId').value = id;
                        document.getElementById('editNamaDestinasi').value = nama;
                        document.getElementById('editLokasi').value = lokasi;
                        document.getElementById('editDeskripsi').value = deskripsi;
                        document.getElementById('editKategori').value = kategori;
                        const fotoUrlEl = document.getElementById('editFotoUrl');
                        if (fotoUrlEl) fotoUrlEl.value = '';
                    });
                }
            });

            function deleteDestinasi(id) {
                if (!confirm("Yakin ingin menghapus destinasi ini?")) return;

                fetch("../../fungsi/delete.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: "id_destinasi=" + id
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        alert("Berhasil dihapus!");
                        location.reload();
                    } else {
                        alert("Gagal menghapus: " + (data.message || 'unknown error'));
                    }
                })
                .catch(err => alert("ERROR: " + err));
            }

        </script>
    </body>
</html>
