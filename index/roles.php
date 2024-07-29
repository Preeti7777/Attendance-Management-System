<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Management System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: aliceblue;
        }
        .main-container {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }
        .image-side {
            flex: 1;
            background-image: url("/Images/Attendance-Management-System-2.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            transform: translateX(-100%);
            transition: transform 1s ease-in-out; /* Smooth transition */
        }
        .content-side {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: aliceblue; 
            perspective: 1000px; /* For 3D effect */
        }
        .atten-text {
            font-size: 50px;
            font-weight: bolder;
            color: rgba(0, 0, 0, 0.681);
            margin-top: 30px;
        }
        .sign-in-text {
            font-size: 33px;
            margin-top: 50px;
            color: #6EB5FF;
        }
        .button {
            width: 150px; /* Set width and height to be the same to make the button square */
            height: 150px;
            margin: 10px;
            border: none;
            border-radius: 10px; /* Border radius for rounded corners */
            color: white;
            font-size: 20px; /* Adjust font size to fit the button */
            cursor: pointer;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .admin {
            background-color: #8BD3E6;
        }
        .faculty {
            background-color: #FF6D6A;
        }
        .student {
            background-color: #B1A2CA;
        }
    </style>
</head>
<body>
    <div class="container-fluid main-container">
        <div class="image-side col-md-6"></div>
        <div class="content-side col-md-6">
            <div class="atten-container text-center">
                <h1 class="atten-text">Attendance Management System</h1>
                <p class="sign-in-text">Select your role to sign in</p>
                <div class="d-flex justify-content-center">
                    <button class="button admin btn" onclick="selectRole('admin')">Admin</button>
                    <button class="button faculty btn" onclick="selectRole('faculty')">Faculty</button>
                    <button class="button student btn" onclick="selectRole('student')">Student</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.onload = function() {
            setTimeout(function() {
                document.querySelector('.image-side').style.transform = 'translateX(0)';
            }, 100); // slight delay 
        };

        function selectRole(role) {
            switch(role) {
                case 'admin':
                    window.location.href = '../admin/login_user.php';
                    break;
                case 'faculty':
                    window.location.href = '../admin/login_teach.php';
                    break;
                case 'student':
                    window.location.href = '../admin/login_std.php';
                    break;
                default:
                    alert('Invalid role selected');
            }
        }
    </script>
</body>
</html>