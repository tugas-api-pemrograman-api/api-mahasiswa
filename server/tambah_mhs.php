<?php
    header("Content-Type: application/json; charset=UTF-8");
    include "../koneksidb.php";
    $data = json_decode(file_get_contents("php://input"), true);
    if (isset($data["NIM"]) || !isset($data["NAMA"]))
        {
        echo json_encode (["status" => "error", "message" => "Data harus lengkap"]);
        exit;
        }
    $conn = open_connection();
    $query = $conn->prepare("INSERT INTO mahasiswa (NIM, NAMA, ALAMAT, PRODI) VALUES (?, ?, ?, ?)");
    $query -> bind_param($data["NIM"], $data["NAMA"], $data["ALAMAT"], $data["PRODI"]);
    $query -> execute();
    echo json_encode
    ([
        "status" => "success", "message" => "User berhasil ditambahkan"
    ]);
?>