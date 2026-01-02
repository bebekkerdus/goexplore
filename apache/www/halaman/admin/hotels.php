<?php
require_once '../../fungsi/koneksi.php';
require_once '../../fungsi/auth.php';
requireAdmin();

$user = query("SELECT * FROM user WHERE user_id = " . intval($_SESSION['user_id']))[0];

$data = getHotels();

if (isset($_POST['submit'])){
    if (insertHotel($_POST) > 0){
        echo "<script>
                alert('Data hotel berhasil ditambahkan!');
                document.location.href = 'hotels.php';
              </script>";
    } else {
        echo "<script>
                alert('Data hotel gagal ditambahkan!');
                document.location.href = 'hotels.php';
              </script>";
    }
}

if (isset($_POST['update'])){
    if (updateHotel($_POST) > 0){
        echo "<script>
                alert('Data hotel berhasil diupdate!');
                document.location.href = 'hotels.php';
              </script>";
    } else {
        echo "<script>
                alert('Data hotel gagal diupdate!');
                document.location.href = 'hotels.php';
              </script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Hotels - E-Tourism Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../../css/admin.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <?php require_once '../../fungsi/auth.php'; $active = 'hotels'; include 'navbar.php'; ?>
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Hotels</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Hotels</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <div>
                                    <i class="fas fa-table me-1"></i>
                                    Hotel List
                                </div>
                                <div>
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addHotelModal">
                                        <i class="fas fa-plus"></i>
                                        Tambah Hotel
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <?php if (empty($data)): ?>
                                    <p class="text-muted">No hotels found.</p>
                                <?php else: ?>
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>no</th>
                                            <th>Nama Hotel</th>
                                            <th>Lokasi</th>
                                            <th>Deskripsi</th>
                                            <th>Foto</th>
                                            <th>URL Hotel</th>
                                            <th>edit/del</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>no</th>
                                            <th>Nama Hotel</th>
                                            <th>Lokasi</th>
                                            <th>Deskripsi</th>
                                            <th>Foto</th>
                                            <th>URL Hotel</th>
                                            <th>edit/del</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $no = 1 ?>
                                        <?php foreach ($data as $row): ?>
                                        <tr id="row-<?php echo $row['hotel_id']; ?>">
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo htmlspecialchars($row['nama_hotel'] ?? '-'); ?></td>
                                            <td><?php echo htmlspecialchars($row['lokasi'] ?? '-'); ?></td>
                                            <td><?php echo htmlspecialchars($row['deskripsi'] ?? '-'); ?></td>
                                            <td>
                                                <?php if (!empty($row['foto'])): ?>
                                                    <img src="<?php echo '../../foto_hotel/' . htmlspecialchars($row['foto']); ?>" style="max-width:100px; height:auto;" />
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo !empty($row['url_hotel']) ? '<a href="' . htmlspecialchars($row['url_hotel']) . '" target="_blank">' . htmlspecialchars($row['url_hotel']) . '</a>' : '-'; ?></td>
                                            <td>
                                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editHotelModal" data-hotel-id="<?php echo htmlspecialchars($row['hotel_id']); ?>" data-hotel-nama="<?php echo htmlspecialchars($row['nama_hotel']); ?>" data-hotel-lokasi="<?php echo htmlspecialchars($row['lokasi']); ?>" data-hotel-deskripsi="<?php echo htmlspecialchars($row['deskripsi']); ?>" data-hotel-url="<?php echo htmlspecialchars($row['url_hotel']); ?>">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger ms-2" onclick="deleteHotel(<?= $row['hotel_id'] ?>)">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <?php endif; ?>

                                <!-- Add Hotel Modal -->
                                <div class="modal fade" id="addHotelModal" tabindex="-1" aria-labelledby="addHotelModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <form method="post" action="" enctype="multipart/form-data">
                                                <input type="hidden" name="type" value="hotel">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="addHotelModalLabel">Tambah Hotel</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row g-3">
                                                        <div class="col-12 col-md-6">
                                                            <label class="form-label">Nama Hotel</label>
                                                            <input name="nama_hotel" type="text" class="form-control" required>
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
                                                            <label class="form-label">Foto (upload)</label>
                                                            <input name="foto" type="file" class="form-control" accept="image/*">
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label">URL Hotel</label>
                                                            <input name="url_hotel" type="url" class="form-control" placeholder="https://...">
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
                            </div>
                        </div>
                    </div>
                </main>

                <!-- Edit Hotel Modal -->
                <div class="modal fade" id="editHotelModal" tabindex="-1" aria-labelledby="editHotelModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <form method="post" action="" enctype="multipart/form-data">
                                <input type="hidden" name="type" value="hotel">
                                <input type="hidden" name="hotel_id" id="editHotelId">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editHotelModalLabel">Edit Hotel</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row g-3">
                                        <div class="col-12 col-md-6">
                                            <label class="form-label">Nama Hotel</label>
                                            <input name="nama_hotel" type="text" class="form-control" id="editNamaHotel" required>
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
                                            <label class="form-label">Foto (upload)</label>
                                            <input name="foto" type="file" class="form-control" accept="image/*">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">URL Hotel</label>
                                            <input name="url_hotel" type="url" class="form-control" id="editUrlHotel" placeholder="https://...">
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
            // Handle Edit Modal
            document.addEventListener('DOMContentLoaded', function() {
                const editModal = document.getElementById('editHotelModal');
                if (editModal) {
                    editModal.addEventListener('show.bs.modal', function(event) {
                        const button = event.relatedTarget;
                        const hotelId = button.getAttribute('data-hotel-id');
                        const nama = button.getAttribute('data-hotel-nama');
                        const lokasi = button.getAttribute('data-hotel-lokasi');
                        const deskripsi = button.getAttribute('data-hotel-deskripsi');
                        const url = button.getAttribute('data-hotel-url');
                        
                        document.getElementById('editHotelId').value = hotelId;
                        document.getElementById('editNamaHotel').value = nama;
                        document.getElementById('editLokasi').value = lokasi;
                        document.getElementById('editDeskripsi').value = deskripsi;
                        document.getElementById('editUrlHotel').value = url;
                    });
                }
            });

            function deleteHotel(id) {
                if (!confirm("Yakin ingin menghapus hotel ini?")) return;

                 fetch("../../fungsi/delete.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: "id_hotel=" + encodeURIComponent(id)
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
