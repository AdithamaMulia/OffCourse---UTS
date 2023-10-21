<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: denied.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['table']) && isset($_GET['id'])) {
    $table = $_GET['table'];
    $data_id = $_GET['id'];
    $columns = [];
    $result = $conn->query("SHOW COLUMNS FROM $table");
    
    while ($row = $result->fetch_assoc()) {
        $columns[] = $row['Field'];
    }

    $data_id = $conn->real_escape_string($data_id);
    $sql = "SELECT * FROM $table WHERE id_$table = '$data_id'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        echo "$table not found.";
        $conn->close();
        exit();
    }
} else {
    echo "Invalid request.";
    $conn->close();
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Data - OffCourse</title>
</head>
<body style="background-color: #F2E6D3;">
    <h2>Edit Data</h2>
    <form action="prosesEdit_data.php" method="post">
        <input type="hidden" name="table" value="<?php echo $table; ?>">
        <?php
        foreach ($columns as $column) {
            if ($column != 'id_' . $table) {
                $columnValue = htmlspecialchars($row[$column]);
                echo '<label for="' . $column . '">' . $column . ':</label>';
                echo '<input type="text" name="' . $column . '" value="' . $columnValue . '" required><br><br>';
            }
        }
        ?>
        <input type="hidden" name="data_id" value="<?php echo $data_id; ?>">
        <label for="action">Action:</label>
        <select name="action" required>
            <option value="edit">Edit</option>
            <option value="delete">Delete</option>
        </select><br><br>
        <input type="submit" value="Submit">
    </form>
    <a href="admin.php">Back to Admin Page</a>
</body>
</html>
