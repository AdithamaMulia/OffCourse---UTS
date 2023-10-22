<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: denied.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_makanan = $_POST['nama_makanan'];
    $deskripsi_makanan = $_POST['deskripsi_makanan'];
    $harga_makanan = $_POST['harga_makanan'];

    if (isset($_FILES['foto_makanan']) && $_FILES['foto_makanan']['error'] === 0) {
        $uploadDir = "makanan_img/";
        $uploadedFile = $uploadDir . basename($_FILES['foto_makanan']['name']);

        if (move_uploaded_file($_FILES['foto_makanan']['tmp_name'], $uploadedFile)) {
            $sql = "INSERT INTO makanan (nama_makanan, deskripsi_makanan, harga_makanan, foto_makanan) 
                    VALUES ('$nama_makanan', '$deskripsi_makanan', $harga_makanan, '$uploadedFile')";

            if ($conn->query($sql) === TRUE) {
                header("Location: admin.php");
                exit();
            } else {
                echo "Error adding data: " . $conn->error;
            }
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "Success!";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Makanan - OffCourse</title>
</head>
<body style="background-color: #F2E6D3;">
    <h2>Add Makanan</h2>
    <form action="addMakanan.php" method="post" enctype="multipart/form-data">
        <label for="nama_makanan">Nama Makanan:</label>
        <input type="text" name="nama_makanan" required><br><br>

        <label for="deskripsi_makanan">Deskripsi Makanan:</label>
        <textarea name="deskripsi_makanan" rows="4" cols="50"></textarea><br><br>

        <label for="harga_makanan">Harga Makanan:</label>
        <input type="number" name="harga_makanan" required><br><br>

        <label for="foto_makanan">Foto Makanan:</label>
        <input type="file" name="foto_makanan" accept="image/*"><br><br>

        <input type="submit" value="Add Makanan">
    </form>

    <a href="admin.php">Back to Admin Page</a>
</body>
</html>
