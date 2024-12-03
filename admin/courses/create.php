<?php require('../includes/header.php'); ?>
<style>
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
                <h1 class="app-page-title">Add Course</h1>
                <a class="btn app-btn-primary" href="index.php" role="button"> Manage Course </a>
                <hr class="mb-4">
                <div class="row g-4 settings-section">
                    <div class="col-12 col-md-6">
                        <div class="app-card app-card-settings shadow-sm p-4">

                            <div class="app-card-body">
                                <?php
                                $teachers = "SELECT * FROM teachers";
                                $teachers_result = $conn->query($teachers);

                                if (isset($_POST['save'])) {
                                    $name = $_POST['name'];
                                    $teacher_id = $_POST['teacher_id'];
                                    if ($name == "" || $teacher_id == "") {
                                        echo "<div class='alert alert-danger'>All fields are required</div>";
                                        // header("Refresh:2;URL=create.php");
                                        echo "<meta http-equiv=\"refresh\" content=\"2;URL=create.php\">";
                                    } else {
                                        $sql = "INSERT INTO courses (name,teacher_id) VALUES ('$name', '$teacher_id')";
                                        $result = mysqli_query($conn, $sql);
                                        if ($result) {
                                            echo 
                                            "<script>
                                                    window.onload = function() {
                                                        alert('Course added successfully.');
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
                                        <label for="setting-input-1" class="form-label">Course Name</label>
                                        <input type="text" name="name" class="form-control" id="setting-input-1" value="">
                                    </div>
                                    <!-- <div class="mb-3">
                                        <label for="setting-input-2" class="form-label">Teacher </label>
                                        <input type="text" name="teacher" class="form-control" id="setting-input-2" value="">
                                    </div> -->
                                    <label for="teacher_id">Teacher:</label>
                                        <select name="teacher_id" required>
                                            <option value="" disabled selected>Select a teacher</option>
                                            <?php
                                            if ($teachers_result->num_rows > 0) {
                                                while ($row = $teachers_result->fetch_assoc()) {
                                                    echo "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['name']) . "</option>";
                                                }
                                            }
                                            ?>
                                        </select><br><br>
                                    <button type="submit" name="save" class="btn app-btn-primary">Add</button>
                                </form>
                            </div><!--//app-card-body-->

                        </div><!--//app-card-->
                    </div>
                </div><!--//row-->
            </div><!--//container-fluid-->
        </div><!--//app-content-->

        <?php require('../includes/footer.php'); ?>