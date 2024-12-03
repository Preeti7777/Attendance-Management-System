<?php require('../teacherdb/includes/header.php'); ?>
<style>
	.app-card {
		margin-left: -260px;
		/* Adjust this to move the card left */
	}

	.app-content {
		display: flex;
		justify-content: flex-start;
		/* Aligns the content to the left */
	}

	.text-light {
		margin-inline: 40px;
		margin-top: -10px;
	}

	.btn-custom {
            background-color: #53c79f;  
			padding: 8px 12px; 
			border-radius: 4px; 
			font-size: 14px; 
			margin-bottom: 30px;
			opacity: 0.99;
			transition: 0.3s;	
        }

		.btn-custom:hover {
            background-color: #39ae86;
			opacity: 1;
        }

	/* Increase font size for better readability */
</style>

<body class="app">

	<?php require('../teacherdb/includes/navbar.php'); ?>
	<?php require('../teacherdb/includes/sidebar.php'); ?>
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
				<div class="container">
					<div class="tab-content" id="orders-table-tab-content">
						<div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
							<div class="app-card app-card-orders-table shadow-sm mb-1">
								<div class="app-card-body">
									<div class="p-3">
									</div><!--//tab-pane-->

									<?php
									if (isset($_GET['id']) && is_numeric($_GET['id'])) {
										$id = intval($_GET['id']);
										$stmt = $conn->prepare("SELECT name FROM teachers WHERE id = ?");
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
									$stmt = $conn->prepare("SELECT * FROM teachers WHERE id = ?");
									$stmt->bind_param('s', $teacher_id);

									$stmt->execute();
									$result = $stmt->get_result();

									if ($result->num_rows > 0) {
										$row = $result->fetch_assoc();
										$faculty_id = htmlspecialchars($row['faculty_id']);
										$name = htmlspecialchars($row['name']);
										$phone = htmlspecialchars($row['phone']);
										$address = htmlspecialchars($row['address']);
										$email = htmlspecialchars($row['email']);
										echo "
									<table style='border-collapse: collapse; width: 100%; max-width: 600px; font-family: Arial, sans-serif; margin: 20px auto; padding: 10px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1);'>
										<tr style='background-color: #f2f2f2;'>
											<th style='padding: 15px; text-align: left; border: 1px solid #ddd;'>Field</th>
											<th style='padding: 15px; text-align: left; border: 1px solid #ddd;'>Value</th>
										</tr>
										<tr>
											<td style='padding: 12px; border: 1px solid #ddd;'>Faculty ID</td>
											<td style='padding: 12px; border: 1px solid #ddd;'>" . $faculty_id . "</td>
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
											<td style='padding: 12px; border: 1px solid #ddd;'>Address</td>
											<td style='padding: 12px; border: 1px solid #ddd;'>" . $address . "</td>
										</tr>
										<tr>
											<td style='padding: 12px; border: 1px solid #ddd;'>Email</td>
											<td style='padding: 12px; border: 1px solid #ddd;'>" . $email . "</td>
										</tr>
									</table>
									";
									} else {
										echo "teacher not found.";
									}

									$stmt->close();

									?>
									<div style="text-align: center;">
										<a class="btn btn-custom btn-secondary"
											href="edit.php?id=<?php echo $row['id'] ?>">
											Edit my information
										</a>
									</div>
								</div><!--//tab-content-->
							</div><!--//container-fluid-->
						</div><!--//app-content-->
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php require('../teacherdb/includes/footer.php'); ?>

</body>