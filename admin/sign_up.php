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
        body, html {
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

        /* Left Section (Form Section) */
        .left-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            background-color: white;
            flex-direction: column;
        }

        .create-account-text {
            color: rgba(0, 0, 0, 0.8);
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
            font-size: 38px;
        }

        .input-container {
            position: relative;
            margin-bottom: 20px;
            width: 100%;
        }

        .input-container .icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: grey;
        }
.form-control{
    background-color: #F0F0F0;
}
        .text-input {
            padding-left: 40px;
        }

        .btn-custom {
            background-color: #6f9cde;
            color: white;
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 5px;
            width: 100%;
        }

        .btn-custom:hover {
            background-color: #6879d0;
        }

        /* Right Section (Welcome Section) */
        .right-container {
            flex: 1;
            background: linear-gradient(135deg, #6c5ce7, #8bd3e6);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            border-top-left-radius: 150px;
            border-bottom-left-radius: 150px;
        }

        .right-container h1 {
            font-size: 48px;
            font-weight: 600;
        }

        .right-container p {
            font-size: 20px;
            margin-top: 20px;
        }

        .create-link {
            text-decoration: underline;
            color: white;
        }
    </style>
</head>
<body>
    <?php
    if (isset($_POST['save'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        if ($name == "" || $phone == "" || $email == "" || $password == "") {
            echo "<div class='alert alert-danger'>All fields are required</div>";
            echo "<meta http-equiv=\"refresh\" content=\"2;URL=sign_up.php\">";
        } else {
            $sql = "INSERT INTO users (name, email, phone, password) VALUES ('$name', '$email', '$phone', '$password')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo '<div class="alert alert-success">User added successfully</div>';
                echo "<meta http-equiv=\"refresh\" content=\"2;URL=login_user.php\">";
            } else {
                echo '<div class="alert alert-danger">An error occurred</div>';
            }
        }
    }
    $conn->close();
    ?>
    <div class="main-container">
        <!-- Left Section (Create Account Form) -->
        <div class="left-container">
            <h1 class="create-account-text">Create Account</h1>
            <form method="POST" enctype="multipart/form-data" style="width: 100%; max-width: 400px;">
                <div class="input-container form-group">
                    <i class="fas fa-user icon"></i>
                    <input type="text" name="name" class="form-control text-input" placeholder="Username" required>
                </div>
                <div class="input-container form-group">
                    <i class="fas fa-envelope icon"></i>
                    <input type="email" name="email" class="form-control text-input" placeholder="Email" required>
                </div>
                <div class="input-container form-group">
                    <i class="fas fa-mobile-alt icon"></i>
                    <input type="tel" name="phone" class="form-control text-input" placeholder="Mobile" required>
                </div>
                <div class="input-container form-group">
                    <i class="fas fa-lock icon"></i>
                    <input type="password" name="password" class="form-control text-input" placeholder="Password" required>
                </div>
                <button class="btn btn-custom" name="save" type="submit">
                    Create <i class="fas fa-arrow-right icon"></i>
                </button>
            </form>
        </div>

        <!-- Right Section (Welcome Section) -->
        <div class="right-container">
            <h1>Welcome Back!</h1>
            <p>Already have an account? <a href="login_user.php" class="create-link">Log In</a></p>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
