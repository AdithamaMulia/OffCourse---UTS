<?php
session_start();
include 'koneksi.php';

$categories = ['makanan', 'minuman', 'cemilan', 'dessert'];

$makananData = [];
$minumanData = [];
$cemilanData = [];
$dessertData = [];

foreach ($categories as $category) {
    $sql = "SELECT * FROM $category";
    $result = $conn->query($sql);


    if ($result) {
        $data = $result->fetch_all(MYSQLI_ASSOC);

        switch ($category) {
            case 'makanan':
                $makananData = $data;
                break;
            case 'minuman':
                $minumanData = $data;
                break;
            case 'cemilan':
                $cemilanData = $data;
                break;
            case 'dessert':
                $dessertData = $data;
                break;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    if (isset($_POST['item_id'])) {
        $item_category = "id_" . $_POST['item_category'];
        $itemId = $_POST['item_id'];
        $userId = $_SESSION['user_id'];
        $insertQuery = "INSERT INTO cart (id_user, $item_category) VALUES ($userId, $itemId)";
        if ($conn->query($insertQuery) === TRUE) {
            // header('Location: cart.php');
            // echo "Item added to the cart successfully.";
        } else {
            echo "Error adding item to cart: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mohave&family=Noto+Sans:wght@600&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Tenor+Sans&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <style>
        .full-width-carousel {
            width: 100%;
        }

        .carousel-control-prev, .carousel-control-next {
            background: rgba(0, 0, 0, 0.5);
        }

        .carousel-control-prev-icon, .carousel-control-next-icon {
            width: 30px;
            height: 30px;
        }

        .carousel-control-prev {
            left: 0;
        }

        .carousel-control-next {
            right: 0;
        }

        .carousel {
            max-height: 550px;
            margin-top: 20px;
            border-radius: 10px;
            overflow: hidden;
            margin-top: 130px;
        }

        .carousel-inner {
            transition: transform 0.5s ease-in-out;
        }

        .card {
            margin bottom: 20px;
        }

        .rounded-button {
            background-color: #F6B14A;
            color: black;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            cursor: pointer;
            width: 100%;
            max-width: 350px;
            height: 100%;
            max-height: 50px;
            margin: 5px;
            font-family: 'Mohave', sans-serif;
            font-size: 18px;
            box-shadow: 5px 5px 10px grey;
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
            box-shadow: 5px 5px 10px grey;
            font-family: 'Noto Sans', sans-serif;
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

        .custom-card {
            background-color:  #FFCC80 !important;
        }

        .custom-rounded-image {
            border-radius: 10px 10px 0 0;
        }

        .judul {
            border-left: 10px solid #CB034B;
            padding-left: 10px;
            font-family: 'Noto Sans', sans-serif;
        }

    </style>
</head>
<body style="background-color: #F2E6D3;">
<?php
include("navbar.php");
?>
<div class="container" data-aos="fade-up">
    <div id="carouselExample" class="carousel slide full-width-carousel" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php for ($i = 0; $i < 3; $i++): ?>
                <li data-target="#carouselExample" data-slide-to="<?php echo $i; ?>" <?php if ($i === 0) echo 'class="active"'; ?>></li>
            <?php endfor; ?>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="fotohome.jpg" class="d-block w-100" alt="Image 1" style="max-height: 600px; height: 100%;">
            </div>
            <div class="carousel-item">
                <img src="rib.png" class="d-block w-100" alt="Image 2" style="max-height: 600px; height: 100%;">
            </div>
            <div class="carousel-item">
                <img src="carousel.jpg" class="d-block w-100" alt="Image 3" style="max-height: 600px; height: 100%;">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev" style="opacity: 0;">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next" style="opacity: 0;">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
<div class="container">
    <br />
    <br />
    <h1 class="judul" data-aos="fade-up">Kategori</h1>
    <br />
    <div class="button-container row" data-aos="fade-up">
        <div class="col-md-3">
            <button id="makanan" class="rounded-button btn-block">Makanan</button>
        </div>
        <div class="col-md-3">
            <button id="minuman" class="rounded-button btn-block">Minuman</button>
        </div>
        <div class="col-md-3">
            <button id="cemilan" class="rounded-button btn-block">Cemilan</button>
        </div>
        <div class="col-md-3">
            <button id="dessert" class="rounded-button btn-block">Dessert</button>
        </div>
    </div>
    <hr data-aos="fade-up" />
    <div class="row mok" style="margin-top: 50px;">
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

<script>
    let card;
    function updateDisplayedData(category) {
        const dataContainer = document.querySelector('.mok');
        dataContainer.innerHTML = '';

        switch (category) {
            case 'makanan': 
                <?php foreach ($makananData as $item): ?>
                card = document.createElement('div');
                card.className = 'col-6 col-md-6 col-lg-3 mb-2';

                card.innerHTML = `
                <div class="card custom-card" style="max-width: 350px; border-radius: 30px 30px 10px 10px;" data-aos="fade-up">
                    <img src="<?php echo $item['foto_makanan']; ?>" class="img-fluid custom-rounded-image mt-0 mx-auto d-block" alt="Image" style="max-height: 250px; height: 100%; max-width: 300px; width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title" style="display: flex; justify-content: center; align-items: center; margin: 0 auto;"><?php echo $item['nama_makanan']; ?></h5>
                        <h5 class="card-title" style="display: flex; justify-content: center; align-items: center; margin: 0 auto;">$<?php echo $item['Harga_makanan']; ?></h5>
                        <hr />
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <input type="hidden" name="item_category" value="makanan">
                            <input type="hidden" name="item_id" value="<?php echo $item['id_makanan']; ?>">
                            <?php if (isset($_SESSION['user_id'])): ?>
                                <button class="rounded-button1" type="submit" name="add_to_cart">Add to Cart</button>
                            <?php else: ?>
                                <button class="rounded-button1" type="button" onclick="redirectToLogin()">Add to Cart</button>
                            <?php endif; ?>
                        </form>
                        <br />
                        <button class="toggle-description rounded-buttons">View More</button>
                        <div class="card-content" style="max-height: 0; overflow-y: auto; transition: max-height 0.3s ease-in-out;">
                            <br />
                            <p style="color: black;"><?php echo $item['deskripsi_makanan']; ?></p>
                        </div>
                    </div>
                </div>
                `;

                dataContainer.appendChild(card);
                <?php endforeach; ?>
                break;
            case 'minuman':
                <?php foreach ($minumanData as $item): ?>
                card = document.createElement('div');
                card.className = 'col-6 col-md-6 col-lg-3 mb-2';

                card.innerHTML = `
                <div class="card custom-card" style="max-width: 350px; border-radius: 30px 30px 10px 10px;" data-aos="fade-up">
                    <img src="<?php echo $item['foto_minuman']; ?>" class="img-fluid custom-rounded-image mt-0 mx-auto d-block" alt="Image" style="max-height: 250px; height: 100%; max-width: 350px; width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title" style="display: flex; justify-content: center; align-items: center; margin: 0 auto;"><?php echo $item['nama_minuman']; ?></h5>
                        <h5 class="card-title" style="display: flex; justify-content: center; align-items: center; margin: 0 auto;">$<?php echo $item['Harga_minuman']; ?></h5>
                        <hr />
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <input type="hidden" name="item_category" value="minuman">
                            <input type="hidden" name="item_id" value="<?php echo $item['id_minuman']; ?>">
                            <?php if (isset($_SESSION['user_id'])): ?>
                                <button class="rounded-button1" type="submit" name="add_to_cart">Add to Cart</button>
                            <?php else: ?>
                                <button class="rounded-button1" type="button" onclick="redirectToLogin()">Add to Cart</button>
                            <?php endif; ?>
                        </form>
                        <br />
                        <button class="toggle-description rounded-buttons">View More</button>
                        <div class="card-content" style="max-height: 0; overflow-y: auto; transition: max-height 0.3s ease-in-out;">
                            <br />
                            <p style="color: black;"><?php echo $item['deskripsi_minuman']; ?></p>
                        </div>
                    </div>
                </div>
                `;

                dataContainer.appendChild(card);
                <?php endforeach; ?>
                break;
            case 'cemilan':
                <?php foreach ($cemilanData as $item): ?>
                card = document.createElement('div');
                card.className = 'col-6 col-md-6 col-lg-3 mb-2';

                card.innerHTML = `
                <div class="card custom-card" style="max-width: 350px; border-radius: 30px 30px 10px 10px;" data-aos="fade-up">
                    <img src="<?php echo $item['foto_cemilan']; ?>" class="img-fluid custom-rounded-image mt-0 mx-auto d-block" alt="Image" style="max-height: 250px; height: 100%; max-width: 350px; width: 100%;">
                    <div class="card-body">
                    <h5 class="card-title" style="display: flex; justify-content: center; align-items: center; margin: 0 auto;"><?php echo $item['nama_cemilan']; ?></h5>
                    <h5 class="card-title" style="display: flex; justify-content: center; align-items: center; margin: 0 auto;">$<?php echo $item['Harga_cemilan']; ?></h5>
                    <hr />
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <input type="hidden" name="item_category" value="cemilan">
                        <input type="hidden" name="item_id" value="<?php echo $item['id_cemilan']; ?>">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <button class="rounded-button1" type="submit" name="add_to_cart">Add to Cart</button>
                        <?php else: ?>
                            <button class="rounded-button1" type="button" onclick="redirectToLogin()">Add to Cart</button>
                        <?php endif; ?>
                    </form>
                    <br />
                    <button class="toggle-description rounded-buttons">View More</button>
                    <div class="card-content" style="max-height: 0; overflow-y: auto; transition: max-height 0.3s ease-in-out;">
                        <br />
                        <p style="color: black;"><?php echo $item['deskripsi_cemilan']; ?></p>
                    </div>
                    </div>
                </div> 
                `;

                dataContainer.appendChild(card);
                <?php endforeach; ?>
                break;
            case 'dessert':
                <?php foreach ($dessertData as $item): ?>
                card = document.createElement('div');
                card.className = 'col-6 col-md-6 col-lg-3 mb-2';

                card.innerHTML = `
                <div class="card custom-card" style="max-width: 350px; border-radius: 30px 30px 10px 10px;" data-aos="fade-up">
                    <img src="<?php echo $item['foto_dessert']; ?>" class="img-fluid custom-rounded-image mt-0 mx-auto d-block" alt="Image" style="max-height: 250px; height: 100%; max-width: 350px; width: 100%;">
                    <div class="card-body">
                    <h5 class="card-title" style="display: flex; justify-content: center; align-items: center; margin: 0 auto;"><?php echo $item['nama_dessert']; ?></h5>
                    <h5 class="card-title" style="display: flex; justify-content: center; align-items: center; margin: 0 auto;">$<?php echo $item['Harga_dessert']; ?></h5>
                    <hr />
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <input type="hidden" name="item_category" value="dessert">
                        <input type="hidden" name="item_id" value="<?php echo $item['id_dessert']; ?>">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <button class="rounded-button1" type="submit" name="add_to_cart">Add to Cart</button>
                        <?php else: ?>
                            <button class="rounded-button1" type="button" onclick="redirectToLogin()">Add to Cart</button>
                        <?php endif; ?>
                    </form>
                    <br />
                    <button class="toggle-description rounded-buttons">View More</button>
                    <div class="card-content" style="max-height: 0; overflow-y: auto; transition: max-height 0.3s ease-in-out;">
                        <br />
                        <p style="color: black;"><?php echo $item['deskripsi_dessert']; ?></p>
                    </div>
                    </div>
                </div> 
                `;

                dataContainer.appendChild(card);
                <?php endforeach; ?>
                break;
        }
    }

    document.getElementById('makanan').addEventListener('click', () => {
        updateDisplayedData('makanan');
    });

    document.getElementById('minuman').addEventListener('click', () => {
        updateDisplayedData('minuman');
    });

    document.getElementById('cemilan').addEventListener('click', () => {
        updateDisplayedData('cemilan');
    });

    document.getElementById('dessert').addEventListener('click', () => {
        updateDisplayedData('dessert');

    });

    updateDisplayedData('makanan');

    function redirectToLogin() {
        window.location.href = 'login.php';
    }
</script>

<script>
    const toggleButtons = document.querySelectorAll(".toggle-description");

    toggleButtons.forEach((button, index) => {
        const cardContent = button.parentElement.querySelector(".card-content");
        let isOpen = false;
        cardContent.style.maxHeight = "0";

        button.addEventListener("click", () => {
            if (isOpen) {
                cardContent.style.maxHeight = "0"; 
                isOpen = false;
            } else {
                const contentHeight = cardContent.scrollHeight + "px";
                cardContent.style.maxHeight = contentHeight;
                isOpen = true;
            }
        });
    });

    function autoAdvanceCarousel() {
        $('.carousel').carousel('next');
    }

    setInterval(autoAdvanceCarousel, 3000);
</script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>

