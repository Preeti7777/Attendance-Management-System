<?php require('../includes/header.php'); ?>

<style>
    /* General Page Styling */
    body {
        background-color: #f4f7fc;
        font-family: Arial, sans-serif;
    }

    .container {
        margin-top: 20px;
    }

    .app-card {
        background-color: #ffffff;
        border: 1px solid #dee2e6;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Button Styles */
    .btn-custom {
        background-color: #6f9cde;
        transition: 0.3s;
        border: none;
        color: #fff;
    }

    .btn-custom:hover {
        background-color: #5a85c2;
    }

    .btn-sm {
        padding: 5px 10px;
        border-radius: 5px;
        margin-right: 5px;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: #fff;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    .btn-danger {
        background-color: #dc3545;
        color: #fff;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .btn-info {
        background-color: #17a2b8;
        color: #fff;
    }

    .btn-info:hover {
        background-color: #138496;
    }

    /* Table Styles */
    .table {
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
    }

    .table th,
    .table td {
        padding: 10px 15px;
        text-align: left;
        border-bottom: 1px solid #dee2e6;
        vertical-align: middle;
    }

    .table th {
        background-color: #6f9cde;
        color: #ffffff;
        font-weight: 500;
    }

    .table .cell {
        color: #333333;
    }

    .table .cell a {
        text-decoration: none;
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

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .table-responsive {
            overflow-x: auto;
        }

        .btn-sm {
            font-size: 12px;
            padding: 5px;
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
            <div class="container" style="margin-top: 20px;">
                <div class="tab-content" id="orders-table-tab-content">
                    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                        <div class="app-card app-card-orders-table shadow-sm mb-5">
                            <div class="app-card-body">
                                <div class="p-3">
                                    <a class="btn app-btn-primary" href="create.php" role="button">Add Student</a>
                                </div>
                                <div class="table-responsive">
                                    <?php
                                    if (isset($_GET['sms'])) {
                                        $sms = $_GET['sms'];
                                        if ($sms == 'deleted') {
                                            echo "<script>
                                                    window.onload = function() {
                                                        alert('Student deleted successfully.');
                                                        window.location.href = 'index.php'; // Redirects to index.php after alert
                                                    };
                                                </script>";
                                        }
                                        if ($sms == 'error') {
                                            echo '<div class="alert alert-danger">An error occurred</div>';
                                            echo "<meta http-equiv=\"refresh\" content=\"2;URL=index.php?\">";
                                        }
                                    }
                                    ?>
                                    <table class="table app-table-hover mb-0 text-left">
                                        <thead>
                                            <tr>
                                                <th class="col">Reg No</th>
                                                <th class="col">Name</th>
                                                <th class="col">Phone</th>
                                                <th class="col">Address</th>
                                                <th class="col">Email</th>
                                                <th class="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $select = "SELECT * FROM students";
                                            $select_result = mysqli_query($conn, $select);
                                            $i = 1;
                                            while ($data = mysqli_fetch_array($select_result)) {
                                            ?>
                                                <tr>
                                                    <td class="cell"><?php echo $data['reg_id']; ?></td>
                                                    <td class="cell"><?php echo $data['name']; ?></td>
                                                    <td class="cell"><?php echo $data['phone']; ?></td>
                                                    <td class="cell"><?php echo $data['address']; ?></td>
                                                    <td class="cell"><?php echo $data['email']; ?></td>
                                                    <td class="cell">
                                                        <a class="btn btn-sm btn-secondary" href="edit.php?id=<?php echo $data['id']; ?>">Edit</a>
                                                        <a class="btn btn-sm btn-info" href="show.php?id=<?php echo $data['id']; ?>">View</a>
                                                        <a class="btn btn-sm btn-danger" onclick="return confirm('Do you want to delete this data?')" href="delete.php?id=<?php echo $data['id']; ?>">Delete</a>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div><!--//table-responsive-->
                            </div><!--//app-card-body-->
                        </div><!--//app-card--> 
                    </div><!--//tab-pane-->
                </div><!--//tab-content-->
            </div><!--//container-fluid-->
        </div><!--//app-content-->
    </div>
    <?php require('../includes/footer.php'); ?>
</body>
