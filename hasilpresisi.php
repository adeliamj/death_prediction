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
                <a class="nav-link" href="hasilprob.php">Hasil Probabilitas</a>
                <a class="nav-link" href="Means.php">Hasil Presisi K-Means</a>
                <a class="nav-link active" href="hasilpresisi.php">Hasil Presisi Naive Bayes</a>
                <a class="nav-link" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>
    <h1 align="center">Hasil Presisi Naive Bayes</h1>
    <div class="container">
        <table class="table table-bordered">
            <tr>
                <th>Nama</th>
                <th>Umur</th>
                <th>Hipertensi</th>
                <th>Merokok</th>
                <th>Prediksi Kematian Data Set</th>
                <th>Prediksi Kematian Naive Bayes</th>
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
                        <?php //echo $data_uji["prediksi_kematian"]; 
                         if (($data_uji["prediksi_kematian"]) == 1) {
                            echo "mati";
                          } else {
                            echo "hidup";
                          }?>
                    </td>
                    <td>
                        <?php //echo $data_uji["hasil_nbayes"]; 
                         if (($data_uji["hasil_nbayes"]) == 1) {
                            echo "mati";
                          } else {
                            echo "hidup";
                          }
                        ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <?php
          // Establish database connection
          $connect = mysqli_connect("localhost", "root", "", "prediksi");
          if (!$connect) {
              echo "Koneksi Gagal";
              die;
          }

        // Menghitung presisi (precision)
        $query_true_positive = mysqli_query($connect, "SELECT COUNT(*) FROM user_input WHERE prediksi_kematian = '1' AND hasil_nbayes='1'");
        $true_positive = (int) mysqli_fetch_row($query_true_positive)[0];
        echo "TP = " . $true_positive . "</br>";

        $query_true_negative = mysqli_query($connect, "SELECT COUNT(*) FROM user_input WHERE prediksi_kematian = '0' AND hasil_nbayes='0'");
        $true_negative = (int) mysqli_fetch_row($query_true_negative)[0];
        echo "TN = " . $true_negative . "</br>";

        $query_false_positive = mysqli_query($connect, "SELECT COUNT(*) FROM user_input WHERE prediksi_kematian = '1' AND hasil_nbayes = '0'");
        $false_positive = (int) mysqli_fetch_row($query_false_positive)[0];
        echo "FP = " . $false_positive . "</br>";

        $query_false_negative = mysqli_query($connect, "SELECT COUNT(*) FROM user_input WHERE prediksi_kematian = '0' AND hasil_nbayes = '1'");
        $false_negative= (int) mysqli_fetch_row($query_false_negative)[0];
        echo "FN = " . $false_negative. "</br>";

        $precision = $true_positive / ($true_positive + $false_positive);
        echo "Precision = TP/(TP+FP) = " . $true_positive . "/" . $true_positive . "+" . $false_positive . " = " . $precision . " = " .round($precision*100). "% </br>";
        
        $recall = $true_positive / ($true_positive + $false_negative);
        echo "Recall= TP/(TP+FN) = " . $true_positive . "/" . $true_positive. "+" . $false_negative . " = " . $recall . " = " . round($recall*100). "% </br>";
        
        $akurasi = ($true_positive+$true_negative)/ ($true_positive+$true_negative + $false_positive+$false_negative);
        echo "Akurasi = TP+TN/(TP+TN+FP+FN)  = ".$true_positive. "+" .$true_negative. "/(" .$true_positive."+".$true_negative."+".$false_positive."+".$false_negative.") = ".$akurasi." = ".round($akurasi*100). "% </br>";
        ?>
</body>

</html>