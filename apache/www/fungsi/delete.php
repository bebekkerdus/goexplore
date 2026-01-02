<?php
header('Content-Type: application/json');
// include the shared DB/functions file
require __DIR__ . '/koneksi.php';


if (isset($_POST['id_destinasi'])) {
    $id = intval($_POST['id_destinasi']);
    $res = delDestinasi($id);

    if ($res && $res > 0) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Data destinasi tidak ditemukan atau gagal dihapus"
        ]);
    }

    exit;
}

if (isset($_POST['id_hotel'])) {
    $id = intval($_POST['id_hotel']);
    $res = delHotel($id);

    if ($res && $res > 0) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Data hotel tidak ditemukan atau gagal dihapus"
        ]);
    }

    exit;
}

if (isset($_POST['id_user'])) {
    $id = intval($_POST['id_user']);
    $res = delUser($id);

    if ($res && $res > 0) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Data user tidak ditemukan atau gagal dihapus"
        ]);
    }

    exit;
}

echo json_encode([
    "success" => false,
    "message" => "Parameter id_hotel atau id_destinasi tidak diterima"
]);
exit;
