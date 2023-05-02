<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prediksi";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Query data from SQL
$sql = "SELECT umur_asli, hipertensi, merokok FROM user_input";
$result = $conn->query($sql);

// Inisialisasi centroid awal
$c1 = array(65, 0, 0);
$c2 = array(85, 1, 0);

// Inisialisasi variabel hasil iterasi sebelumnya
$prev_count_c1 = 0;
$prev_count_c2 = 0;

// Inisialisasi variabel jumlah dekat dengan cluster 1 dan cluster 2
$count_c1 = 0;
$count_c2 = 0;

while ($count_c1 != $prev_count_c1 || $count_c2 != $prev_count_c2) {
  // Simpan hasil iterasi saat ini ke variabel hasil iterasi sebelumnya
  $prev_count_c1 = $count_c1;
  $prev_count_c2 = $count_c2;

  // Reset variabel jumlah dekat dengan cluster 1 dan cluster 2
  $count_c1 = 0;
  $count_c2 = 0;

  // Reset nilai centroid baru untuk masing-masing cluster
  $new_c1 = array(0, 0, 0);
  $new_c2 = array(0, 0, 0);

  // Lakukan iterasi untuk setiap baris
  while ($row = $result->fetch_assoc()) {
    // Ambil nilai umur_asli, hipertensi, dan merokok dari setiap baris
    $umur_asli = $row['umur_asli'];
    $hipertensi = $row['hipertensi'];
    $merokok = $row['merokok'];

    // Hitung jarak dari setiap baris ke centroid c1 dan c2
    $jarak_c1 = sqrt(pow(($umur_asli - $c1[0]), 2) + pow(($hipertensi - $c1[1]), 2) + pow(($merokok - $c1[2]), 2));
    $jarak_c2 = sqrt(pow(($umur_asli - $c2[0]), 2) + pow(($hipertensi - $c2[1]), 2) + pow(($merokok - $c2[2]), 2));

    // Tentukan cluster yang lebih dekat berdasarkan jarak terpendek
    if ($jarak_c1 < $jarak_c2) {
      $count_c1++;
      // Tambahkan nilai umur_asli, hipertensi, dan merokok ke centroid baru untuk cluster 1
      $new_c1[0] += $umur_asli;
      $new_c1[1] += $hipertensi;
      $new_c1[2] += $merokok;
    } else {
      $count_c2++;
      // Tambahkan nilai umur_asli, hipertensi,dan merokok ke centroid baru untuk cluster 2
      $new_c2[0] +=
        $umur_asli;
      $new_c2[1] += $hipertensi;
      $new_c2[2] += $merokok;
    }
  }

  // Update centroid c1 dan c2 dengan nilai centroid baru
  $c1[0] = $new_c1[0] / $count_c1;
  $c1[1] = $new_c1[1] / $count_c1;
  $c1[2] = $new_c1[2] / $count_c1;
  $c2[0] = $new_c2[0] / $count_c2;
  $c2[1] = $new_c2[1] / $count_c2;
  $c2[2] = $new_c2[2] / $count_c2;
}

// Mengupdate cluster di dalam tabel SQL berdasarkan centroid terakhir
$sql_update = "UPDATE user_input SET prediksi_kematian_kmeans = CASE
WHEN (POW((umur_asli - {$c1[0]}),2) + POW((hipertensi - {$c1[1]}),2) + POW((merokok - {$c1[2]}),2)) < (POW((umur_asli - {$c2[0]}),2) + POW((hipertensi - {$c2[1]}),2) + POW((merokok - {$c2[2]}),2))
THEN 0
ELSE 1
END";
?>

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

    body {
      margin-bottom: 20px;
    }
  </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg bg-nav shadow-sm fixed-top">
    <div class="container">
      <div class="navbar-nav bg-nav">
        <a class="nav-link" aria-current="page" href="index.php">Home</a>
        <a class="nav-link" href="data.php">Input</a>
        <a class="nav-link active" href="hasil.php">Hasil Statistika</a>
        <a class="nav-link" href="hasilprob.php">Hasil Probabilitas</a>
        <a class="nav-link" href="Means.php">Hasil Presisi K-Means</a>
        <a class="nav-link" href="hasilpresisi.php">Hasil Presisi Naive Bayes</a>
        <a class="nav-link" href="logout.php">Logout</a>
      </div>
    </div>
  </nav>
  <h1 align="center">Hasil Statistika (K-Means)</h1>
  <div class="container">
    <table class="table table-bordered">
      <tr>
        <th>Nama </th>
        <th>Umur</th>
        <th>Hipertensi</th>
        <th>Merokok</th>
        <th> Prediksi Kematian </th>
        <th colspan="3">Edit Data</th>
      </tr>

      <?php

      include 'koneksi.php';
      $data = mysqli_query($koneksi, "Select * from user_input");
      while ($data2 = mysqli_fetch_array($data)) { ?>
        <tr>
          <td>
            <?php echo $data2["nama"]; ?>
          </td>
          <td>
            <?php echo $data2["umur"]; ?>
          </td>
          <td>
            <?php echo $data2["hipertensi"]; ?>
          </td>
          <td>
            <?php echo $data2["merokok"]; ?>
          </td>
          <td>
            <?php
            // echo $data2["prediksi_kematian_kmeans"]." = ";
            if (($data2["prediksi_kematian_kmeans"]) == 1) {
              echo "mati";
            } else {
              echo "hidup";
            }
            ?>
          </td>
          <td><a name="update" class="link-website" href="update.php?nama=<?php echo $data_uji["nama"]; ?>">Update</a>
          </td>
          <td><a class="link-website" href="proseshapus.php?nama=<?php echo $data_uji["nama"]; ?>">Hapus</a></td>

        </tr>
      <?php } ?>

    </table>
    <button type="submit" class="btn btn-primary" name="tambah"> <a class="link-website putih" href="data.php">
        Tambah Data </a></button>
  </div>

  <?php
  include "koneksi.php";
  isset($_GET["page"]) ? $page = $_GET["page"] : $page = "";

  if ($page == "tambah") {
    include "data.php";
  }
  ?>

</body>

</html>