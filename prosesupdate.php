<?php
include "koneksi.php";

$nama = $_POST["nama"];
$umur= $_POST["umur"];
$hipertensi=$_POST["hipertensi"];
$merokok=$_POST["merokok"];

$query = "UPDATE user_input SET hipertensi='$hipertensi', merokok='$merokok', umur='$umur' WHERE nama='$nama'";
$data = mysqli_query($koneksi,$query);
if($data){
    header("Location: hasil.php");
}else{
    echo "data gagal dirubah";}
?>