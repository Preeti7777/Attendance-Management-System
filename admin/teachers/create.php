<?php require('../includes/header.php'); ?>

<style>
    /* General Page Styling */
    body {
        background-color: #f4f7fc;
        font-family: Arial, sans-serif;
    }

    .app-wrapper {
        padding: 20px;
    }

    .app-page-title {
        font-size: 24px;
        color: #34495e;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .btn-primary {
        background-color: #6f9cde;
        border: none;
        transition: 0.3s;
    }

    .btn-primary:hover {
        background-color: #5a85c2;
    }

    .btn-sm {
        padding: 5px 10px;
        font-size: 12px;
        border-radius: 5px;
    }

    .app-card {
        background-color: #ffffff;
        border: 1px solid #dee2e6;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .app-card-settings {
        padding: 20px;
    }

    .app-card-body {
        padding: 20px;
    }

    .form-label {
        font-weight: bold;
        color: #34495e;
    }

    .form-control {
        border: 1px solid #ced4da;
        border-radius: 5px;
        padding: 10px;
        font-size: 14px;
        margin-bottom: 15px;
    }

    .form-control:focus {
        border-color: #6f9cde;
        box-shadow: 0 0 5px rgba(111, 156, 222, 0.5);
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

    .alert {
        padding: 10px;
        font-size: 14px;
        margin-bottom: 15px;
        border-radius: 5px;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
</style>

<body class="app">
    <?php require('../includes/navbar.php'); ?>
    <?php require('../includes/sidebar.php'); ?>
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <h1 class="app-page-title">Add Teacher</h1>
                <a class="btn app-btn-primary" href="index.php" role="button"> Manage Teachers </a>
                <hr class="mb-4">
                <div class="row g-4 settings-section">
                    <div class="col-12 col-md-6">
                        <div class="app-card app-card-settings shadow-sm p-4">
                            <div class="app-card-body">
                                <?php
                                if (isset($_POST['save'])) {
                                    $faculty_id = $_POST['faculty_id'];
                                    $name = $_POST['name'];
                                    $phone = $_POST['phone'];
                                    $address = $_POST['address'];
                                    $email = $_POST['email'];

                                    if ($name == "" || $phone == "" || $address == "" || $email == "" || $faculty_id == "") {
                                        echo "<div class='alert alert-danger'>All fields are required</div>";
                                        echo "<meta http-equiv=\"refresh\" content=\"2;URL=create.php\">";
                                    } else {
                                        $sql = "INSERT INTO teachers (faculty_id, name, phone, address, email) VALUES ('$faculty_id', '$name', '$phone', '$address', '$email')";
                                        $result = mysqli_query($conn, $sql);
                                        if ($result) {
                                            echo "<script>
                                                    window.onload = function() {
                                                        alert('Teacher added successfully.');
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
                                        <label for="setting-input-1" class="form-label">Faculty Id</label>
                                        <input type="text" name="faculty_id" class="form-control" id="setting-input-1" value="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-1" class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control" id="setting-input-1" value="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-2" class="form-label">Contact</label>
                                        <input type="text" name="phone" class="form-control" id="setting-input-2" value="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label">Address</label>
                                        <input type="text" name="address" class="form-control" id="setting-input-3" value="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" id="setting-input-3" value="">
                                    </div>

                                    <button type="submit" name="save" class="btn app-btn-primary">Add</button>
                                </form>
                            </div><!--//app-card-body-->
                        </div><!--//app-card-->
                    </div>
                </div><!--//row-->
            </div><!--//container-xl-->
        </div><!--//app-content-->
    </div>
    <?php require('../includes/footer.php'); ?>
</body>
