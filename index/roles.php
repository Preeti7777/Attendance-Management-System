<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Management System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(to right, #6EB5FF, #F0F8FF);
        }

        /* Header Styles */
        .header {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: white;
            z-index: 10;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .logo {
            width: 150px;
        }

        .nav-link {
            font-size: 18px;
            color: #333;
            text-decoration: none;
            padding: 8px 15px;
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -2px;
            width: 0;
            height: 2px;
            background-color: #6EB5FF;
            transition: width 0.3s;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* .nav-link.active {
            background-color: #6EB5FF;
            color: white;
        } */

        .main-container {
            display: flex;
            height: 100vh;
            margin-top: 20px;
        }

        .image-side {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #image-side img {
            width: 550px;
            height: 550px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.5s ease;
        }

        #image-side img:hover {
            transform: scale(1.05);
        }

        .content-side {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .atten-text {
            font-size: 60px;
            color: #333;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
        }

        .description {
            font-size: 20px;
            color: #6f9cde;
            margin-bottom: 30px;
        }

        .button {
            width: 150px;
            height: 150px;
            margin: 10px;
            border: none;
            border-radius: 25px;
            color: white;
            font-size: 20px;
            cursor: pointer;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .button i {
            margin-right: 8px;
        }

        .admin {
            background: linear-gradient(145deg, #6c5ce7, #8bd3e6);
        }

        .faculty {
            background: linear-gradient(145deg, #008b8b, #8cdabf);

        }

        .student {
            background: linear-gradient(145deg, #B1A2CA, #9581b0);
        }

        .button:hover {
            transform: scale(1.1);
        }

        .admin:hover {
            background-color: #6AB3C8;
        }

        .faculty:hover {
            background-color: #008b8b;
        }

        .student:hover {
            background-color: #8F7AB5;
        }
        .choose-role {
    font-size: 25px; 
    font-weight: 200;
    color: #ed7014;
    margin-bottom: 20px;
    text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.2);
}
/* Footer Styles */
.footer {
    background: linear-gradient(to right, #6EB5FF, #F0F8FF);
    color: #333;
    padding: 40px 0;
    font-family: 'Roboto', sans-serif;
    box-shadow: 0 -4px 8px rgba(0, 0, 0, 0.1);
}

.footer h5 {
    font-size: 26px;
    font-weight: bold;
    margin-bottom: 15px;
    color: #333;
    text-align: center;
}

.footer p {
    font-size: 15px;
    line-height: 1.6;
    color: #555;
}

.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
    text-align: center;
}

.footer-links li {
    margin-bottom: 8px;
}

.footer-links a {
    text-decoration: none;
    font-size: 15px;
    color: #555;
    transition: color 0.3s ease;
}

.footer-links a:hover {
    color: #333;
    text-decoration: underline;
}

.social-icons {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 10px;
}

.social-icons a {
    color: #555;
    font-size: 24px;
    transition: color 0.3s ease, transform 0.3s ease;
}

.social-icons a:hover {
    color: #333;
    transform: scale(1.1);
}

.footer-divider {
    border-color: rgba(0, 0, 0, 0.1);
    margin: 20px 0;
}

.small-text {
    font-size: 19px;
    color: #777;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .footer-section {
        text-align: center;
        margin-bottom: 20px;
    }

    .social-icons {
        justify-content: center;
    }
}

        @media (max-width: 768px) {
            #image-side img {
                width: 300px;
                height: 300px;
            }

            .button {
                width: 100px;
                height: 100px;
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <!-- Header with logo and navbar -->
    <!-- <div class="header">
        <a href="roles.php" class="nav-link active">
            <img src="../admin/Images/logo.png" alt="Logo" class="logo">
        </a>
    </div> -->

    <!-- Main container with image and content -->
    <div class="container-fluid main-container">
        <div class="image-side col-md-6" id="image-side">
            <img src="../admin/Images/attendance Management System.png" alt="Attendance System Image">
        </div>
        
        <div class="content-side col-md-6" id="content-side">
            <div>
                <h1 class="atten-text">Attendance Management System</h1>
                <p class="description" id="typewriter"></p>
                <p class="choose-role">Choose your role to proceed:</p>
                <div class="d-flex justify-content-center">
                    <button class="button admin" onclick="selectRole('admin')" title="Log in as Admin"><i class="fa-solid fa-user-tie"></i> Admin</button>
                    <button class="button faculty" onclick="selectRole('faculty')" title="Log in as Faculty"><i class="fa-solid fa-chalkboard-user"></i> Faculty</button>
                    <button class="button student" onclick="selectRole('student')" title="Log in as Student"><i class="fa-solid fa-user-graduate"></i> Student</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script>
        // The text that will appear letter by letter
const text = "Streamline attendance tracking for students, faculty, and administrators!";

// Index to keep track of which character to display next
let index = 0;

// Function to handle the typewriter effect
function typewriterEffect() {
    // Check if there are still characters left to display
    if (index < text.length) {
        // Add the next character from `text` to the paragraph with ID "typewriter"
        document.getElementById("typewriter").textContent += text.charAt(index);

        // Move to the next character
        index++;

        // Call the function again after 50 milliseconds to create the typing effect
        setTimeout(typewriterEffect, 50);
    }
}

// Start the typewriter effect when the page loads
typewriterEffect();

        function selectRole(role) {
            switch (role) {
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
    <!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <!-- About Section -->
            <div class="col-md-4 col-sm-12 footer-section">
                <h5>About Us</h5>
                <p>
                    Attendance Management System offers seamless solutions for tracking and managing attendance for students, faculty, and administrators.
                </p>
            </div>
            <!-- Quick Links Section -->
            <div class="col-md-4 col-sm-12 footer-section">
                <h5>Quick Links</h5>
                <ul class="footer-links">
                    <li><a href="roles.php">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Help</a></li>
                </ul>
            </div>
            <!-- Social Media Section -->
            <div class="col-md-4 col-sm-12 footer-section text-center">
                <h5>Follow Us</h5>
                <div class="social-icons mt-3">
                    <a href="#" title="Facebook"><i class="fab fa-facebook"></i></a>
                    <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
        </div>
        <hr class="footer-divider">
        <div class="text-center small-text">
            &copy; 2024 Attendance Management System. All rights reserved.
        </div>
    </div>
</footer>

</body>
</html>
