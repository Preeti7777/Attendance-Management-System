<?php require('../includes/header.php'); ?>

<body class="app">
    <?php require('../includes/navbar.php'); ?>
    <?php require('../includes/sidebar.php'); ?>
    <div class="app-wrapper">

        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <h1 class="app-page-title">Add Students</h1>
                <a class="btn btn-primary btn-sm text-white" href="index.php" role="button"> Manage Students </a>
                <hr class="mb-4">
                <div class="row g-4 settings-section">
                    <div class="col-12 col-md-6">
                        <div class="app-card app-card-settings shadow-sm p-4">

                            <div class="app-card-body">
                                <?php

                                if(isset($_GET['id'])){
                                    $id=$_GET['id'];
                                    $select ="SELECT * FROM teachers WHERE id=$id";
                                    $result=mysqli_query($conn,$select);
                                    $data=mysqli_fetch_assoc($result);
                                }
                                if (isset($_POST['save'])) {
                                    $faculty_id = $_POST['faculty_id'];
                                    $name = $_POST['name'];
                                    $phone = $_POST['phone'];
                                    $address = $_POST['address'];
                                    $email = $_POST['email'];

                                    if ($name == "" || $phone == "" || $address == "" || $email == "" || $faculty_id == "" ) {
                                        echo "<div class='alert alert-danger'>All fields are required</div>";
                                        // header("Refresh:2;URL=create.php");
                                        echo "<meta http-equiv=\"refresh\" content=\"1;URL=create.php\">";
                                    } else {
                                        $sql = "UPDATE teachers SET faculty_id='$faculty_id', name='$name', phone='$phone', address='$address', email='$email' WHERE id=$id";
                                        $result = mysqli_query($conn, $sql);
                                        if ($result) {
                                            echo '<div class="alert alert-success">Teachers Updated successfully</div>';
                                            // header("Location: index.php");
                                            echo "<meta http-equiv=\"refresh\" content=\"2;URL=index.php\">";
                                        } else {
                                            echo '<div class="alert alert-danger">An error occurred</div>';
                                        }
                                    }
                                }
                                $conn->close();

                                ?>

                                <form class="settings-form" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                        <label for="setting-input-1" class="form-label"> Faculty Id</label>
                                        <input type="text" name="faculty_id" class="form-control" id="setting-input-1" value="<?php echo $data['faculty_id'];?>">
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
                                    <button type="submit" name="save" class="btn app-btn-primary">Save Changes</button>
                                </form>
                            </div><!--//app-card-body-->

                        </div><!--//app-card-->
                    </div>
                </div><!--//row-->
            </div><!--//container-fluid-->
        </div><!--//app-content-->

        <?php require('../includes/footer.php'); ?>