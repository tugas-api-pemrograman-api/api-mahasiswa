<?php
header("Content-Type: application/json");
include "../koneksidb.php";
$method = $_POST["_method"] ?? $_SERVER["REQUEST_METHOD"];
if ($method !== "DELETE") {
    echo json_encode(["error"=>"Bukan DELETE"]); exit;
}
$data = json_decode(file_get_contents("php://input"), true);
if (!isset($data["id"])) {
    echo json_encode(["status" => "error", "message" => "ID harus diisi"]);
    exit;
}
$conn = getkoneksi();
$query = $conn->prepare("DELETE FROM mahasiswa WHERE NIM=?");
$query->bind_param("s", $data["NIM"]);
$query->execute();

echo json_encode(["status" => "success", "message" => "User berhasil dihapus"]);
?>
