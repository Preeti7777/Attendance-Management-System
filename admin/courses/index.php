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
									<a class="btn btn-primary btn-sm text-white" href="create.php" role="button">Add Course </a>
								</div>
								<div class="table-responsive">
									<?php 
									if(isset($_GET['sms'])){
										$sms=$_GET['sms'];

										if($sms=='deleted'){
											echo '<div class="alert alert-success">Courses deleted successfully</div>';
											echo "<meta http-equiv=\"refresh\" content=\"2;URL=index.php?\">";
										}
										if($sms=='error'){
											echo '<div class="alert alert-danger">An error occured</div>';
										    echo "<meta http-equiv=\"refresh\" content=\"2;URL=index.php?\">";

										}
									}
									?>
									<table class="table app-table-hover mb-0 text-left">
										<thead>
											<tr>
												<th class="col">ID</th>
												<th class="col">Name</th>
												<th class="col">Teacher</th>
												<th class="col">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											 $select = "SELECT *FROM courses";
											 $select_result=mysqli_query($conn,$select);
											$i=1;
											 while($data=mysqli_fetch_array($select_result)){
												?>
												<tr>
												<td class="cell"><?php echo $i++?></td>
												<td class="cell"><?php echo $data['name']?></td>
												<td class="cell"><?php echo $data['teacher']?></td>
												<td class="cell">
													<a class="btn btn-sm btn-secondary" href="edit.php?id=<?php echo $data['id'] ?>">Edit</a> 
													<a class="btn btn-sm btn-info" href="show.php?id=<?php echo $data['id'] ?>">View</a>
													<a class="btn btn-sm btn-danger" onclick="return confirm('Do you want to delete this data??')" href="delete.php?id=<?php echo $data['id'] ?>">Delete</a>
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
						<nav class="app-pagination">
							<ul class="pagination justify-content-center">
								<li class="page-item disabled">
									<a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
								</li>
								<li class="page-item active"><a class="page-link" href="#">1</a></li>
								<li class="page-item"><a class="page-link" href="#">2</a></li>
								<li class="page-item"><a class="page-link" href="#">3</a></li>
								<li class="page-item">
									<a class="page-link" href="#">Next</a>
								</li>
							</ul>
						</nav><!--//app-pagination-->

					</div><!--//tab-pane-->



				</div><!--//tab-content-->



			</div><!--//container-fluid-->
		</div><!--//app-content-->



		<?php require('../includes/footer.php'); ?>