<?php 
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .navbar-sticky {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }
        .navbar-sticky {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            border-bottom: 1px solid #ccc;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-light navbar-sticky" style="background: white; box-shadow: 5px 5px 10px grey;">
        <div class="container">
            <a class="navbar-brand" href="Homepage.php"><img src="logo.png" style="width: 80px; height: 80px; filter: drop-shadow(5px 5px 10px grey);"></a>
            <b><p>OFFCOURSE</p></b>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav ml-auto mr-5">
                    <li class="nav-item">
                        <a class="nav-link" href="Homepage.php" style="color:black filter: drop-shadow(5px 5px 10px grey);"><b>Home</b></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Menu.php" style="color:black filter: drop-shadow(5px 5px 10px grey);"><b>Menu</b></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php" style="color:black filter: drop-shadow(5px 5px 10px grey);"><b>Cart</b></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="footer.php" style="color:black filter: drop-shadow(5px 5px 10px grey);"><b>About Us</b></a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                <?php
                    if (isset($_SESSION['user_id'])) {
                        $user_id = $_SESSION['user_id'];
                        $user_image_path = '';
                        $username = '';
                        $sql = "SELECT foto_user, username FROM user WHERE id_user = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $user_id);
                        $stmt->execute();
                        $stmt->bind_result($user_image_path, $username);
                        $stmt->fetch();
                        $stmt->close();

                        echo '<li class="nav-item mt-3">';
                        echo '<a class="nav-link" href="logout.php" style="color: black;"><b>Logout</b></a>';
                        echo '</li>';
                        echo '<li class="nav-item">';

                        if($_SESSION['role'] === 'admin'){
                            echo '<a class="nav-link mt-3 mr-5" href="admin.php" style="color: black;"><b>Admin Page</b></a>';
                        }
                        echo '</li>';
                        echo '<li class="nav-item mr-4">';
                        echo '<img src="user_img/' . $user_image_path . '" alt="User Image" style="width: 70px; height: 70px; border-radius: 50%; margin-top: 10px;">';
                        echo '</li>';
                        echo '<li class="nav-item mt-4"><a style="color: black;"><b>' . $username . '</b></a></li>';
                    } else {
                        echo '<li class="nav-item"><a class="nav-link" href="signup.php" style="color: black;"><b>Signup</b></a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="login.php" style="color: black;"><b>Login</b></a></li>';
                    }
                ?>
                </ul>
            </div>
        </div>
    </nav>
</body>
</html>
