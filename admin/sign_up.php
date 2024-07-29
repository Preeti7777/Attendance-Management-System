<?php require('../admin/config/config.php'); ?>
                               
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
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
            height: 550px;
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

        .create-account-text {
            color: #007bff;
            font-weight: bold;
        }

        .input-container {
            position: relative;
            margin-bottom: 20px;
        }

        .input-container .icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: grey;
        }

        .text-input {
            padding-left: 40px;
        }

        .sign-in-button {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
        }

        .sign-in-text {
            margin-right: 10px;
        }

        .footer-container .social-media-container a {
            font-size: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #e0e0e0;
            margin: 0 10px;
            color: white;
        }

        .footer-container .social-media-container a:hover {
            text-decoration: none;
        }

        .footer-container .social-media-container a.facebook {
            background-color: #3b5998;
        }

        .footer-container .social-media-container a.google {
            background-color: #db4437;
        }

        .footer-container .social-media-container a.twitter {
            background-color: #1da1f2;
        }
    </style>
</head>
<body>
                                <?php
                                if (isset($_POST['save'])) {
                                    $name = $_POST['name'];
                                    $email = $_POST['email'];
                                    $phone = $_POST['phone'];
                                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT) ;

                                    if ($name == "" || $phone == "" || $email == "" || $password == "") {
                                        echo "<div class='alert alert-danger'>All fields are required</div>";
                                        // header("Refresh:2;URL=create.php");
                                        echo "<meta http-equiv=\"refresh\" content=\"2;URL=sign_up.php\">";
                                    } else {
                                        $sql = "INSERT INTO users (name, email, phone, password) VALUES ('$name', '$email', '$phone', '$password')";
                                        $result = mysqli_query($conn, $sql);
                                        if ($result) {
                                            echo '<div class="alert alert-success">User added successfully</div>';
                                            // header("Location: index.php");
                                            echo "<meta http-equiv=\"refresh\" content=\"2;URL=login_user.php\">";
                                        } else {
                                            echo '<div class="alert alert-danger">An error occurred</div>';
                                        }
                                    }
                                }
                                $conn->close();

                                ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card p-4">
                    <h1 class="create-account-text text-center mb-4">Create Account</h1>
                    <form class="settings-form" method="POST" enctype="multipart/form-data">
                    <div class="input-container form-group">
                        <i class="fas fa-user icon"></i>
                        <input type="text" name="name" class="form-control text-input" placeholder="Username" >
                    </div>
                    <div class="input-container form-group">
                        <i class="fas fa-envelope icon"></i>
                        <input type="email" name="email" class="form-control text-input" placeholder="Email" >
                    </div>
                    <div class="input-container form-group">
                        <i class="fas fa-mobile-alt icon"></i>
                        <input type="tel" name="phone" class="form-control text-input" placeholder="Mobile" >
                    </div>
                    <div class="input-container form-group">
                        <i class="fas fa-lock icon"></i>
                        <input type="password" name="password" class="form-control text-input" placeholder="Password" >
                    </div>
                    <button class="btn btn-primary btn-block sign-in-button" name="save" type="submit">
                        <span class="sign-in-text">Create</span>
                        <i class="fas fa-arrow-right icon"></i>
                    </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function handleSignIn() {
            window.location.href = 'login_user.php';
        }
    </script>
</body>
</html>