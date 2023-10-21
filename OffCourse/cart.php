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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <style>
    .custom-numeric-input {
        width: 100%;
        max-width: 60px;
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .judul {
        border-left: 10px solid #CB034B;
        padding-left: 10px;
    }

    @media (max-width: 767px) {
        .col-md-3 img {
            max-height: 200px;
            height: 100%;
            width: 100%;
            border-radius: 10px;
        }

        .card {
            width: 100%;
            max-width: 200px;
            margin: 0 auto;
        }
    }

    @media (min-width: 960px) and (max-width: 1200px) {
        .col-md-3 img {
            max-height: 200px;
        }
        .card {
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
        }
    }
    .custom-card {
            background-color:  #FFCC80 !important;
        }
        .rounded-button1 {
            background-color: #F6B14A;
            color: black;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            cursor: pointer;
            width: 100%;
            max-width: 100px;
            margin: 5px;
            font-family: 'Noto Sans', sans-serif;
        }
</style>

</head>

<body style="background-color: #F2E6D3;"> 
    <?php
    include("navbar.php");
    ?>
    <div class="container" style="margin-top: 150px;">
        <div class="row">
            <div class="col-md-8">
                <div>
                    <h1 data-aos="flip-down" class="judul">Cart</h1>
                </div>
                <?php
                foreach ($cartItems as $item) {
                    echo '<form method="post" action="deleteCartItem.php">';
                    echo '<div class="card m-3 position-relative custom-card" data-aos="flip-down" style="border-radius: 10px;">';
                    echo '<div class="row">';
                    echo '<div class="col-md-3">';
                    echo '<img src="' . $item['foto'] . '" alt="Image" style="max-height: 170px; height: 100%; width: 100%; border-radius: 10px;">';
                    echo '</div>';
                    echo '<div class="col-md-9">';
                    echo '<p style="font-size:20px;">' . $item['nama'] . '</p>';
                    echo '<div>$ ' . $item['harga'] . '</div>';
                    echo '<br />';

                    $itemType = null;
                    if (isset($item['id_makanan'])) {
                        $itemType = 'makanan';
                    } elseif (isset($item['id_minuman'])) {
                        $itemType = 'minuman';
                    } elseif (isset($item['id_cemilan'])) {
                        $itemType = 'cemilan';
                    } elseif (isset($item['id_dessert'])) {
                        $itemType = 'dessert';
                    }
                        echo '<input type="hidden" name="id_cart" value="' . $item['id_cart'] . '" />';
                        echo '<button type="submit" class="delete-button rounded-button1" name="delete">Delete</button>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</form>';
                }             
                ?>
                <hr />
            </div>
            <div class="col-md-4">
                <div class="card m-5 custom-card text-center" data-aos="flip-down">
                    <p>Order Summary</p>
                    <p>Sub Total: $<?php echo number_format($subtotal, 2); ?></p>
                    <p>Tax ("10%"): $<?php echo number_format($tax, 2); ?></p>
                    <p>Total: $<?php echo number_format($total, 2); ?></p>
                    <div class="text-center">
                    <div class="text-center">
                <?php
                if ($subtotal > 0) {
                    echo '<a href="checkout.php"><button class="rounded-button1" style="width: 100%; max-width: 150px;">Check Out</button></a>';
                } else {
                    echo '<button class="rounded-button1" style="width: 100%; max-width: 150px;" disabled>Check Out</button>';
                    echo '<p style="color: red;">Subtotal is zero. Please add items to your cart before checking out.</p>';
                }
                ?>
            </div>
        </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const numericInputs = document.querySelectorAll('.custom-numeric-input');

        numericInputs.forEach(input => {
            input.addEventListener('change', function () {
                if (this.value < 1) {
                    this.value = 1;
                }
            });
        });
    </script>
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
