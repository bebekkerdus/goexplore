<?php
require_once '../../fungsi/koneksi.php';
require_once '../../fungsi/auth.php';
requireAdmin();

$user = query("SELECT * FROM user WHERE user_id = " . intval($_SESSION['user_id']))[0];

// Handle add / role update
if (isset($_POST['submit'])){
        if (RegisUser($_POST) > 0){
                echo "<script>
                                alert('User berhasil ditambahkan!');
                                document.location.href = 'users.php';
                            </script>";
        } else {
                echo "<script>
                                alert('Gagal menambahkan user!');
                                document.location.href = 'users.php';
                            </script>";
        }
}

if (isset($_POST['update'])){
        if (updateUserRole($_POST) > 0){
                echo "<script>
                                alert('Role user berhasil diupdate!');
                                document.location.href = 'users.php';
                            </script>";
        } else {
                echo "<script>
                                alert('Role user gagal diupdate!');
                                document.location.href = 'users.php';
                            </script>";
        }
}

$data = getUsers();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Users - E-Tourism Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../../css/admin.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <?php require_once '../../fungsi/auth.php'; $active = 'users'; include 'navbar.php'; ?>
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Users</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <div>
                                    <i class="fas fa-table me-1"></i>
                                    User List
                                </div>
                                <div>
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addUserModal">
                                        <i class="fas fa-plus"></i>
                                        Tambah User
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <?php if (empty($data)): ?>
                                    <p class="text-muted">No users found.</p>
                                <?php else: ?>
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>no</th>
                                            <th>Nama User</th>
                                            <th>Email</th>
                                            <th>Foto</th>
                                            <th>No Telpon</th>
                                            <th>Role</th>
                                            <th>edit/del</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>no</th>
                                            <th>Nama User</th>
                                            <th>Email</th>
                                            <th>Foto</th>
                                            <th>No Telpon</th>
                                            <th>Role</th>
                                            <th>edit/del</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($data as $row): ?>
                                        <tr id="row-<?php echo $row['user_id']; ?>">
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo htmlspecialchars($row['username'] ?? '-'); ?></td>
                                            <td><?php echo htmlspecialchars($row['email'] ?? '-'); ?></td>
                                            <td>
                                                <?php if (!empty($row['profile_picture'])): ?>
                                                    <img src="<?php echo '../../foto_user/' . htmlspecialchars($row['profile_picture']); ?>" style="max-width:100px; height:auto;" />
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo htmlspecialchars($row['phone_number'] ?? '-'); ?></td>
                                            <td><?php echo htmlspecialchars($row['role'] ?? '-'); ?></td>
                                            <td>
                                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editUserModal" data-user-id="<?php echo htmlspecialchars($row['user_id']); ?>" data-user-role="<?php echo htmlspecialchars($row['role']); ?>">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger ms-2" onclick="deleteUser(<?= $row['user_id'] ?>)">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </main>
                <!-- Add User Modal -->
                <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <form method="post" action="" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addUserModalLabel">Tambah User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row g-3">
                                        <div class="col-12 col-md-6">
                                            <label class="form-label">Username</label>
                                            <input name="username" type="text" class="form-control" required>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="form-label">Email</label>
                                            <input name="email" type="email" class="form-control" required>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="form-label">Password</label>
                                            <input name="password" type="password" class="form-control" required>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="form-label">No. Telepon</label>
                                            <input name="phone_number" type="text" class="form-control">
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="form-label">Role</label>
                                            <select name="role" class="form-select">
                                                <option value="user">User</option>
                                                <option value="admin">Admin</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="form-label">Foto Profil</label>
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

                <!-- Edit User Role Modal -->
                <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-centered">
                        <div class="modal-content">
                            <form method="post" action="">
                                <input type="hidden" name="user_id" id="editUserId">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editUserModalLabel">Edit Role User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Role</label>
                                        <select name="role" id="editUserRole" class="form-select">
                                            <option value="user">User</option>
                                            <option value="admin">Admin</option>
                                        </select>
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
            document.addEventListener('DOMContentLoaded', function() {
                const editModal = document.getElementById('editUserModal');
                if (editModal) {
                    editModal.addEventListener('show.bs.modal', function(event) {
                        const button = event.relatedTarget;
                        const userId = button.getAttribute('data-user-id');
                        const role = button.getAttribute('data-user-role');

                        document.getElementById('editUserId').value = userId;
                        document.getElementById('editUserRole').value = role;
                    });
                }
            });

            function deleteUser(id) {
                if (!confirm("Yakin ingin menghapus user ini?")) return;

                fetch("../../fungsi/delete.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: "id_user=" + encodeURIComponent(id)
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
