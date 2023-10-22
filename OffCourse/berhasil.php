<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-color: #F2E6D3;
        }

        .container {
            margin-top: 170px;
        }

        .btn {
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

        .btn:hover {
            background-color: #0056b3;
        }

        .jumbotron {
            background-color: #FFCC80;
            color: black;
            border: none;
            border-radius: 20px;
            padding: 20px 20px;
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
            box-shadow: 5px 5px 10px grey;
            font-family: 'Tenor Sans', sans-serif;
            margin-top: 400px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="jumbotron text-center">
            <h1 class="display-4">Checkout Successful!</h1>
            <p class="lead">Thank you for your order.</p>
            <a href="index.php" class="btn btn-primary">Back to Homepage</a>
        </div>
    </div>
</body>
</html>
