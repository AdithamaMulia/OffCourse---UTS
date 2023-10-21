<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: denied.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    if ($action === "edit" && isset($_POST['data_id'])) {
        $data_id = $_POST['data_id'];
        $data_id = $conn->real_escape_string($data_id);
        $table = $_POST['table'];
        $columns = [];
        $result = $conn->query("SHOW COLUMNS FROM $table");
        while ($row = $result->fetch_assoc()) {
            $columns[] = $row['Field'];
        }
    
        $updateFields = [];
        foreach ($columns as $column) {
            if ($column != 'id_' . $table) {
                $columnValue = $conn->real_escape_string($_POST[$column]);
                $updateFields[] = "$column = '$columnValue'";
            }
        }

        $setClause = implode(", ", $updateFields);
    
        $sql = "UPDATE $table SET $setClause WHERE id_$table = '$data_id'";
        
        if ($conn->query($sql) === TRUE) {
            header("Location: admin.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    } elseif ($action === "delete" && isset($_POST['data_id'])) {
        $data_id = $_POST['data_id'];
        $data_id = $conn->real_escape_string($data_id);
        $table = $_POST['table'];

        $sql = "DELETE FROM $table WHERE id_$table = '$data_id'";
        Var_dump($data_id);
        
        if ($conn->query($sql) === TRUE) {
            header("Location: admin.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Status - OffCourse</title>
</head>
<body>
    <?php echo "Success" ?>
</body>
</html>