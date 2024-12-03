<style>
    /* .app {
		background-image: linear-gradient(to right, #8F7AB5, #B8A0D1, #D6C8E1);
    } */

    #app-sidepanel {
        background-color: #e3d7bd;
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
        font-size: 1.3rem;
        color: #8F7AB5;
    }
    .app-content {
        display: flex;
        justify-content: flex-start; /* Aligns the content to the left */
    }
    html, body {
        height: 100%;
        margin: 0;
    }
    .app-logo .logo-text {
        /* background: linear-gradient(to right, #99ffcc 0%, #ccffff 100%); */
        margin-inline: 67px;
        font-size: 40px;
        font-family: Arial, Helvetica, sans-serif;
        background: linear-gradient(to right, #8F7AB5, #B8A0D1, #D6C8E1);
        -webkit-text-fill-color: transparent;
        -webkit-background-clip: text;
    }
		
    </style>
</head><div id="app-sidepanel" class="app-sidepanel sidepanel-hidden">
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
							<a class="nav-link" href="profile.php">
								<span class="nav-link-text">Profile</span>
							</a><!--//nav-link-->
						</li><!--//nav-item-->

						<li class="nav-item">
							<!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
							<a class="nav-link" href="view.php">
								<span class="nav-link-text">View Attendance</span>
							</a><!--//nav-link-->
						</li><!--//nav-item-->

						<li class="nav-item">
							<!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
							<a class="nav-link" href="application.php">
								<span class="nav-link-text">Application</span>
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