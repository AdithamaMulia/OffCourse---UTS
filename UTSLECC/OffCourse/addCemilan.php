<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: denied.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_cemilan = $_POST['nama_cemilan'];
    $deskripsi_cemilan = $_POST['deskripsi_cemilan'];
    $Harga_cemilan = $_POST['Harga_cemilan'];
    
    if (isset($_FILES['foto_cemilan']) && $_FILES['foto_cemilan']['error'] === 0) {
        $uploadDir = "cemilan_img/";
        $uploadedFile = $uploadDir . basename($_FILES['foto_cemilan']['name']);

        if (move_uploaded_file($_FILES['foto_cemilan']['tmp_name'], $uploadedFile)) {
            $sql = "INSERT INTO cemilan (nama_cemilan, deskripsi_cemilan, Harga_cemilan, foto_cemilan) 
                    VALUES ('$nama_cemilan', '$deskripsi_cemilan', $Harga_cemilan, '$uploadedFile')";

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
    <title>Add Cemilan - OffCourse</title>
</head>
<body style="background-color: #F2E6D3;">
    <h2>Add Cemilan</h2>
    <form action="addCemilan.php" method="post" enctype="multipart/form-data">
        <label for="nama_cemilan">Nama Cemilan:</label>
        <input type="text" name="nama_cemilan" required><br><br>
        
        <label for="deskripsi_cemilan">Deskripsi Cemilan:</label>
        <textarea name="deskripsi_cemilan" rows="4" cols="50"></textarea><br><br>
        
        <label for="Harga_cemilan">Harga Cemilan:</label>
        <input type="number" name="Harga_cemilan" required><br><br>
        
        <label for="foto_cemilan">Foto Cemilan:</label>
        <input type="file" name="foto_cemilan" accept="image/*"><br><br>

        
        <input type="submit" value="Add Cemilan">
    </form>

    <a href="admin.php">Back to Admin Page</a>
</body>
</html>
