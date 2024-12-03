<?php
session_start();

if (isset($_SESSION['id'])) {
    $teacher_id = $_SESSION['id'];
} else {
    echo "No teacher is logged in.";
}
?>

<body class="app">
    <header class="app-header fixed-top" style="height: 65px;">
        <div class="app-header-inner">
            <div class="container-fluid py-2">
                <div class="app-header-content">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" role="img">
                                    <title>Menu</title>
                                    <path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path>
                                </svg>
                                </a>
                                <p><?php
                                    $stmt = $conn->prepare("SELECT name FROM teachers WHERE id = ?");
                                    $stmt->bind_param('s', $teacher_id);

                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    if ($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();
                                        $teacher_name = htmlspecialchars($row['name']);
                                        echo  "  $teacher_name  ";
                                    } else {
                                        echo "teacher not found.";
                                    }

                                    $stmt->close();

                                ?></p>
                        </div><!--//col-->
                        <div class="col-auto d-flex align-items-center">

                            <!-- Dashboard Title -->
                            <h2 class="fs-2 m-auto">Faculty Dashboard</h2>
                        </div>
                        
                        <div class="app-utilities col-auto">
                                <div class="app-utility-item app-user-dropdown dropdown">
                                    <a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><img src="../../assets/img/logo.png" alt="user profile" style="width: 120px; height: auto;"></a>
                                    <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
                                        <li><a class="dropdown-item" href="../logout_teach.php">Log Out</a></li>
                                    </ul>
                                </div><!--//app-user-dropdown-->
                            </div><!--//app-utilities-->
                        </div><!--//row-->
                    </div><!--//app-header-content-->
                </div><!--//container-fluid-->
            </div>