<head><!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">
    <style>
        


        .app-nav .nav-link {
            font-size: 1.15rem;
            transition: 0.12s;
        }

        /* Sidebar menu item font size on hover */
        .app-nav .nav-link:hover {
            font-size: 1.3rem;
            color:#6879d0;
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
    </style>
</head>
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
                    <a class="nav-link" href="../dashboard.php">
                        <span class="nav-link-text">Profile</span>
                    </a><!--//nav-link-->
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
                    <a class="nav-link" href="../attendance/show.php">
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
</header>