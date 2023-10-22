<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'koneksi.php';

    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama_depan = $_POST['nama_depan'];
    $nama_belakang = $_POST['nama_belakang'];
    $gender = $_POST['gender'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $role = $_POST['role'];
    $foto_user = $_FILES['foto'];

    if ($foto_user['error'] === 0) {
        $targetDir = 'user_img/';

        $fileName = uniqid() . '_' . $foto_user['name'];

        $targetPath = $targetDir . $fileName;

        if (move_uploaded_file($foto_user['tmp_name'], $targetPath)) {
            echo "File uploaded successfully!<br>";
        } else {
            echo "File upload failed.<br>";
        }
    } else {
        echo "No file was uploaded.<br>";
        header("Location: signup.php");
    }

    $hashpass = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO userdata (username, password, nama_depan, nama_belakang, gender, tanggal_lahir, role, foto_user) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssssssss", $username, $hashpass, $nama_depan, $nama_belakang, $gender, $tanggal_lahir, $role, $fileName);

        if ($stmt->execute()) {
            echo "Registration successful!";
            header("Location: login.php");
        } else {
            echo "Error: " . $stmt->error;
            header("Location: signup.php");
        }

        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
        header("Location: signup.php");
    }

    $conn->close();
}
?>
