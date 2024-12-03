
<style>
    .app {
        background-image: linear-gradient(135deg, #6c5ce7, #8bd3e6);
    }

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
    }

    /* Sidebar menu item font size on hover */
    .app-nav .nav-link:hover {
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
        margin-inline: 40px;
        font-size: 40px;
        font-family: Arial, Helvetica, sans-serif;
        background: linear-gradient(135deg, #6c5ce7, #8bd3e6);
        -webkit-text-fill-color: transparent;
        -webkit-background-clip: text;
    }

    .text-light {
        margin-inline: 40px;
    }
</style>

<header class="app-header fixed-top">
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
						</div><!--//col-->
						<div class="col-auto d-flex align-items-center">

							<!-- Dashboard Title -->
							<h2 class="fs-2 m-0">Admin Dashboard</h2>
						</div>
						<div class="app-utilities col-auto">
							<div class="app-utility-item app-notifications-dropdown dropdown">

							</div><!--//app-utility-item-->

							<div class="app-utility-item app-user-dropdown dropdown">
								<a role="button" href="../teachers/notification.php" style="text-decoration: none;">🔔</a>
								<a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><img src="../../assets/img/logo.png" alt="user profile" style="width: 120px; height: auto;"></a>
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
							<a class="nav-link" href="../dashboard.php" onclick="window.location.href=window.location.href;">
								<span class="nav-link-text">Profile</span>
							</a>
						</li><!--//nav-item-->
						<li class="nav-item">
							<!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
							<a class="nav-link" href="../students/index.php">
								<span class="nav-link-text">Manage Students</span>
							</a><!--//nav-link-->
						</li><!--//nav-item-->

						<li class="nav-item">
							<!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
							<a class="nav-link" href="../teachers/index.php">
								<span class="nav-link-text">Manage Teachers</span>
							</a><!--//nav-link-->
						</li><!--//nav-item-->

						<li class="nav-item">
							<!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
							<a class="nav-link" href="../courses/index.php">
								<span class="nav-link-text">Manage Courses</span>
							</a><!--//nav-link-->
						</li><!--//nav-item-->

						<li class="nav-item">
							<!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
							<a class="nav-link" href="../attendance/index.php">
								<span class="nav-link-text">View Attendance</span>
							</a><!--//nav-link-->
						</li><!--//nav-item-->
					</ul><!--//app-menu-->
				</nav><!--//app-nav-->
				<div class="app-sidepanel-footer">
					<nav class="app-nav app-nav-footer">
						<ul class="app-menu footer-menu list-unstyled">
							<li class="nav-item">
								<!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
								<a class="nav-link" href="settings.php">
									<span class="nav-icon"><i class="fa fa-settings"></i></span>
									<span class="nav-link-text">Settings</span>
								</a><!--//nav-link-->
							</li><!--//nav-item-->
						</ul><!--//footer-menu-->
					</nav>
				</div><!--//app-sidepanel-footer-->
			</div><!--//sidepanel-inner-->
		</div>
	</header><!--//app-header-->