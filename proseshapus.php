<?php
include "koneksi.php";

$nama = $_GET["nama"];
$db = mysqli_query($koneksi, "DELETE FROM user_input WHERE nama='$nama'");
if ($db) {
    header("Location: hasil.php");
} else {
    echo "Data gagal dihapus";
}
?>