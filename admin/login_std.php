<?php require('../admin/config/config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
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

        /* Left Section */
        .left-container {
            flex: 1;
            background: linear-gradient(to right, #8F7AB5, #B8A0D1, #D6C8E1);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            border-top-right-radius: 150px;
            border-bottom-right-radius: 150px;
        }
        .left-container h1 {
            font-size: 48px;
            font-weight: 600;
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
            font-size: 48px;
            font-weight: 600;
            color: rgba(0, 0, 0, 0.773);
            margin-bottom: 40px;
            text-align: center;
        }
        .sign-in-text {
            font-size: 20px;
            margin-bottom: 30px;
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
            background: #AD9DC8;
            color: white;
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 5px;
            width: 100%;
            transition: 0.3s;
        }
        .btn-custom:hover {
            background-color: #8F7AB5;
            color: white;
        }

        .footer-text {
            font-size: 17px;
            margin-top: 60px;
            text-align: center;
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
        $reg_id = $_POST["reg_id"];
    
        $sql = "SELECT * FROM students WHERE email = '$email'";
        $result = $conn->query($sql);
    
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if ($reg_id == $row["reg_id"]) {
                // Start a session and store user data
                session_start();
                $_SESSION["id"] = $row["id"];
                $_SESSION["email"] = $row["email"];
                
                $id = urlencode($row["id"]);
                header("Location: studentdb/profile.php?id=$id");
                exit();
            } else {
                echo "<script>
                window.onload = function() {
                    alert('Invalid Registration Id');
                };
            </script>";
            }
        } else {
            echo "<script>
                window.onload = function() {
                    alert('Student not found.');
                };
            </script>";
        }
        
    }
    $conn->close();
?>

<div class="main-container">
    <!-- Left Section -->
    <div class="left-container">
        <h1>Welcome, Student!</h1>
    </div>

    <!-- Right Section -->
    <div class="right-container">
        <h2 class="atten-text">Student Login</h2>
        <p class="sign-in-text">Log in to your account</p>
        <form method="POST" enctype="multipart/form-data" style="width: 100%; max-width: 400px;">
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
                    <input type="password" name="reg_id" class="form-control" placeholder="Registration ID" required>
                </div>
            </div>
            <button class="btn btn-custom btn-block my-3" name="save">
                Log In <i class="fa fa-arrow-right ml-2"></i>
            </button>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
