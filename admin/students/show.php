<?php require('../includes/header.php'); ?>

<body class="app">
    <?php require('../includes/navbar.php'); ?>
    <?php require('../includes/sidebar.php'); ?>
    <div class="app-wrapper">

        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <h1 class="app-page-title">Students</h1>
                <a class="btn btn-primary btn-sm text-white" href="index.php" role="button"> Manage Students </a>
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
                                </form>
                            </div><!--//app-card-body-->

                        </div><!--//app-card-->
                    </div>
                </div><!--//row-->
            </div><!--//container-fluid-->
        </div><!--//app-content-->

        <?php require('../includes/footer.php'); ?>