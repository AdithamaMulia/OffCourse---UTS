<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: denied.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_dessert = $_POST['nama_dessert'];
    $deskripsi_dessert = $_POST['deskripsi_dessert'];
    $Harga_dessert = $_POST['Harga_dessert'];
    
    if (isset($_FILES['foto_dessert']) && $_FILES['foto_dessert']['error'] === 0) {
        $uploadDir = "dessert_img/";
        $uploadedFile = $uploadDir . basename($_FILES['foto_dessert']['name']);

        if (move_uploaded_file($_FILES['foto_dessert']['tmp_name'], $uploadedFile)) {
            $sql = "INSERT INTO dessert (nama_dessert, deskripsi_dessert, Harga_dessert, foto_dessert) 
                    VALUES ('$nama_dessert', '$deskripsi_dessert', $Harga_dessert, '$uploadedFile')";

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
    <title>Add Dessert - OffCourse</title>
</head>
<body style="background-color: #F2E6D3;">
    <h2>Add Dessert</h2>
    <form action="addDessert.php" method="post" enctype="multipart/form-data">
        <label for="nama_dessert">Nama Dessert:</label>
        <input type="text" name="nama_dessert" required><br><br>
        
        <label for="deskripsi_dessert">Deskripsi Dessert:</label>
        <textarea name="deskripsi_dessert" rows="4" cols="50"></textarea><br><br>
        
        <label for="Harga_dessert">Harga Dessert:</label>
        <input type="number" name="Harga_dessert" required><br><br>
        
        <label for="foto_dessert">Foto Dessert:</label>
        <input type="file" name="foto_dessert" accept="image/*"><br><br>

        
        <input type="submit" value="Add Dessert">
    </form>

    <a href="admin.php">Back to Admin Page</a>
</body>
</html>
