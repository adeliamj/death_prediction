<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <style>
        body{
            margin-top: 80px;
            font-family: 'Montserrat';  
            font-size:14px;
        }
        h2{
            padding-bottom: 20px;
        }
        .container{
            padding-top:5px;
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
            padding-top:10px;
        }
    </style>
</head>
<body>
    <main role="main" class="flex-shrink-0">
        <div class="container mt-5 pinggir">
            <form method="post" action="" class="formcek">
                <h2 align="center"> Register </h2>
                <div class="container">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="container">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="container">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="container">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="container">
                    <div class="row tombol">
                        <div class="col-2">
                            <button type="reset" class="btn btn-primary" name="reset"> Reset </button>
                        </div>
                        <div class="col-7">
                            <button type="submit" class="btn btn-primary" name="register">Register</button>
                        </div>
                    <div class="row tombol ">
                        <p class="login-register-text">Anda sudah punya akun? <a href="login.php" >Login</a></p>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="javascript.js"></script>

</body>
</html>
<?php
    include_once('konektor.php');
    $database = new database();
    if(isset($_POST['register'])){
        $nama = $_POST['nama'];
        $username= $_POST['username'];
        $email = $_POST['email'];
        $password= password_hash($_POST['password'], PASSWORD_DEFAULT);
        if($database->register($nama,$username,$email,$password))
        {
            header('location: login.php');
        }
    } 
?>