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
                <h1 class="app-page-title">Course</h1>
                <a class="btn btn-primary btn-sm text-white" href="index.php" role="button"> Manage Course </a>
                <hr class="mb-4">
                <div class="row g-4 settings-section">
                    <div class="col-12 col-md-6">
                        <div class="app-card app-card-settings shadow-sm p-4">

                            <div class="app-card-body">
                                <?php

                                if(isset($_GET['id'])){
                                    $id=$_GET['id'];
                                    $select ="SELECT * FROM courses WHERE id=$id";
                                    $result=mysqli_query($conn,$select);
                                    $data=mysqli_fetch_assoc($result);
                                }
                                $conn->close();

                                ?>

                                <form class="settings-form" method="POST" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="setting-input-1" class="form-label"> Name</label>
                                        <input type="text" name="name" class="form-control" id="setting-input-1" value="<?php echo $data['name'];?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-2" class="form-label">Teacher </label>
                                        <input type="text" name="teacher" class="form-control" id="setting-input-2" value="<?php echo $data['teacher'];?>">
                                    </div>
                                </form>
                            </div><!--//app-card-body-->

                        </div><!--//app-card-->
                    </div>
                </div><!--//row-->
            </div><!--//container-fluid-->
        </div><!--//app-content-->

        <?php require('../includes/footer.php'); ?>