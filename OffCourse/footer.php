<?php 
session_start();
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
    .card-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      width: 100%;
      padding: 20px;
    }

    .card {
      width: 340px;
      text-align: center;
      border: 1px solid #ccc;
      border-radius: 10px; 
      padding: 20px;
      margin-bottom: 20px;
    }

    .card img {
      width: 100%;
      height: auto;
      border-radius: 220px;
    }

    .card-text {
      margin-top: 10px;
      font-size: 18px; 
    }

    @media (max-width: 768px) {
      .card-container {
        flex-direction: column;
        align-items: center;
      }

      .card {
        width: 100%;
      }
    }
    .custom-card {
      background-color:  #FFCC80 !important;
    }
    .judul {
      border-left: 10px solid #CB034B;
      padding-left: 10px;
    }
  </style>
</head>
<body style="background-color: #F2E6D3;">
<?php
    include("navbar.php");
?>
<div class="container" style="margin-top: 150px;">
<div>
    <h1 data-aos="zoom-in-up" class="judul">About Us</h1>
</div>
  <div class="card-container">
    <div class="card custom-card" data-aos="zoom-in-up">
      <img src="Adithama.jpeg" alt="Image 1">
      <br />
      <div class="card-text">
        <p>Adithama Mulia</p>
        <p>Back end developer</p>
        <p>Informatika 2022</p>
      </div>
    </div>

    <div class="card custom-card" data-aos="zoom-in-up">
      <img src="Jheno.jpg" alt="Image 2">
      <br />
      <div class="card-text">
        <p>Jheno Syechlo</p>
        <p>Front end developer</p>
        <p>Informatika 2022</p>
      </div>
    </div>

    <div class="card custom-card" data-aos="zoom-in-up">
      <img src="Rio.jpeg" alt="Image 3">
      <br />
      <div class="card-text">
        <p>Rionaldy Dermawan</p>
        <p>Design</p>
        <p>Informatika</p>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
</script>

</body>
</html>
