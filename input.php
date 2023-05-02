<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <style>
        .isi {
            margin-top: 50px;
        }

        .tombol {
            margin-top: 20px;
        }

        .link-website {
            text-decoration: none;
            color: black;
        }

        .putih {
            color: white;
        }
    </style>
</head>

<body>
    <main role="main" class="flex-shrink-0">
        <div class="container mt-5 pinggir">
            <form method="POST" action="prosesinput.php">
                <h2 align="center"> Input Data</h2>
                <div class="container">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama">
                </div>
                <div class="container">
                    <label for="umur" class="col-sm-2 col-form-label">Umur</label>
                    <input type="text" class="form-control" id="umur" name="umur">
                </div>
                <div class="container">
                    <label for="hipertensi" class="col-sm-2 col-form-label">Hipertensi</label>
                    <input type="text" class="form-control" id="hipertensi" name="hipertensi">
                </div>
                <div class="container">
                    <label for="merokok" class="col-sm-2 col-form-label">Merokok</label>
                    <input type="text" class="form-control" id="merokok" name="merokok">
                </div>
                <div class="container">
                    <div class="row tombol">
                        <div class="col-1">
                            <button class="btn btn-primary" name="kembali"> <a class="link-website putih"
                                    href="data.php"> Kembali </a> </button>
                        </div>
                        <div class="col-7">
                            <button type="submit" class="btn btn-primary" name="submit"> Simpan </a> </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

</body>

</html>