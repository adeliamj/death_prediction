<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <style>
        .bg-nav {
            background-color: #A0C3D2;
        }

        h1 {
            margin-top: 80px;
        }

        table {
            margin-top: 15px;
            border: solid 1px;
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
    <nav class="navbar navbar-expand-lg bg-nav shadow-sm fixed-top">
        <div class="container">
            <div class="navbar-nav bg-nav">
                <a class="nav-link" aria-current="page" href="index.php">Home</a>
                <a class="nav-link" href="data.php">Input</a>
                <a class="nav-link" href="hasil.php">Hasil Statistika</a>
                <a class="nav-link active" href="hasilprob.php">Hasil Probabilitas</a>
                <a class="nav-link" href="Means.php">Hasil Presisi K-Means</a>
                <a class="nav-link" href="hasilpresisi.php">Hasil Presisi Naive Bayes</a>
                <a class="nav-link" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>
    <h1 align="center">Hasil Probabilitas (Naive Bayes)</h1>
    <div class="container">
        <table class="table table-bordered">
            <tr>
                <th>Nama</th>
                <th>Umur</th>
                <th>Hipertensi</th>
                <th>Merokok</th>
                <th> Prediksi Kematian </th>
                <th colspan="3">Edit Data</th>
            </tr>

            <?php

            include 'koneksi.php';
            $data = mysqli_query($koneksi, "Select * from user_input");
            while ($data_uji = mysqli_fetch_array($data)) { ?>
                <tr>
                    <td>
                        <?php echo $data_uji["nama"]; ?>
                    </td>
                    <td>
                        <?php echo $data_uji["umur"]; ?>
                    </td>
                    <td>
                        <?php echo $data_uji["hipertensi"]; ?>
                    </td>
                    <td>
                        <?php echo $data_uji["merokok"]; ?>
                    </td>
                    <td>
                        <?php
                        // Establish database connection
                        $connect = mysqli_connect("localhost", "root", "", "prediksi");
                        if (!$connect) {
                            echo "Koneksi Gagal";
                            die;
                        }
                        // Calculate the number of data points in each class
                        $sum000 = mysqli_query($connect, "SELECT COUNT(*) as count FROM data_ubah WHERE kombinasi_input = 000");
                        $sum000_row = mysqli_fetch_array($sum000)[0];

                        $sum001 = mysqli_query($connect, "SELECT COUNT(*) as count FROM data_ubah WHERE kombinasi_input = 001");
                        $sum001 = mysqli_fetch_array($sum001)[0];

                        $sum010 = mysqli_query($connect, "SELECT COUNT(*) as count FROM data_ubah WHERE kombinasi_input = 010");
                        $sum010 = mysqli_fetch_array($sum010)[0];

                        $sum100 = mysqli_query($connect, "SELECT COUNT(*) as count FROM data_ubah WHERE kombinasi_input = 100");
                        $sum100 = mysqli_fetch_array($sum100)[0];

                        $sum110 = mysqli_query($connect, "SELECT COUNT(*) as count FROM data_ubah WHERE kombinasi_input = 110");
                        $sum110 = mysqli_fetch_array($sum110)[0];

                        $sum111 = mysqli_query($connect, "SELECT COUNT(*) as count FROM data_ubah WHERE kombinasi_input = 111");
                        $sum111 = mysqli_fetch_array($sum111)[0];

                        $sum101 = mysqli_query($connect, "SELECT COUNT(*) as count FROM data_ubah WHERE kombinasi_input = 101");
                        $sum101 = mysqli_fetch_array($sum101)[0];

                        $sum011 = mysqli_query($connect, "SELECT COUNT(*) as count FROM data_ubah WHERE kombinasi_input = 011");
                        $sum011 = mysqli_fetch_array($sum011)[0];

                        $sum_data = mysqli_query($connect, "SELECT COUNT(prediksi_kematian) FROM data_ubah");
                        $sum_data_row = mysqli_fetch_array($sum_data)[0];

                        $sum_hasil_0 = mysqli_query($connect, "SELECT COUNT(prediksi_kematian) FROM data_ubah WHERE prediksi_kematian = 0");
                        $sum_hasil_1_row = mysqli_fetch_array($sum_hasil_0)[0];

                        $sum_hasil_1 = mysqli_query($connect, "SELECT COUNT(prediksi_kematian) FROM data_ubah WHERE prediksi_kematian = 1");
                        $sum_hasil_0_row = mysqli_fetch_array($sum_hasil_1)[0];

                        // Mengambil data dari $data_uji
                        if (isset($data_uji)) {
                            $umur = isset($data_uji['umur']) ? (int) $data_uji['umur'] : null;
                            $hipertensi = isset($data_uji['hipertensi']) ? (float) $data_uji['hipertensi'] : null;
                            $merokok = isset($data_uji['merokok']) ? (int) $data_uji['merokok'] : null;

                            if (isset($data_uji)) {
                                $umur = isset($data_uji['umur']) ? (int) $data_uji['umur'] : null;
                                $hipertensi = isset($data_uji['hipertensi']) ? (float) $data_uji['hipertensi'] : null;
                                $merokok = isset($data_uji['merokok']) ? (int) $data_uji['merokok'] : null;

                                if ($umur >= 50) {
                                    $umur_out = 1;
                                } else {
                                    $umur_out = 0;
                                }

                                if ($hipertensi == 0) {
                                    $commute_out = 0;
                                } else {
                                    $commute_out = 1;
                                }

                                if ($merokok == 0) {
                                    $merokok_out = 0;
                                } else {
                                    $merokok_out = 1;
                                }
                            }
                        }
                        $kombinasi_input = $umur_out . $commute_out . $merokok_out;

                        if ($kombinasi_input == "000") {
                            $pA = $sum000_row / $sum_data_row;
                            $query_b1 = mysqli_query($connect, "SELECT COUNT(input_output) FROM data_ubah WHERE input_output = '0000'");
                            $pB1 = (int) mysqli_fetch_row($query_b1)[0] / $sum_hasil_0_row;
                            $query_b0 = mysqli_query($connect, "SELECT COUNT(input_output) FROM data_ubah WHERE input_output = '1000'");
                            $pB0 = (int) mysqli_fetch_row($query_b0)[0] / $sum_hasil_1_row;
                            $pengali = $pA * $pB1;
                            $pembagi = $pA * $pB0;
                            $hasil = $pengali / ($pengali + $pembagi);
                        } elseif ($kombinasi_input == "001") {
                            $pA = $sum000_row / $sum_data_row;
                            $query_b1 = mysqli_query($connect, "SELECT COUNT(input_output) FROM data_ubah WHERE input_output = '0001'");
                            $pB1 = (int) mysqli_fetch_row($query_b1)[0] / $sum_hasil_0_row;
                            $query_b0 = mysqli_query($connect, "SELECT COUNT(input_output) FROM data_ubah WHERE input_output = '1001'");
                            $pB0 = (int) mysqli_fetch_row($query_b0)[0] / $sum_hasil_1_row;
                            $pengali = $pA * $pB1;
                            $pembagi = $pA * $pB0;
                            $hasil = $pengali / ($pengali + $pembagi);
                        } elseif ($kombinasi_input == "010") {
                            $pA = $sum000_row / $sum_data_row;
                            $query_b1 = mysqli_query($connect, "SELECT COUNT(input_output) FROM data_ubah WHERE input_output = '0010'");
                            $pB1 = (int) mysqli_fetch_row($query_b1)[0] / $sum_hasil_0_row;
                            $query_b0 = mysqli_query($connect, "SELECT COUNT(input_output) FROM data_ubah WHERE input_output = '1010'");
                            $pB0 = (int) mysqli_fetch_row($query_b0)[0] / $sum_hasil_1_row;
                            $pengali = $pA * $pB1;
                            $pembagi = $pA * $pB0;
                            $hasil = $pengali / ($pengali + $pembagi);
                        } elseif ($kombinasi_input == "011") {
                            $pA = $sum000_row / $sum_data_row;
                            $query_b1 = mysqli_query($connect, "SELECT COUNT(input_output) FROM data_ubah WHERE input_output = '0100'");
                            $pB1 = (int) mysqli_fetch_row($query_b1)[0] / $sum_hasil_0_row;
                            $query_b0 = mysqli_query($connect, "SELECT COUNT(input_output) FROM data_ubah WHERE input_output = '1100'");
                            $pB0 = (int) mysqli_fetch_row($query_b0)[0] / $sum_hasil_1_row;
                            $pengali = $pA * $pB1;
                            $pembagi = $pA * $pB0;
                            $hasil = $pengali / ($pengali + $pembagi);
                        } elseif ($kombinasi_input == "100") {
                            $pA = $sum000_row / $sum_data_row;
                            $query_b1 = mysqli_query($connect, "SELECT COUNT(input_output) FROM data_ubah WHERE input_output = '0110'");
                            $pB1 = (int) mysqli_fetch_row($query_b1)[0] / $sum_hasil_0_row;
                            $query_b0 = mysqli_query($connect, "SELECT COUNT(input_output) FROM data_ubah WHERE input_output = '1110'");
                            $pB0 = (int) mysqli_fetch_row($query_b0)[0] / $sum_hasil_1_row;
                            $pengali = $pA * $pB1;
                            $pembagi = $pA * $pB0;
                            $hasil = $pengali / ($pengali + $pembagi);
                        } elseif ($kombinasi_input == "101") {
                            $pA = $sum000_row / $sum_data_row;
                            $query_b1 = mysqli_query($connect, "SELECT COUNT(input_output) FROM data_ubah WHERE input_output = '0111'");
                            $pB1 = (int) mysqli_fetch_row($query_b1)[0] / $sum_hasil_0_row;
                            $query_b0 = mysqli_query($connect, "SELECT COUNT(input_output) FROM data_ubah WHERE input_output = '1111'");
                            $pB0 = (int) mysqli_fetch_row($query_b0)[0] / $sum_hasil_1_row;
                            $pengali = $pA * $pB1;
                            $pembagi = $pA * $pB0;
                            $hasil = $pengali / ($pengali + $pembagi);
                        } elseif ($kombinasi_input == "110") {
                            $pA = $sum000_row / $sum_data_row;
                            $query_b1 = mysqli_query($connect, "SELECT COUNT(input_output) FROM data_ubah WHERE input_output = '0101'");
                            $pB1 = (int) mysqli_fetch_row($query_b1)[0] / $sum_hasil_0_row;
                            $query_b0 = mysqli_query($connect, "SELECT COUNT(input_output) FROM data_ubah WHERE input_output = '1101'");
                            $pB0 = (int) mysqli_fetch_row($query_b0)[0] / $sum_hasil_1_row;
                            $pengali = $pA * $pB1;
                            $pembagi = $pA * $pB0;
                            $hasil = $pengali / ($pengali + $pembagi);
                        } elseif ($kombinasi_input == "111") {
                            $pA = $sum000_row / $sum_data_row;
                            $query_b1 = mysqli_query($connect, "SELECT COUNT(input_output) FROM data_ubah WHERE input_output = '0011'");
                            $pB1 = (int) mysqli_fetch_row($query_b1)[0] / $sum_hasil_0_row;
                            $query_b0 = mysqli_query($connect, "SELECT COUNT(input_output) FROM data_ubah WHERE input_output = '1011'");
                            $pB0 = (int) mysqli_fetch_row($query_b0)[0] / $sum_hasil_1_row;
                            $pengali = $pA * $pB1;
                            $pembagi = $pA * $pB0;
                            $hasil = $pengali / ($pengali + $pembagi);
                        }
                        //echo $hasil;
                        if ($hasil < 0.86) {
                            $prediksi = 0;
                        } else {
                            $prediksi = 1;
                        }

                        $update_sql = "UPDATE user_input SET hasil_nbayes = '$prediksi' WHERE umur = '$umur'";
                        mysqli_query($connect, $update_sql);

                        if ($prediksi == 1) {
                            echo "mati";
                        } else {
                            echo "hidup";
                        }

                        ?>
                    </td>
                    <td><a name="update" class="link-website"
                            href="update.php?nama=<?php echo $data_uji["nama"]; ?>">Update</a></td>
                    <td><a class="link-website" href="proseshapus.php?nama=<?php echo $data_uji["nama"]; ?>">Hapus</a></td>
                </tr>
            <?php } ?>

        </table>
        <button type="submit" class="btn btn-primary" name="tambah"> <a class="link-website putih" href="data.php">
                Tambah Data </a></button>
    </div>

    <?php
    include "koneksi.php";
    isset($_POST["page"]) ? $page = $_POST["page"] : $page = "";

    if ($page == "tambah") {
        include "data.php";
    }
    ?>
</body>

</html>