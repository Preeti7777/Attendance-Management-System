<?php require('../includes/header.php'); ?>

<body class="app">
    <?php require('../includes/navbar.php'); ?>
    <?php require('../includes/sidebar.php'); ?>
    <div class="app-wrapper">

        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <h1 class="app-page-title">Add Course</h1>
                <a class="btn btn-primary btn-sm text-white" href="index.php" role="button"> Manage Course </a>
                <hr class="mb-4">
                <div class="row g-4 settings-section">
                    <div class="col-12 col-md-6">
                        <div class="app-card app-card-settings shadow-sm p-4">

                            <div class="app-card-body">
                                <?php
                                if (isset($_POST['save'])) {
                                    $name = $_POST['name'];
                                    $teacher = $_POST['teacher'];
                                    if ($name == "" || $teacher == "") {
                                        echo "<div class='alert alert-danger'>All fields are required</div>";
                                        // header("Refresh:2;URL=create.php");
                                        echo "<meta http-equiv=\"refresh\" content=\"2;URL=create.php\">";
                                    } else {
                                        $sql = "INSERT INTO courses (name,teacher) VALUES ('$name', '$teacher')";
                                        $result = mysqli_query($conn, $sql);
                                        if ($result) {
                                            echo '<div class="alert alert-success">Course added successfully</div>';
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
                                        <label for="setting-input-1" class="form-label"> Name</label>
                                        <input type="text" name="name" class="form-control" id="setting-input-1" value="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-2" class="form-label">Teacher </label>
                                        <input type="text" name="teacher" class="form-control" id="setting-input-2" value="">
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