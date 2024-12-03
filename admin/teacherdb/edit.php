<?php require('../teacherdb/includes/header.php'); ?>

<body class="app">
	<?php require('../teacherdb/includes/navbar.php'); ?>
	<?php require('../teacherdb/includes/sidebar.php'); ?>
    <div class="app-wrapper">

        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <h class="btn btn-primary btn-sm text-white" style="
									background-color: #6c757d; 
									color: #fff; 
									padding: 8px 12px; 
									border: none; 
									border-radius: 4px; 
									text-decoration: none; 
									font-size: 14px; 
									transition: background-color 0.3s ease, transform 0.2s ease; 
									display: inline-block;" role="button"> Edit my information </h>
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
                                        echo "<meta http-equiv=\"refresh\" content=\"1;URL=profile.php\">";
                                    } else {
                                        $sql = "UPDATE teachers SET faculty_id='$faculty_id', name='$name', phone='$phone', address='$address', email='$email' WHERE id=$id";
                                        $result = mysqli_query($conn, $sql);
                                        if ($result) {
                                            echo "<script>
                                                    window.onload = function() {
                                                        alert('Information updated successfully.');
                                                        window.location.href = 'profile.php'; // Redirects to index.php after alert
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
                                        <label for="setting-input-1" class="form-label"> Faculty Id</label>
                                        <input type="text" name="faculty_id" class="form-control" id="setting-input-1" value="<?php echo $data['faculty_id'];?>" readonly>
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
                                    <button type="submit" name="save" class="btn app-btn-primary" 								
                                    style="
									background-color: #6c757d; 
									color: #fff; 
									padding: 8px 12px; 
									border: none; 
									border-radius: 4px; 
									text-decoration: none; 
									font-size: 14px; 
									transition: background-color 0.3s ease, transform 0.2s ease; 
									display: inline-block;">Save Changes</button>
                                </form>
                            </div><!--//app-card-body-->

                        </div><!--//app-card-->
                    </div>
                </div><!--//row-->
            </div><!--//container-fluid-->
        </div><!--//app-content-->

        <?php require('../teacherdb/includes/footer.php'); ?>