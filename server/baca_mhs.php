<!-- Baca Mahasiswa -->
<?php
header("Content-Type: application/json; charset=UTF-8");
include "../koneksidb.php";

$conn = getkoneksi();

if (isset($_GET["NIM"])) 
    {
    $nim = $_GET["NIM"];
    $result = $conn->query("SELECT * FROM mahasiswa WHERE NIM='$nim'");
    echo json_encode($result->fetch_assoc());
    } 
else 
{
    $result = $conn->query("SELECT * FROM mahasiswa");
    $rows = [];
    while ($r = $result->fetch_assoc()) {
        $rows[] = $r;
    }
    echo json_encode($rows);
}