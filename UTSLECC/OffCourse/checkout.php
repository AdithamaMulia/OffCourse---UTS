<?php 
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

$cartData = ['id_cart', 'id_user', 'id_makanan', 'id_minuman', 'id_cemilan', 'id_dessert'];

$cartItems = [];

$cartDataNames = ['makanan', 'minuman', 'cemilan', 'dessert'];

$cartDataQueryResult = [];

$cartQuery = "SELECT cart.*, makanan.nama_makanan AS nama_makanan, makanan.Harga_makanan, makanan.foto_makanan, minuman.nama_minuman AS nama_minuman, minuman.Harga_minuman, minuman.foto_minuman, cemilan.nama_cemilan AS nama_cemilan, cemilan.Harga_cemilan, cemilan.foto_cemilan, dessert.nama_dessert AS nama_dessert, dessert.Harga_dessert, dessert.foto_dessert FROM cart 
LEFT JOIN makanan ON cart.id_makanan = makanan.id_makanan 
LEFT JOIN minuman ON cart.id_minuman = minuman.id_minuman 
LEFT JOIN cemilan ON cart.id_cemilan = cemilan.id_cemilan 
LEFT JOIN dessert ON cart.id_dessert = dessert.id_dessert WHERE cart.id_user = $user_id";

$cartQueryResult = $conn->query($cartQuery);

if (!$cartQueryResult) {
    die('Error: ' . $conn->error);
}

if ($cartQueryResult) {
    while ($row = $cartQueryResult->fetch_assoc()) {
        $item = [];
        foreach ($cartData as $column) {
            $item[$column] = $row[$column];
        }

        $itemType = null;
        foreach ($cartDataNames as $columnName) {
            if (isset($item['id_' . $columnName])) {
                $itemType = $columnName;
                break;
            }
        }

        $item['nama'] = $row['nama_' . $itemType];
        $item['harga'] = $row['Harga_' . $itemType];
        $item['foto'] = $row['foto_' . $itemType];

        $cartItems[] = $item;
    }
}

$subtotal = 0;
$taxRate = 0.50;

foreach ($cartItems as $item) {
    $subtotal += $item['harga'];
}

$tax = $subtotal * $taxRate;
$total = $subtotal + $tax;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
<style>
            .custom-card {
            background-color:  #FFCC80 !important;
        }
        .rounded-buttons {
            background-color: #F6B14A;
            color: black;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            cursor: pointer;
            width: 100%;
            max-width: 200px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto;
            box-shadow: 5px 5px 10px grey;
            font-family: 'Tenor Sans', sans-serif;
        }
</style>
</head>
<body style="background-color: #F2E6D3;">
    <?php
    include("navbar.php");
    ?>
    <div class="container" style="margin-top:170px;">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="card custom-card">
                    <div class="card-body">
                        <h1 class="card-title">Checkout</h1>
                        <form method="post" action="berhasil.php">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Address:</label>
                                <input type="text" class="form-control" name="address" required>
                            </div>

                            <div class="mb-3">
                                <label for="product" class="form-label">Product:</label>
                                <br />
                                <?php
                                foreach ($cartItems as $item) {
                                    echo '<div class="col-md-9">';
                                    echo '<p>' . $item['nama'] . '    $ ' . $item['harga'] . '</p>';
                                    echo '<br />';
                                    echo '</div>';
                                }             
                                ?>
                            </div>
                            <div class="mb-3">
                                <p>Sub Total: $<?php echo number_format($subtotal, 2); ?></p>
                                <p>Tax ("10%"): $<?php echo number_format($tax, 2); ?></p>
                                <p>Total: $<?php echo number_format($total, 2); ?></p>
                            </div>

                            <a href="berhasil.php"><button class="rounded-buttons">Submit Order</button></a>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Rn538yOtIW6c50b58ZJCmx3F/b0K07avh5mNOnF5V9+iuBf0zpm4v4sz2Zghz6L2d" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-ebqJOK4zg47ul3r2sFpIeZcBMLn0I0zS6VEpXJJNDK4zIuE4uJ2jKjOPfFf5y4ma" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>
