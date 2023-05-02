<?php
include 'konektor.php';
if (isset($_POST['lupapw'])) {
    $email = $_POST['email'];
    $query = mysqli_query($koneksi, "SELECT * FROM membuat WHERE email = '$email'");
    if (mysqli_num_rows($query) > 0) {
        $result = mysqli_fetch_array($query);
        $password = $result['password'];
    } else {
        echo "<script>alert('Email tidak ditemukan!'); window.location.href='minta email.html';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
        <style>
        .link-website {
            text-decoration: none;
            color: black;
        }
        .putih{
            color: white;
        }
        </style>
    </head>
    <body>
        <main role="main" class="flex-shrink-0">
            <div class="container mt-5 pinggir">
                <form method="post" action="prosesforgot.php">
                    <input type="hidden" name="email" value="<?php echo $email ?>">
                        <h2 align="center"> Ubah Password</h2>
                        <div class="form-outline form-white mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" />
                        </div>
                        <div class="form-outline form-white mb-3">
                            <label class="form-label" for="password">Password Baru</label>
                            <input type="password" name="password" id="password" class="form-control" />
                        </div>
                        <div class="row tombol">
                            <div class="col-1">
                                <button class="btn btn-primary" name="kembali"> <a class="link-website putih" href="login.php"> Kembali </a> </button>
                            </div>
                            <div class="col-7">
                                <button type="submit" class="btn btn-primary" name="simpan"> Simpan Perubahan </a> </button>
                            </div>
                        </div>
                </form>
            </div>
        </main>
    </body>
</html>