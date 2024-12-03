<?php require('../admin/config/config.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            font-family: Arial, sans-serif;
        }

        .main-container {
            display: flex;
            height: 100%;
            width: 100%;
        }

        /* Left Section */
        .left-container {
            flex: 1;
            background: linear-gradient(135deg, #6c5ce7, #8bd3e6);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            border-top-right-radius: 150px;
            /* Top-right rounded corner */
            border-bottom-right-radius: 150px;
            /* Bottom-right rounded corner */
        }

        .left-container h1 {
            font-size: 48px;
            font-weight: 600;
        }

        .left-container p {
            font-size: 20px;
            margin-top: 20px;
        }

        .create-link {
            text-decoration: underline;
            color: white;
        }

        /* Right Section */
        .right-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            background-color: white;
            flex-direction: column;
        }

        .atten-text {
            font-size: 45px;
            font-weight: 700;
            color: rgba(0, 0, 0, 0.8);
            margin-bottom: 40px;
            text-align: center;
        }

        .sign-in-text {
            font-size: 20px;
            margin-bottom: 40px;
            text-align: center;
        }

        .input-group-text {
            border-radius: 20px 0 0 20px;
        }

        .form-control {
            border-radius: 0 20px 20px 0;
            background-color: #F0F0F0;
        }

        .btn-custom {
            background-color: #6f9cde;
            color: white;
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 5px;
            width: 100%;
            transition: 0.3s;
        }

        .btn-custom:hover {
            background-color: #6879d0;
            color: white;
        }
    </style>
</head>

<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row["password"])) {
                // Start a session and store user data
                session_start();
                $_SESSION["id"] = $row["id"];
                $_SESSION["email"] = $row["email"];

                // Redirect to dashboard.php
                $id = urlencode($row["id"]);
                header("Location: dashboard.php?id=$id");
                exit();
            } else {
                echo "<script>
                window.onload = function() {
                    alert('Invalid Password.');
                };
            </script>";
            }
        } else {
            echo "<script>
                window.onload = function() {
                    alert('User not found.');
                };
            </script>";
        }
    }
    $conn->close();
    ?>
    <div class="main-container">
        <!-- Left Section -->
        <div class="left-container">
            <h1>Hello, Welcome!</h1>
            <p>Don't have an account? <a href="sign_up.php" class="create-link">Create one</a></p>
        </div>

        <!-- Right Section -->
        <div class="right-container">

            <h2 class="atten-text">Admin Login</h2>
            <p class="sign-in-text">Log in to your account</p>
            <form class="settings-form" method="POST" enctype="multipart/form-data" style="width: 100%; max-width: 400px;">
                <div class="input-container form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                        </div>
                        <input type="text" name="email" class="form-control" placeholder="Email" required>
                    </div>
                </div>
                <div class="input-container form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                        </div>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                </div>
                <button class="btn btn-custom btn-block my-3" name="save">
                    Log In <i class="fa fa-arrow-right ml-2"></i>
                </button>
                <!-- <p>Forgot your password? <a href="forgot_password.php">Click here</a></p> -->
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>