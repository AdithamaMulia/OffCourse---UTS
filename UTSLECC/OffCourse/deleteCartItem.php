<?php
session_start();
include 'koneksi.php';

if (isset($_POST['delete']) && isset($_POST['id_cart'])) {
    $id_cart = $_POST['id_cart'];

    $sql = "DELETE FROM cart WHERE id_cart = $id_cart";
    $result = $conn->query($sql);
    header('Location: cart.php');
    exit;
}
header('Location: cart.php');
?>
