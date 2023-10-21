<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: denied.php");
    exit();
}

function getData($tableName) {
    global $conn;
    $sql = "SELECT * FROM $tableName";
    $result = $conn->query($sql);

    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return $data;
}

$makananData = getData('makanan');
$minumanData = getData('minuman');
$cemilanData = getData('cemilan');
$dessertData = getData('dessert');

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Page - OffCourse</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            border: 2px solid #000;
        }

        table, th, td {
            border: 2px solid #000;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border: 2px solid #000;
        }
    </style>
</head>
<body style="background-color: #F2E6D3;">
    <b><h2>OFFCOURSE</h2></b>
    <h2>Welcome, Admin - <?php echo $_SESSION['username']; ?></h2>
    <a class="nav-link" href="index.php" style="color: black;"><b>Home Page</b></a>

    <h3>Makanan Data</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama Makanan</th>
            <th>Deskripsi</th>
            <th>Harga</th>
            <th>Foto</th>
            <th>Edit Data</th>
        </tr>
        <?php foreach ($makananData as $row) : ?>
            <tr>
                <td><?php echo $row['id_makanan']; ?></td>
                <td><?php echo $row['nama_makanan']; ?></td>
                <td><?php echo $row['deskripsi_makanan']; ?></td>
                <td><?php echo $row['Harga_makanan']; ?></td>
                <td><?php echo $row['foto_makanan']; ?></td>
                <td><a href="edit_data.php?table=makanan&id=<?php echo $row['id_makanan']; ?>">Edit</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="addMakanan.php">Add Data</a>

    <h3>Minuman Data</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama Minuman</th>
            <th>Deskripsi</th>
            <th>Harga</th>
            <th>Foto</th>
            <th>Edit Data</th>
        </tr>
        <?php foreach ($minumanData as $row) : ?>
            <tr>
                <td><?php echo $row['id_minuman']; ?></td>
                <td><?php echo $row['nama_minuman']; ?></td>
                <td><?php echo $row['deskripsi_minuman']; ?></td>
                <td><?php echo $row['Harga_minuman']; ?></td>
                <td><?php echo $row['foto_minuman']; ?></td>
                <td><a href="edit_data.php?table=minuman&id=<?php echo $row['id_minuman']; ?>">Edit</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="addMinuman.php">Add Data</a>

    <h3>Cemilan Data</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama Cemilan</th>
            <th>Deskripsi</th>
            <th>Harga</th>
            <th>Foto</th>
            <th>Edit Data</th>
        </tr>
        <?php foreach ($cemilanData as $row) : ?>
            <tr>
                <td><?php echo $row['id_cemilan']; ?></td>
                <td><?php echo $row['nama_cemilan']; ?></td>
                <td><?php echo $row['deskripsi_cemilan']; ?></td>
                <td><?php echo $row['Harga_cemilan']; ?></td>
                <td><?php echo $row['foto_cemilan']; ?></td>
                <td><a href="edit_data.php?table=cemilan&id=<?php echo $row['id_cemilan']; ?>">Edit</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="addCemilan.php">Add Data</a>

    <h3>Dessert Data</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama Dessert</th>
            <th>Deskripsi</th>
            <th>Harga</th>
            <th>Foto</th>
            <th>Edit Data</th>
        </tr>
        <?php foreach ($dessertData as $row) : ?>
            <tr>
                <td><?php echo $row['id_dessert']; ?></td>
                <td><?php echo $row['nama_dessert']; ?></td>
                <td><?php echo $row['deskripsi_dessert']; ?></td>
                <td><?php echo $row['Harga_dessert']; ?></td>
                <td><?php echo $row['foto_dessert']; ?></td>
                <td><a href="edit_data.php?table=dessert&id=<?php echo $row['id_dessert']; ?>">Edit</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="addDessert.php">Add Data</a>
    <br />
    <br />
    <a href="logout.php">Log Out</a>
</body>
</html>
