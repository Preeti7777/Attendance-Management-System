<?php require('../includes/header.php'); ?>
<style>
    /* General Page Styling */
    .app-content {
        background-color: #f8f9fa;
        padding-top: 30px;
    }

    .app-page-title {
        color: #333;
        font-size: 28px;
        font-weight: 600;
    }

    .btn-primary {
        background-color: #6f9cde;
        border-color: #6f9cde;
        transition: 0.3s;
    }

    .btn-primary:hover {
        background-color: #6879d0;
        border-color: #6879d0;
    }

    .settings-section {
        margin-top: 30px;
    }

    .app-card-settings {
        border-radius: 10px;
        background-color: #ffffff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .app-card-body {
        padding: 20px;
    }

    .form-label {
        font-size: 14px;
        font-weight: 600;
        color: #333;
    }

    .form-control {
        height: 40px;
        padding: 10px;
        font-size: 14px;
        border: 1px solid #ced4da;
        border-radius: 5px;
        transition: 0.3s;
    }

    .form-control:focus {
        border-color: #6f9cde;
        box-shadow: 0 0 5px rgba(111, 156, 222, 0.5);
        outline: none;
    }

    .btn {
        padding: 10px 20px;
        font-size: 14px;
        border-radius: 5px;
    }

    .alert {
        font-size: 14px;
        margin-bottom: 20px;
        padding: 10px;
        border-radius: 5px;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
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
                <a class="btn app-btn-primary" href="index.php" role="button"> Manage Students </a>
                <hr class="mb-4">
                <div class="row g-4 settings-section">
                    <div class="col-12 col-md-6">
                        <div class="app-card app-card-settings shadow-sm p-4">

                            <div class="app-card-body">
                                <?php

                                if(isset($_GET['id'])){
                                    $id=$_GET['id'];
                                    $select ="SELECT * FROM students WHERE id=$id";
                                    $result=mysqli_query($conn,$select);
                                    $data=mysqli_fetch_assoc($result);
                                }
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

                                    if ($name == "" || $phone == "" || $address == "" || $email == "" || $reg_id == "" || $parent_name == "" || $parent_phone == "" || $faculty =="" || $batch =="") {
                                        echo "<div class='alert alert-danger'>All fields are required</div>";
                                        // header("Refresh:2;URL=create.php");
                                        echo "<meta http-equiv=\"refresh\" content=\"1;URL=create.php\">";
                                    } else {
                                        $sql = "UPDATE students SET reg_id='$reg_id', name='$name', phone='$phone', address='$address', email='$email', faculty='$faculty',batch='$batch',parent_name='$parent_name',parent_phone='$parent_phone' WHERE id=$id";
                                        $result = mysqli_query($conn, $sql);
                                        if ($result) {
                                            echo "<script>
                                                    window.onload = function() {
                                                        alert('Student updated successfully.');
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
                                        <label for="setting-input-1" class="form-label"> Registration Id</label>
                                        <input type="text" name="reg_id" class="form-control" id="setting-input-1" value="<?php echo $data['reg_id'];?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-1" class="form-label"> Name</label>
                                        <input type="text" name="name" class="form-control" id="setting-input-1" value="<?php echo $data['name'];?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-2" class="form-label">Contact </label>
                                        <input type="text" name="phone" class="form-control" id="setting-input-2" value="<?php echo $data['phone'];?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label"> Address</label>
                                        <input type="text" name="address" class="form-control" id="setting-input-3" value="<?php echo $data['address'];?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label"> Email </label>
                                        <input type="email" name="email" class="form-control" id="setting-input-3" value="<?php echo $data['email'];?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-1" class="form-label">Faculty</label>
                                        <input type="text" name="faculty" class="form-control" id="setting-input-1" value="<?php echo $data['faculty'];?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-1" class="form-label">Batch</label>
                                        <input type="text" name="batch" class="form-control" id="setting-input-1" value="<?php echo $data['batch'];?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-1" class="form-label"> Parent Name</label>
                                        <input type="text" name="parent_name" class="form-control" id="setting-input-1" value="<?php echo $data['parent_name'];?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-1" class="form-label">Parent Contact</label>
                                        <input type="text" name="parent_phone" class="form-control" id="setting-input-1" value="<?php echo $data['parent_phone'];?>">
                                    </div>
                                    <button type="submit" name="save" class="btn app-btn-primary">Save Changes</button>
                                </form>
                            </div><!--//app-card-body-->

                        </div><!--//app-card-->
                    </div>
                </div><!--//row-->
            </div><!--//container-fluid-->
        </div><!--//app-content-->

        <?php require('../includes/footer.php'); ?>