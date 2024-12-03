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
        select {
        width: 100%;
        padding: 10px;
        font-size: 14px;
        border: 1px solid #ced4da;
        border-radius: 5px;
        background-color: #ffffff;
        color: #34495e;
        appearance: none; /* Removes default dropdown arrow */
        background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg xmlns%3D%22http%3A//www.w3.org/2000/svg%22 viewBox%3D%220 0 4 5%22%3E%3Cpath fill%3D%22%2334495e%22 d%3D%22M2 0L0 2h4z%22/%3E%3C/svg%3E');
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 10px;
    }

    select:focus {
        border-color: #6f9cde;
        outline: none;
        box-shadow: 0 0 5px rgba(111, 156, 222, 0.5);
    }

    option {
        padding: 5px;
        color: #34495e;
        background-color: #ffffff;
    }
</style>
<body class="app">
    <?php require('../includes/navbar.php'); ?>
    <?php require('../includes/sidebar.php'); ?>
    <div class="app-wrapper">

        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <h class="btn app-btn-primary" role="button"> Edit my information </h>
                <hr class="mb-4">
                <div class="row g-4 settings-section">
                    <div class="col-12 col-md-6">
                        <div class="app-card app-card-settings shadow-sm p-4">

                            <div class="app-card-body">
                                <?php

                                if(isset($_GET['id'])){
                                    $id=$_GET['id'];
                                    $select ="SELECT * FROM users WHERE id=$id";
                                    $result=mysqli_query($conn,$select);
                                    $data=mysqli_fetch_assoc($result);
                                }
                                if (isset($_POST['save'])) {
                                    $name = $_POST['name'];
                                    $phone = $_POST['phone'];
                                    $email = $_POST['email'];
                                    

                                    if ($name == "" || $phone == "" ||  $email == "") {
                                        echo "<div class='alert alert-danger'>All fields are required</div>";
                                        // header("Refresh:2;URL=create.php");
                                        echo "<meta http-equiv=\"refresh\" content=\"1;URL=create.php\">";
                                    } else {
                                        $sql = "UPDATE users SET name='$name', phone='$phone',email='$email' WHERE id=$id";
                                        $result = mysqli_query($conn, $sql);
                                        if ($result) {
                                            echo "<script>
                                                    window.onload = function() {
                                                        alert('Information updated successfully.');
                                                        window.location.href = '../dashboard.php'; 
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
                                        <label for="setting-input-1" class="form-label"> Name</label>
                                        <input type="text" name="name" class="form-control" id="setting-input-1" value="<?php echo $data['name'];?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-2" class="form-label">Contact </label>
                                        <input type="text" name="phone" class="form-control" id="setting-input-2" value="<?php echo $data['phone'];?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label"> Email </label>
                                        <input type="email" name="email" class="form-control" id="setting-input-3" value="<?php echo $data['email'];?>">
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