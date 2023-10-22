<?php
    session_start();
    include 'koneksi.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $submittedCaptcha = $_POST['captcha'];
        $realCaptcha = $_POST['initial_captcha'];

        if ($submittedCaptcha !== $realCaptcha) {
            echo "<script>";
            echo "alert('Invalid CAPTCHA. Please try again.');";
            echo "</script>";
            $submittedCaptcha = "";
            $realCaptcha = "";
        } else {
            $login_sql = "SELECT id_user, username, password, role FROM userdata WHERE username = ?";
            $stmt = $conn->prepare($login_sql);

            if ($stmt) {
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    $stmt->bind_result($user_id, $db_username, $db_password, $user_role);
                    $stmt->fetch();

                    if (password_verify($password, $db_password)) {
                        $_SESSION['user_id'] = $user_id;
                        $_SESSION['username'] = $db_username;
                        $_SESSION['role'] = $user_role;
                        if ($user_role === 'customer') {
                            header("Location: index.php");
                        } elseif ($user_role === 'admin') {
                            header("Location: admin.php");
                        } else {
                            echo "Invalid role.";
                        }
                    } else {
                        echo "Invalid password or username.";
                    }
                } else {
                    echo "Invalid password or username.";
                }

                $stmt->close();
            } else {
                echo "Error: " . $conn->error;
            }
        }
    }

    $conn->close();
    ?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - OffCourse</title>
    <link rel="stylesheet" type="text/css" href="loginstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="path-to-sweetalert/sweetalert2.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }

        h2 {
            margin: 0;
        }
    </style>
</head>
<body style="background-color: #F2E6D3;">
    <div class="card custom-card">
        <h2>Login</h2>
        <br />
        <form id="login-form" action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" required><br><br>

            <label for="password">Password:</label>
            <input type="password" name= "password" required><br><br>

            <div class="captcha">
                <label for="captcha-input">Enter Captcha</label>
                <div class="preview"></div>
                <div class="captcha-form">
                    <input type="text" name="captcha" id="captcha-form" placeholder="Enter Captcha">
                    <input type="hidden" name="initial_captcha" id="initial-captcha">
                </div>
            </div><br />

            <input type="submit" value="Log In" class="login rounded-buttons">
        </form>
        <br />
        <a href="signup.php">Don't have an account? Click to Sign Up Now!</a>
    </div>

    <script>
        (function() {
            const fonts = ["cursive", "sans-serif", "serif", "monospace"];
            let captchaValue = "";

            function generateCaptcha() {
                let value = btoa(Math.random() * 1000000000);
                value = value.substr(0, 5 + Math.random() * 5);
                captchaValue = value;
            }

            function setCaptcha() {
                const html = captchaValue.split("").map((char) => {
                    const rotate = -20 + Math.trunc(Math.random() * 30);
                    const font = Math.trunc(Math.random() * fonts.length);
                    return `<span style="transform: rotate(${rotate}deg); font-family: ${fonts[font]}">${char}</span>`;
                }).join("");
                document.querySelector(".captcha .preview").innerHTML = html;

                document.querySelector("#initial-captcha").value = captchaValue;
                console.log(captchaValue);
            }

            function initCaptcha() {
                generateCaptcha();
                setCaptcha();
            }

            initCaptcha();

            document.querySelector(".login").addEventListener("click", function() {
                let inputCaptchaValue = document.querySelector(".captcha-form .captcha-input").value;
                if (inputCaptchaValue === captchaValue) {
                } else {
                    swal("Invalid Captcha");
                    return false;
                }
            });
        })();
    </script>
</body>
</html>
