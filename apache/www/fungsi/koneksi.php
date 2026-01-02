<?php
$conn = mysqli_connect("dbserver","root","rootpass123","appdb");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $rows;
}

function getUsers($limit = 100) {
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM user ORDER BY user_id DESC LIMIT $limit");
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function upload($source = 'hotel') {
    $file = $_FILES['foto'];

    if ($file['error'] === 4) return false;

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png'];

    if (!in_array($ext, $allowed)) return false;
    if ($file['size'] > 2000000) return false;

    $namaBaru = uniqid() . '.' . $ext;

    $root = dirname(__DIR__);

    // determine target directory based on source
    if ($source === 'destinasi' || $source === 'wisata') {
        $targetDir = $root . '/foto_wisata/';
    } else {
        // default -> hotels
        $targetDir = $root . '/foto_hotel/';
    }

    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $targetPath = $targetDir . $namaBaru;

    if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
        echo "GAGAL MOVE FILE";
        var_dump(error_get_last());
        exit;
    }

    return $namaBaru;
}


function uploadUSR() {
    $file = $_FILES['foto'];

    if ($file['error'] === 4) return false;

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png'];

    if (!in_array($ext, $allowed)) return false;
    if ($file['size'] > 2000000) return false;

    $namaBaru = uniqid() . '.' . $ext;

    $root = dirname(__DIR__);
    $targetDir = $root . '/foto_user/';

    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $targetPath = $targetDir . $namaBaru;

    if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
        echo "GAGAL MOVE FILE";
        var_dump(error_get_last());
        exit;
    }

    return $namaBaru;
}


