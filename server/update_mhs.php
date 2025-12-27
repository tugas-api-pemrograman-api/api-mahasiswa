<?php
    header("Content-Type: application/json; charset=UTF-8");
    include "../koneksidb.php";
    $method = $_POST["_method"] ?? $_SERVER["REQUEST_METHOD"];
    if ($method == "PUT")
    {
        echo json_encode(["error" => "Bukan PUT"]);
        exit;
    }

    $data = json_decode(file_get_contents("php://input"), true);
    if (!isset ($data["NIM"]))
    {
        echo json_encode (["status" => "error", "message" => "NIM harus diisi"]);
        exit;
    }

    $conn = getkoneksi();
    $query = $conn->prepare("UPDATE mahasiswa SET NAMA = ?, ALAMAT  = ?, PRODI = ? WHERE NIM = ?");
    $query -> bind_param("ssi", $data["NAMA"], $data["ALAMAT"], $data["PRODI"], $data["NIM"]);
    $query -> execute ();
    echo json_encode (["status" => "success", "message" => "mhs diupdate"]);
?>