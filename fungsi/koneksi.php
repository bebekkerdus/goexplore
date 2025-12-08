<?php
$conn = mysqli_connect("dbserver","root","rootpass123","appdb");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}


function upload() {
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
    $nik = htmlspecialchars($data['NIK']);
    $profile = upload();


    if ($profile === false) {
        exit;
    }
    

    $query = "INSERT INTO user(username, email, password, phone_number, NIK, profile_picture)
              VALUES('$username', '$email', '$password', '$phone', '$nik', '$profile')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
?>
