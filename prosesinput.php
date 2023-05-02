<?php
include "koneksi.php";
$nama = $_POST["nama"];
$umur = $_POST["umur"];
$hipertensi = $_POST["hipertensi"];
$merokok = $_POST["merokok"];

if ($umur >= 50) {
    $umur_asli = 1;
} else {
    $umur_asli = 0;
}

$query = "INSERT INTO user_input(nama, umur, umur_asli, hipertensi, merokok) VALUES ('$nama','$umur','$umur_asli','$hipertensi','$merokok')";
$db = mysqli_query($koneksi, $query);

if (isset($_POST["submit"])) {
    if ($db) {
        header("Location: hasil.php");
    } else {
        echo "Data gagal ditambahkan";
    }
} elseif (isset($_POST["submit2"])) {
    if ($db) {
        $query1 = "UPDATE user_input AS ui SET ui.kombinasi_input = CONCAT(ui.umur_asli, ui.hipertensi, ui.merokok)";
        $db1 = mysqli_query($koneksi, $query1);

        $query2 = "UPDATE user_input AS ui SET ui.input_output = CONCAT(ui.umur_asli, ui.hipertensi, ui.merokok, ui.prediksi_kematian)";
        $db2 = mysqli_query($koneksi, $query2);

        header("Location: hasilprob.php");
    } else {
        echo "Data gagal ditambahkan";
    }
}
?>