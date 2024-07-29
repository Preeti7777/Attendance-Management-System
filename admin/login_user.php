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
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #8BD3E6;
            overflow-x: hidden;
        }

        .card {
            background-color: #F5F5F5;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            opacity: 0;
            transform: translateY(-150px);
            animation: slideIn 1s ease-out forwards;
        }
        @keyframes slideIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .atten-text {
            font-size: 38px;
            font-weight: 500;
            color: rgba(0, 0, 0, 0.773);
        }

        .sign-in-text {
            font-size: 15px;
            margin-bottom: 30px;
            color: blue;
        }

        .input-group-text {
            border-radius: 20px 0 0 20px;
        }

        .form-control {
            border-radius: 0 20px 20px 0;
            background-color: #F0F0F0;
        }

        .forgot-password-text {
            color: #707070;
        }

        .btn-custom {
            background-color: #8BD3E6;
            color: white;
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 5px;
            width: 400px;
            margin-right: 15px;
            margin-left: 5px;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }

        .footer-text {
            font-size: 17px;
            margin-top: 60px;
        }

        .create-link {
            text-decoration: underline;
            color: blue;
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
                header("Location:dashboard.php");
                exit();
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "User not found.";
        }
    }
    $conn->close();
    ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card">
                    <div class="text-center mb-4">
                        <h1 class="atten-text">Attendance Management System</h1>
                        <h1 class="atten-text">Admin</h1>
                    </div>
                    <p class="text-center sign-in-text">Log in to your account</p>
                    <form class="settings-form" method="POST" enctype="multipart/form-data">
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
                    <button class="btn btn-custom btn-block my-3" name="save"">
                        Log In <i class="fa fa-arrow-right ml-2"></i>
                    </button>
                    </form>
                    <p class="text-center footer-text">
                        Don't have an account? <a href="sign_up.php" class="create-link">Create.</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
