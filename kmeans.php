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
$sql = "SELECT umur, hipertensi, merokok FROM data_set";
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
        // Ambil nilai umur, hipertensi, dan merokok dari setiap baris
        $umur = $row['umur'];
        $hipertensi = $row['hipertensi'];
        $merokok = $row['merokok'];
        
        // Hitung jarak dari setiap baris ke centroid c1 dan c2
        $jarak_c1 = sqrt(pow(($umur - $c1[0]), 2) + pow(($hipertensi - $c1[1]), 2) + pow(($merokok - $c1[2]), 2));
        $jarak_c2 = sqrt(pow(($umur - $c2[0]), 2) + pow(($hipertensi - $c2[1]), 2) + pow(($merokok - $c2[2]), 2));

        // Tentukan cluster yang lebih dekat berdasarkan jarak terpendek
        if ($jarak_c1 < $jarak_c2) {
            $count_c1++;
            // Tambahkan nilai umur, hipertensi, dan merokok ke centroid baru untuk cluster 1
            $new_c1[0] += $umur;
            $new_c1[1] += $hipertensi;
            $new_c1[2] += $merokok;
        } else {
            $count_c2++;
            // Tambahkan nilai umur, hipertensi,dan merokok ke centroid baru untuk cluster 2
            $new_c2[0] += $umur;
            $new_c2[1] += $hipertensi;
            $new_c2[2] += $merokok;
        }
    }
    // Hitung centroid baru untuk masing-masing cluster
    if ($count_c1 != 0) {
        $new_c1[0] /= $count_c1;
        $new_c1[1] /= $count_c1;
        $new_c1[2] /= $count_c1;
    }
    if ($count_c2 != 0) {
        $new_c2[0] /= $count_c2;
        $new_c2[1] /= $count_c2;
        $new_c2[2] /= $count_c2;
    }

// Assign nilai centroid baru ke centroid awal
$c1 = $new_c1;
$c2 = $new_c2;
}

// Tentukan cluster input dari user berdasarkan jarak terpendek ke centroid c1 dan c2
$jarak_c1_input = sqrt(pow(($umur_input - $c1[0]), 2) + pow(($hipertensi_input - $c1[1]), 2) + pow(($merokok_input - $c1[2]), 2));
$jarak_c2_input = sqrt(pow(($umur_input - $c2[0]), 2) + pow(($hipertensi_input - $c2[1]), 2) + pow(($merokok_input - $c2[2]), 2));

if ($jarak_c1_input < $jarak_c2_input) {
echo "hidup";
} else {
echo "mati";
}

// Lakukan iterasi untuk setiap baris
while ($row = $result->fetch_assoc()) {
    // Ambil nilai umur, hipertensi, dan merokok dari setiap baris
    $umur = $row['umur'];
    $hipertensi = $row['hipertensi'];
    $merokok = $row['merokok'];

    // Hitung jarak dari setiap baris ke centroid c1 dan c2
    $jarak_c1 = sqrt(pow(($umur - $c1[0]), 2) + pow(($hipertensi - $c1[1]), 2) + pow(($merokok - $c1[2]), 2));
    $jarak_c2 = sqrt(pow(($umur - $c2[0]), 2) + pow(($hipertensi - $c2[1]), 2) + pow(($merokok - $c2[2]), 2));

    if ($jarak_c1 < $jarak_c2) {
        // Update cluster 1 in the SQL table
        $sql = "UPDATE data_set SET prediksi_kematian= 0 WHERE umur = ? AND hipertensi = ? AND merokok = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iii", $umur, $hipertensi, $merokok); // assuming $umur, $hipertensi, and $merokok are the values of the corresponding columns
        $stmt->execute();
        $stmt->close();
    } else {
        // Update cluster 2 in the SQL table
        $sql = "UPDATE data_set SET prediksi_kematian= 1 WHERE umur = ? AND hipertensi = ? AND merokok = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iii", $umur, $hipertensi, $merokok); // assuming $umur, $hipertensi, and $merokok are the values of the corresponding columns
        $stmt->execute();
        $stmt->close();
    }
    
}


// Close connection
$conn->close();
?>