function RegisUser($data){
    global $conn;

    $username = htmlspecialchars($data['username']);
    $email = htmlspecialchars($data['email']);
    $password = password_hash($data['password'], PASSWORD_DEFAULT);
    $phone = htmlspecialchars($data['phone_number']);
    $profile = uploadUSR();
    $role = htmlspecialchars($data['role'] ?? 'user');


    if ($profile === false) {
        exit;
    }
    

    $query = "INSERT INTO user(username, email, password, phone_number, profile_picture, role)
              VALUES('$username', '$email', '$password', '$phone', '$profile', '$role')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function updateUserRole($data){
    global $conn;
    $user_id = intval($data['user_id'] ?? 0);
    $role = htmlspecialchars($data['role'] ?? 'user');

    if (!$user_id) return false;

    $stmt = $conn->prepare("UPDATE user SET role = ? WHERE user_id = ?");
    $stmt->bind_param("si", $role, $user_id);
    $stmt->execute();

    return $stmt->affected_rows;
}

function delUser($user_id){
    global $conn;

    if (!$user_id || !is_numeric($user_id)) {
        return false;
    }

    $stmt = $conn->prepare("DELETE FROM user WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    return $stmt->affected_rows;
}

function getHotels($limit = 100) {
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM hotel ORDER BY hotel_id DESC LIMIT $limit");
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function insertHotel($data){
    global $conn;
    $name = htmlspecialchars($data['nama_hotel'] ?? '');
    $location = htmlspecialchars($data['lokasi'] ?? '');
    $deskripsi = htmlspecialchars($data['deskripsi'] ?? '');
    $url_hotel = htmlspecialchars($data['url_hotel'] ?? '');
    $foto_hotel = upload();

    if ($foto_hotel === false && isset($_FILES['foto'])) {
        echo "<script>alert('Upload foto gagal! Pastikan file adalah gambar dan ukurannya kurang dari 2MB.');</script>";
        return false;
    }

    $query = "INSERT INTO hotel (nama_hotel, lokasi, deskripsi, foto, url_hotel) 
               VALUES ('$name', '$location', '$deskripsi','" . ($foto_hotel === false ? "" : $foto_hotel) . "', '$url_hotel')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function updateHotel($data){
    global $conn;
    $hotel_id = intval($data['hotel_id'] ?? 0);
    $name = htmlspecialchars($data['nama_hotel'] ?? '');
    $location = htmlspecialchars($data['lokasi'] ?? '');
    $deskripsi = htmlspecialchars($data['deskripsi'] ?? '');
    $url_hotel = htmlspecialchars($data['url_hotel'] ?? '');

    $foto_hotel = upload();
    $foto_sql = $foto_hotel !== false ? ", foto='$foto_hotel'" : "";

    $query = "UPDATE hotel SET 
                nama_hotel='$name', 
                lokasi='$location', 
                deskripsi='$deskripsi', 
                url_hotel='$url_hotel' 
                $foto_sql
              WHERE hotel_id=$hotel_id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function delHotel($hotel_id){
    global $conn;

    if (!$hotel_id || !is_numeric($hotel_id)) {
        return false;
    }

    $stmt = $conn->prepare("DELETE FROM hotel WHERE hotel_id = ?");
    $stmt->bind_param("i", $hotel_id);
    $stmt->execute();

    return $stmt->affected_rows;
}


function getDestinasi($limit = 100) {
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM destinasi_wisata ORDER BY destinasi_id DESC LIMIT $limit");
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function insertDestinasi($data){
    global $conn;
    $name = htmlspecialchars($data['nama_destinasi'] ?? '');
    $location = htmlspecialchars($data['lokasi'] ?? '');
    $deskripsi = htmlspecialchars($data['deskripsi'] ?? '');
    $kategori = htmlspecialchars($data['kategori'] ?? '');
        $foto_destinasi = upload('destinasi');

    if ($foto_destinasi === false && isset($_FILES['foto'])) {
        echo "<script>alert('Upload foto gagal! Pastikan file adalah gambar dan ukurannya kurang dari 2MB.');</script>";
        return false;
    }

    $query = "INSERT INTO destinasi_wisata (nama_destinasi, lokasi, deskripsi, kategori, foto) 
               VALUES ('$name', '$location', '$deskripsi', '$kategori', '" . ($foto_destinasi === false ? "" : $foto_destinasi) . "')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function updateDestinasi($data){
    global $conn;
    $destinasi_id = intval($data['destinasi_id'] ?? 0 );
    $name = htmlspecialchars($data['nama_destinasi'] ?? '');
    $location = htmlspecialchars($data['lokasi'] ?? '');
    $deskripsi = htmlspecialchars($data['deskripsi'] ?? '');
    $kategori = htmlspecialchars($data['kategori'] ?? '');

        $foto_destinasi = upload('destinasi');
        $foto_sql = $foto_destinasi !== false ? ", foto='$foto_destinasi'" : "";

    $query = "UPDATE destinasi_wisata SET 
                nama_destinasi='$name', 
                lokasi='$location', 
                deskripsi='$deskripsi', 
                kategori='$kategori' 
                $foto_sql
              WHERE destinasi_id=$destinasi_id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function delDestinasi($destinasi_id){
    global $conn;

    if (!$destinasi_id || !is_numeric($destinasi_id)) {
        return false;
    }

    $stmt = $conn->prepare("DELETE FROM destinasi_wisata WHERE destinasi_id = ?");
    $stmt->bind_param("i", $destinasi_id);
    $stmt->execute();

    return $stmt->affected_rows;
}

function createPembayaranPending($user_id, $transportasi, $jumlah_orang, $tanggal_kunjung, $jumlah_bayar, $metode = null) {
    global $conn;

    $user_id = intval($user_id);
    $transportasi = mysqli_real_escape_string($conn, $transportasi);
    $jumlah_orang = intval($jumlah_orang);
    $tanggal_kunjung = mysqli_real_escape_string($conn, $tanggal_kunjung);
    $jumlah_bayar = floatval($jumlah_bayar);
    $status = 'Pending';

    // metode can be null initially
    if ($metode === null) {
        $metode_sql = 'NULL';
    } else {
        $metode_sql = "'" . mysqli_real_escape_string($conn, $metode) . "'";
    }

    $query = "INSERT INTO pembayaran (user_id, metode_pembayaran, transportasi, jumlah_bayar, jumlah_orang, tanggal_bayar, tanggal_kunjung, status) VALUES ($user_id, $metode_sql, '$transportasi', $jumlah_bayar, $jumlah_orang, NULL, '$tanggal_kunjung', '$status')";

    $res = mysqli_query($conn, $query);
    if (!$res) return false;

    return mysqli_insert_id($conn);
}


function updatePembayaranStatus($pembayaran_id, $status, $metode = null) {
    global $conn;

    $pembayaran_id = intval($pembayaran_id);
    $status = mysqli_real_escape_string($conn, $status);
    $today = date('Y-m-d');

    if ($metode === null) {
        $query = "UPDATE pembayaran SET tanggal_bayar = '$today', status = '$status' WHERE pembayaran_id = $pembayaran_id";
    } else {
        $metode_esc = mysqli_real_escape_string($conn, $metode);
        $query = "UPDATE pembayaran SET metode_pembayaran = '$metode_esc', tanggal_bayar = '$today', status = '$status' WHERE pembayaran_id = $pembayaran_id";
    }

    $res = mysqli_query($conn, $query);
    if ($res === false) return false;
    return mysqli_affected_rows($conn);
}


function getPembayaranByUser($user_id) {
    global $conn;
    $user_id = intval($user_id);
    $query = "SELECT * FROM pembayaran WHERE user_id = $user_id ORDER BY pembayaran_id DESC";
    $res = mysqli_query($conn, $query);
    if (!$res) return [];
    return mysqli_fetch_all($res, MYSQLI_ASSOC);
}

function getPembayaranById($pembayaran_id) {
    global $conn;
    $pembayaran_id = intval($pembayaran_id);
    if ($pembayaran_id <= 0) return null;
    $query = "SELECT * FROM pembayaran WHERE pembayaran_id = $pembayaran_id LIMIT 1";
    $res = mysqli_query($conn, $query);
    if (!$res) return null;
    $row = mysqli_fetch_assoc($res);
    return $row ?: null;
}


?>
