<!DOCTYPE html>
<html>
<head>
    <title>Sign Up - OffCourse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card custom-card" style="margin-top:50px;">
                    <div class="card-body">
                        <h2 class="card-title text-center">Sign Up</h2>
                        <form action="prosesSignup.php" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username:</label>
                                <input type="text" class="form-control" name="username" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>

                            <div class="mb-3">
                                <label for="nama_depan" class="form-label">First Name:</label>
                                <input type="text" class="form-control" name="nama_depan" required>
                            </div>

                            <div class="mb-3">
                                <label for="nama_belakang" class="form-label">Last Name:</label>
                                <input type="text" class="form-control" name="nama_belakang">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Gender:</label><br>
                                <input type="radio" name="gender" value="M" required> Male
                                <input type="radio" name="gender" value="F" required> Female
                            </div>

                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Date of Birth:</label>
                                <input type="date" class="form-control" name="tanggal_lahir">
                            </div>

                            <div class="mb-3">
                                <label for="role" class="form-label">Role:</label>
                                <select class="form-select" name="role" required>
                                    <option value="customer">Customer</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto:</label>
                                <input type="file" class="form-control-file" id="foto" name="foto" accept="image/*">
                            </div>

                            <input type="submit" class="btn btn-primary rounded-buttons" value="Sign Up">
                            <br />
                            <div class="mb-3 text-center">
                                <a href="login.php">Already have an account? Click to Log in Now!</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Rn538yOtIW6c50b58ZJCmx3F/b0K07avh5mNOnF5V9+iuBf0zpm4v4sz2Zghz6L2d" crossorigin="anonymous"></script>
</body>
</html>
