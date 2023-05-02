<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
   <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <style>
        body{
            margin-top: 150px;
            font-family: 'Montserrat';  
            font-size:14px;
        }
        h2{
            padding-bottom: 20px;
        }
        .css{
            font-size: 18px;
            color:red;
            padding-left: 120px;
        }
        .submit{
            margin-top:10px;
        }
        .pinggir{
            width: 500px;
            box-shadow: 0 0 5px rgba(0,0,0,.3);
            padding: 40px 30px;
        }
        .tombol{
            padding-top:5px;
        }
        .forgot{
            align-items: right;
        }
    </style>
</head>
<body>
    <div class="container mt-5 pinggir">
        <form class="signin" method="post" action="">
            <h2 align="center"> Login</h2>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" class="form-control" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" class="form-control" name="password" required>
            </div>
            <div class="mb-3 form-check">
                <div class="row">
                    <div class="col">    
                        <input type="checkbox" class="form-check-input" name="simpanpw">
                        <label class="simpanpw" value="remember-me" for="simpanpw">Remember Password</label>
                    </div>
                    <div class="col">
                        <p class="lupapw" value="fogot-me" for="lupapw"> <a href="forgotpw.php"> Forgot Password? </a> </p>
                    </div>
                </div>
                
            </div>
            <div class="tombol">
                <div class="row">
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary submit" name="login"> Login <a href="index.php">  </a></button>
                    </div>
                    <div class="col-8 mt-3">
                        <p class="login-register-text">Anda belum punya akun? <a href="register.php">Register</a></p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
<?php 
session_start();
include_once('konektor.php');
$database = new database();

if(isset($_SESSION['inilogin']))
{
    header('location:index.php');
}
if(isset($_COOKIE['username'])){
    $database->relogin($_COOKIE['username']);
    header('location:index.php');
}
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    if(isset($_POST['simpanpw'])){
        $simpanpw = TRUE;
    } 
    else{
        $simpanpw = FALSE;
    }
    if($database->login($username,$password,$simpanpw)){
      header('location:index.php');
    }
}
?>