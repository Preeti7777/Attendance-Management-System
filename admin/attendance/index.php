<?php require('../includes/header.php'); ?>

<body class="app">
	<?php require('../includes/navbar.php'); ?>
	<?php require('../includes/sidebar.php'); ?>
	<div class="app-wrapper">

		<div class="app-content pt-3 p-md-3 p-lg-4">
			<div class="container-xl">



				<div class="tab-content" id="orders-table-tab-content">
					<div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
						<div class="app-card app-card-orders-table shadow-sm mb-5">
							<div class="app-card-body">
								<div class="p-3">
                                    <div class="d-grid gap-4 col-6 mx-auto">
                                        <button class="btn btn-primary w-100" type="button">2021-BIT</button>
                                        <button class="btn btn-primary w-100" type="button">BIT2022</button>
                                        <a href="show1.php"><button class="btn btn-primary w-100" type="button">BIT2022N</button></a>
                                        <button class="btn btn-primary w-100" type="button">BIT2023</button>
                                    </div>
								</div>

					</div><!--//tab-pane-->



				</div><!--//tab-content-->



			</div><!--//container-fluid-->
		</div><!--//app-content-->



		<?php require('../includes/footer.php'); ?>