<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: denied.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_minuman = $_POST['nama_minuman'];
    $deskripsi_minuman = $_POST['deskripsi_minuman'];
    $harga_minuman = $_POST['harga_minuman'];

    if (isset($_FILES['foto_minuman']) && $_FILES['foto_minuman']['error'] === 0) {
        $uploadDir = "minuman_img/";
        $uploadedFile = $uploadDir . basename($_FILES['foto_minuman']['name']);

        if (move_uploaded_file($_FILES['foto_minuman']['tmp_name'], $uploadedFile)) {
            $sql = "INSERT INTO minuman (nama_minuman, deskripsi_minuman, harga_minuman, foto_minuman) 
                    VALUES ('$nama_minuman', '$deskripsi_minuman', $harga_minuman, '$uploadedFile')";

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
    <title>Add Minuman - OffCourse</title>
</head>
<body style="background-color: #F2E6D3;">
    <h2>Add Minuman</h2>
    <form action="addMinuman.php" method="post" enctype="multipart/form-data">
        <label for="nama_minuman">Nama Minuman:</label>
        <input type="text" name="nama_minuman" required><br><br>

        <label for="deskripsi_minuman">Deskripsi Minuman:</label>
        <textarea name="deskripsi_minuman" rows="4" cols="50"></textarea><br><br>

        <label for="harga_minuman">Harga Minuman:</label>
        <input type="number" name="harga_minuman" required><br><br>

        <label for="foto_minuman">Foto Minuman:</label>
        <input type="file" name="foto_minuman" accept="image/*"><br><br>

        <input type="submit" value="Add Minuman">
    </form>

    <a href="admin.php">Back to Admin Page</a>
</body>
</html>
