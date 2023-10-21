<?php 
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Young+Serif&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@600&display=swap" rel="stylesheet">
<style>
    body {
        background-image: url('bg.png');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }
    body::before {
    content: "";
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: -1;
}


    .rounded-image {
        border-radius: 200px 0 0 200px;
        margin-top: 80px;
    }

    .get-started-button {
        position: absolute;
        bottom: 20px;
        background-color: white;
        color: black;
        border: none;
        border-radius: 20px;
        padding: 10px 20px;
        cursor: pointer;
        width: 100%;
        max-width: 150px;
        transition: transform 0.2s;
    }

    .get-started-button:hover {
        transform: scale(1.1);
    }

    .col-md-7 {
    text-align: left;
}

@media (max-width: 768px) {
    .col-md-7 {
        text-align: center; 
    }

    .get-started-button {
        right: 0;
    }
}
</style>

</head>
<body>
    <?php
        include("navbar.php");
    ?>

<div class="container">
    <div class="row" data-aos="fade-up">
        <div class="col-md-7" style="margin-top: 200px; text-align: left;">
            <h1 style="color: white; font-family: 'Young Serif', serif;" >OFFCOURSE</h1>
            <p style="color:white; font-family: 'Josefin Sans', sans-serif; font-size: 22px;">Selamat Datang di website kami, dimana website ini merupakan portal kuliner terbaik!
                                    Temukan kenikmatan makanan kami sesuai selera anda!. 
                                    Pesan,Nikmati,dan Rasakan sajian kami yang paling terbaik!
                                    Pesan sekarang dan buatlah rasa lapar anda akan hilang!. 
                                    Selalu terdapat sesuatu yang lezat disini!
                                    Ayolah! pesan sekarang karena Pesannya Gampang, Nikmatnya Luar Biasa!

            </p>
            <br />
            <br />
            <br />
            <br />
            <a href="menu.php"><button class="get-started-button" style="font-family: 'Noto Sans', sans-serif; border: 2px solid black">Get Started</i></button></a>
        </div>
    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
</script>
</body>
</html>
