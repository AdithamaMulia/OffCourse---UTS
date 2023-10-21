<?php
session_start();
include 'koneksi.php';

if (isset($_POST['delete']) && isset($_POST['id_cart'])) {
    // Connect to the database (include 'koneksi.php' or set up a new connection)

    // Retrieve the item ID to delete
    $id_cart = $_POST['id_cart'];

    // Execute a DELETE query to remove the item from the database
    $sql = "DELETE FROM cart WHERE id_cart = $id_cart";
    $result = $conn->query($sql);

    // Close the database connection if necessary

    // Redirect back to the cart page
    header('Location: cart.php');
    exit;
}
header('Location: cart.php');
?>
