<?php require('../includes/header.php'); ?>

<style>
    /* Page Title */
    .app-page-title {
        font-size: 1.8rem;
        font-weight: 600;
        margin-bottom: 20px;
        color: #6f9cde;
    }

    /* Button Styles */
    .btn-sm {
        font-size: 14px;
        padding: 8px 16px;
        border-radius: 5px;
    }

    .btn-primary {
        background-color: #6f9cde;
        border: none;
        transition: 0.3s;
    }

    .btn-primary:hover {
        background-color: #5a85c2;
    }

    /* Form Container */
    .app-card {
        border: 1px solid #dee2e6;
        border-radius: 10px;
        background-color: #ffffff;
    }

    /* Form Labels */
    .form-label {
        font-weight: 500;
        color: #495057;
    }

    /* Form Inputs */
    .form-control {
        border-radius: 5px;
        padding: 10px 12px;
        border: 1px solid #ced4da;
    }

    .form-control:focus {
        border-color: #6f9cde;
        box-shadow: 0 0 4px rgba(111, 156, 222, 0.5);
    }

    /* Alert Messages */
    .alert {
        padding: 10px 15px;
        border-radius: 5px;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    /* Page Layout */
    body {
        background-color: #f4f7fc;
    }

    .app-content {
        background: #ffffff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .app-card {
            padding: 20px;
        }
    }
    .btn.app-btn-primary {
        background-color: #6f9cde;
        color: #ffffff;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        font-size: 14px;
        transition: background-color 0.3s ease;
    }

    .btn.app-btn-primary:hover {
        background-color: #5a85c2;
    }
</style>

<body class="app">
    <?php require('../includes/navbar.php'); ?>
    <?php require('../includes/sidebar.php'); ?>
    <div class="app-wrapper">

        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <h1 class="app-page-title">Add Students</h1>
                <a class="btn app-btn-primary" href="index.php" role="button">Manage Students</a>
                <hr class="mb-4">

                <div class="row g-4 settings-section">
                    <div class="col-12 col-md-6">
                        <div class="app-card app-card-settings shadow-sm p-4">
                            <div class="app-card-body">
                                <?php
                                if (isset($_POST['save'])) {
                                    $reg_id = $_POST['reg_id'];
                                    $name = $_POST['name'];
                                    $phone = $_POST['phone'];
                                    $address = $_POST['address'];
                                    $email = $_POST['email'];
                                    $faculty = $_POST['faculty'];
                                    $batch = $_POST['batch'];
                                    $parent_name = $_POST['parent_name'];
                                    $parent_phone = $_POST['parent_phone'];

                                    if ($name == "" || $phone == "" || $address == "" || $email == "" || $reg_id == "" || $parent_name == "" || $parent_phone == "" || $faculty == "" || $batch == "") {
                                        echo "<div class='alert alert-danger'>All fields are required</div>";
                                        echo "<meta http-equiv=\"refresh\" content=\"2;URL=create.php\">";
                                    } else {
                                        $sql = "INSERT INTO students (reg_id, name, phone, address, email, faculty, batch, parent_name, parent_phone) VALUES ('$reg_id', '$name', '$phone', '$address', '$email', '$faculty', '$batch', '$parent_name', '$parent_phone')";
                                        $result = mysqli_query($conn, $sql);
                                        if ($result) {
                                            echo "<script>
                                                    window.onload = function() {
                                                        alert('Student added successfully.');
                                                        window.location.href = 'index.php'; // Redirects to index.php after alert
                                                    };
                                                </script>";
                                        } else {
                                            echo '<div class="alert alert-danger">An error occurred</div>';
                                        }
                                    }
                                }
                                $conn->close();
                                ?>

                                <form class="settings-form" method="POST" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="reg_id" class="form-label">Registration Id</label>
                                        <input type="text" name="reg_id" class="form-control" id="reg_id" value="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control" id="name" value="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Contact</label>
                                        <input type="text" name="phone" class="form-control" id="phone" value="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" name="address" class="form-control" id="address" value="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" id="email" value="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="faculty" class="form-label">Faculty</label>
                                        <input type="text" name="faculty" class="form-control" id="faculty" value="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="batch" class="form-label">Batch</label>
                                        <input type="text" name="batch" class="form-control" id="batch" value="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="parent_name" class="form-label">Parent Name</label>
                                        <input type="text" name="parent_name" class="form-control" id="parent_name" value="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="parent_phone" class="form-label">Parent Contact</label>
                                        <input type="text" name="parent_phone" class="form-control" id="parent_phone" value="">
                                    </div>
                                    <button type="submit" name="save" class="btn app-btn-primary">Add</button>
                                </form>
                            </div><!--//app-card-body-->
                        </div><!--//app-card-->
                    </div>
                </div><!--//row-->
            </div><!--//container-fluid-->
        </div><!--//app-content-->

        <?php require('../includes/footer.php'); ?>
    </div>
</body>
