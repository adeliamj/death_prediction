<?php 
session_start();
if(! isset($_SESSION['inilogin']))
{
  header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <style>
        .bg-nav{
        background-color: #A0C3D2;
        }
        .text{
            margin-top:300px;
            align-items:center;
        }
        .img-home{
            width:80%;
            margin-top:180px;
            border-radius:20px;
        }
        .gambar{
            height: 710px;
            align-items:center;
        }
        .data{
            margin-top:20px;
        }
    </style>
</head>
<body>
    <!--Start Nav -->
    <nav class="navbar navbar-expand-lg bg-nav shadow-sm fixed-top">
        <div class="container">
            <div class="navbar-nav bg-nav">
                <a class="nav-link active" href="index.php">Home</a>
                <a class="nav-link" href="data.php">Input</a>
                <a class="nav-link" href="hasil.php">Hasil Statistika</a>
                <a class="nav-link" href="hasilprob.php">Hasil Probabilitas</a>
                <a class="nav-link" href="Means.php">Hasil Presisi K-Means</a>
                <a class="nav-link" href="hasilpresisi.php">Hasil Presisi Naive Bayes</a>
                <a class="nav-link" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>
    <!--End Nav-->
    <main role="main" class="container">
        <section id="home" class="home">
        <div class="container">
            <div class="row">
                <div class="col d-flex flex-column justify-content-center bg-utama" align="center"> 
                    <h1>Selamat Datang <?php echo $_SESSION['nama']; ?></h1> 
                    <div class="d-flex justify-content-center">
                    <a class="btn btn-primary btn-lg data" href="data.php"> Input Data </a>
                    </div>
                </div>
                <div class="col d-flex flex-column justify-content-center justify-content-lg-start gambar"> 
                    <img class="img-home shadow" src="home.png" > </img>
                </div>
            </div>
        </div>
        </section>
    </main>

</body>

</html>


