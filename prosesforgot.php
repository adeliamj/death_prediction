<?php
include "konektor.php";

$email=$_POST["email"];
$password= password_hash($_POST['password'], PASSWORD_DEFAULT);

$query = "UPDATE dataregis SET password = '$password' WHERE email='$email'";
$data = mysqli_query($konektor,$query);

if($data){
    header("Location: login.php");
}else{
    echo "password gagal dirubah";}
?>