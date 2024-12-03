<?php
session_start();

// Check if the user is authenticated
if (!isset($_SESSION["id"])) {
	header("Location: ../index/roles.php"); // Redirect to login page
	exit();
} else {
	$user_id = $_SESSION['id'];
}
?>
<?php require('config/config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<title>Attendance Management System</title>

	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
	<meta name="author" content="Xiaoying Riley at 3rd Wave Media">
	<link rel="shortcut icon" href="favicon.ico">

	<!-- FontAwesome JS-->
	<script defer src="assets/plugins/fontawesome/js/all.min.js"></script>

	<!-- App CSS -->
	<link id="theme-style" rel="stylesheet" href="assets/css/portal.css">
	<style>
		/* .app {
			background-image: linear-gradient(135deg, #6c5ce7, #8bd3e6);
		} */

		#app-sidepanel {
			background-color: #ffffff;
		}

		.sidepanel-hidden {
			display: none;
		}

		.sidepanel-visible {
			display: block;
		}

		.icon-large {
			font-size: 3rem;
			background-color: #f0f0f0;
			border-radius: 50%;
			padding: 30px;
		}

		.app-nav .nav-link {
			font-size: 1.15rem;
			transition: 0.12s;
		}

		/* Sidebar menu item font size on hover */
		.app-nav .nav-link:hover {
			color: #6879d0;
			font-size: 1.3rem;
		}

		.app-content {
			display: flex;
			justify-content: flex-start;
			/* Aligns the content to the left */
		}

		.app-card {
			margin-left: -260px;
			/* Adjust this to move the card left */
		}

		.app-logo .logo-text {
			/* background: linear-gradient(to right, #99ffcc 0%, #ccffff 100%); */
			margin-inline: 67px;
			font-size: 40px;
			font-family: Arial, Helvetica, sans-serif;
			background: linear-gradient(135deg, #6c5ce7, #8bd3e6);
			-webkit-text-fill-color: transparent;
			-webkit-background-clip: text;
		}

		.text-light {
			margin-inline: 40px;
		}

		.btn-custom {
            background-color: #6f9cde;  
			padding: 8px 12px; 
			border-radius: 4px; 
			font-size: 14px; 
			margin-bottom: 30px;
			opacity: 0.99;
			transition: 0.3s;	
        }

		.btn-custom:hover {
            background-color: #6879d0;
			opacity: 1;
        }

	</style>
</head>

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
                                    $stmt = $conn->prepare("SELECT name FROM users WHERE id = ?");
                                    $stmt->bind_param('s', $user_id);

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
							<h2 class="fs-2 m-0">Admin Dashboard</h2>
						</div>
						<div class="app-utilities col-auto">
							<div class="app-utility-item app-notifications-dropdown dropdown">

							</div><!--//app-utility-item-->

							<div class="app-utility-item app-user-dropdown dropdown">
								<a role="button" href="teachers/notification.php">🔔</a>
								<a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><img src="../assets/img/logo.png" alt="user profile" style="width: 120px; height: auto;"></a>
								<ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
									<li><a class="dropdown-item" href="logout_user.php">Log Out</a></li>
								</ul>
							</div><!--//app-user-dropdown-->
						</div><!--//app-utilities-->
					</div><!--//row-->
				</div><!--//app-header-content-->
			</div><!--//container-fluid-->
		</div><!--//app-header-inner-->
		<div id="app-sidepanel" class="app-sidepanel sidepanel-hidden">
			<div id="sidepanel-drop" class="sidepanel-drop"></div>
			<div class="sidepanel-inner d-flex flex-column">
				<a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
				<div class="app-branding">
					<a class="app-logo" href="index.php"><span class="logo-text">AMS</span></a>

				</div><!--//app-branding-->
				<nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
					<ul class="app-menu list-unstyled accordion" id="menu-accordion">
						<li class="nav-item">
							<!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
							<a class="nav-link" href="#" onclick="window.location.href=window.location.href;">
								<span class="nav-link-text">Profile</span>
							</a>
						</li><!--//nav-item-->
						<li class="nav-item">
							<!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
							<a class="nav-link" href="students/index.php">
								<span class="nav-link-text">Manage Students</span>
							</a><!--//nav-link-->
						</li><!--//nav-item-->

						<li class="nav-item">
							<!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
							<a class="nav-link" href="teachers/index.php">
								<span class="nav-link-text">Manage Teachers</span>
							</a><!--//nav-link-->
						</li><!--//nav-item-->

						<li class="nav-item">
							<!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
							<a class="nav-link" href="courses/index.php">
								<span class="nav-link-text">Manage Courses</span>
							</a><!--//nav-link-->
						</li><!--//nav-item-->

						<li class="nav-item">
							<!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
							<a class="nav-link" href="attendance/show.php">
								<span class="nav-link-text">View Attendance</span>
							</a><!--//nav-link-->
						</li><!--//nav-item-->
					</ul><!--//app-menu-->
				</nav><!--//app-nav-->
				<div class="app-sidepanel-footer">
					<nav class="app-nav app-nav-footer">
						<ul class="app-menu footer-menu list-unstyled">
						</ul><!--//footer-menu-->
					</nav>
				</div><!--//app-sidepanel-footer-->
			</div><!--//sidepanel-inner-->
		</div>
	</header><!--//app-header-->

	<div class="app-wrapper">
		<div class="container-fluid px-4" id="content-area">
			<div class="row g-3 my-2">
				<div class="col-md-3">
					<div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
						<div>
							<h3 class="fs-2">500+</h3>
							<p class="fs-5">Students</p>
						</div>
						<i class="fa-solid fa-user-tie icon-large rounded-icon"></i>
					</div>
				</div>
				<div class="col-md-3">
					<div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
						<div>
							<h3 class="fs-2">80+</h3>
							<p class="fs-5">Staffs</p>
						</div>
						<i class="fa-solid fa-person-chalkboard icon-large rounded-icon"></i>
					</div>
				</div>
				<div class="col-md-3">
					<div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
						<div>
							<h3 class="fs-2">5</h3>
							<p class="fs-5">Degrees</p>
						</div>
						<i class="fa-solid fa-graduation-cap icon-large rounded-icon"></i>
					</div>
				</div>
			</div>
		</div>

		<div class="app-wrapper">
			<div class="app-content pt-3 p-md-3 p-lg-4">
				<div class="container-xl">
					<div class="tab-content" id="orders-table-tab-content">
						<div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
							<div class="app-card app-card-orders-table shadow-sm mb-5">
								<div class="app-card-body">
									<div class="p-3">
									</div><!--//tab-pane-->

									<?php
									if (isset($_GET['id']) && is_numeric($_GET['id'])) {
										$id = intval($_GET['id']);
										$stmt = $conn->prepare("SELECT name FROM users WHERE id = ?");
										$stmt->bind_param("i", $id);
										$stmt->execute();
										$result = $stmt->get_result();

										if ($row = $result->fetch_assoc()) {
											echo "<h1 class='text-light'>Welcome <span>" . htmlspecialchars($row['name']) . "</span></h1>";
										} else {
											echo "<h1 class='text-light'>User not found.</h1>";
										}
									} ?>
									<?php
									$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
									$stmt->bind_param('s', $user_id);

									$stmt->execute();
									$result = $stmt->get_result();

									if ($result->num_rows > 0) {
										$row = $result->fetch_assoc();
										$name = htmlspecialchars($row['name']);
										$phone = htmlspecialchars($row['phone']);
										$email = htmlspecialchars($row['email']);
										echo "
									<table style='border-collapse: collapse; width: 100%; max-width: 600px; font-family: Arial, sans-serif; margin: 20px auto; padding: 10px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1);'>
										<tr style='background-color: #f2f2f2;'>
											<th style='padding: 15px; text-align: left; border: 1px solid #ddd;'>Field</th>
											<th style='padding: 15px; text-align: left; border: 1px solid #ddd;'>Value</th>
										</tr>
										<tr>
											<td style='padding: 12px; border: 1px solid #ddd;'>Name</td>
											<td style='padding: 12px; border: 1px solid #ddd;'>" . $name . "</td>
										</tr>
										<tr>
											<td style='padding: 12px; border: 1px solid #ddd;'>Phone</td>
											<td style='padding: 12px; border: 1px solid #ddd;'>" . $phone . "</td>
										</tr>
										<tr>
											<td style='padding: 12px; border: 1px solid #ddd;'>Email</td>
											<td style='padding: 12px; border: 1px solid #ddd;'>" . $email . "</td>
										</tr>
									</table>
									";
									} else {
										echo "user not found.";
									}

									$stmt->close();

									?>
									<div style="text-align: center;">
										<a class="btn btn-custom btn-secondary"
											href="teachers/edituser.php?id=<?php echo $row['id'] ?>">
											Edit my information
										</a>
									</div>
								</div><!--//tab-content-->
							</div><!--//container-fluid-->
						</div><!--//app-content-->

						<footer class="app-footer">
							<div class="container text-center py-3">
								<!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
								Designed with <span class="sr-only">love</span><i class="fas fa-heart"
									style="color: #fb866a;"></i> by <a class="app-link" href=""
									target="_blank">GU</a> for developers</small>
							</div>
						</footer><!--//app-footer-->

					</div><!--//app-wrapper-->
				</div>
			</div>
		</div>
		<!-- Javascript -->
		<script src="assets/plugins/popper.min.js"></script>
		<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

		<!-- Charts JS -->
		<script src="assets/plugins/chart.js/chart.min.js"></script>
		<script src="assets/js/index-charts.js"></script>

		<!-- Page Specific JS -->
		<script src="assets/js/app.js"></script>

</body>

</html>