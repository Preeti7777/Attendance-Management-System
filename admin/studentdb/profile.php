<?php require('../studentdb/includes/header.php'); ?>
<style>

	.btn-custom {
            background-color: #AD9DC8;  
			padding: 8px 12px; 
			border-radius: 4px; 
			font-size: 14px; 
			margin-bottom: 30px;
			opacity: 0.99;
			transition: 0.3s;	
        }

		.btn-custom:hover {
            background-color: #8F7AB5;
			opacity: 1;
        }

		.text-light {
			margin-inline: 40px;
		}
</style>

<body class="app">
	<?php require('../studentdb/includes/navbar.php'); ?>
	<?php require('../studentdb/includes/sidebar.php'); ?>
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
									$stmt = $conn->prepare("SELECT name FROM students WHERE id = ?");
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
								$stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
								$stmt->bind_param('s', $student_id);

								$stmt->execute();
								$result = $stmt->get_result();

								if ($result->num_rows > 0) {
									$row = $result->fetch_assoc();
									$reg_id = htmlspecialchars($row['reg_id']);
									$name = htmlspecialchars($row['name']);
									$phone = htmlspecialchars($row['phone']);
									$address = htmlspecialchars($row['address']);
									$email = htmlspecialchars($row['email']);
									$faculty = htmlspecialchars($row['faculty']);
									$batch = htmlspecialchars($row['batch']);
									$parent_name = htmlspecialchars($row['parent_name']);
									$parent_phone = htmlspecialchars($row['parent_phone']);
									echo "
									<table style='border-collapse: collapse; width: 100%; max-width: 600px; font-family: Arial, sans-serif; margin: 20px auto; padding: 10px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1);'>
										<tr style='background-color: #f2f2f2;'>
											<th style='padding: 15px; text-align: left; border: 1px solid #ddd;'>Field</th>
											<th style='padding: 15px; text-align: left; border: 1px solid #ddd;'>Value</th>
										</tr>
										<tr>
											<td style='padding: 12px; border: 1px solid #ddd;'>Registration ID</td>
											<td style='padding: 12px; border: 1px solid #ddd;'>" . $reg_id . "</td>
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
										<tr>
											<td style='padding: 12px; border: 1px solid #ddd;'>Faculty</td>
											<td style='padding: 12px; border: 1px solid #ddd;'>" . $faculty . "</td>
										</tr>
										<tr>
											<td style='padding: 12px; border: 1px solid #ddd;'>Batch</td>
											<td style='padding: 12px; border: 1px solid #ddd;'>" . $batch . "</td>
										</tr>
										<tr>
											<td style='padding: 12px; border: 1px solid #ddd;'>Parent's Name</td>
											<td style='padding: 12px; border: 1px solid #ddd;'>" . $parent_name . "</td>
										</tr>
										<tr>
											<td style='padding: 12px; border: 1px solid #ddd;'>Parent's Phone</td>
											<td style='padding: 12px; border: 1px solid #ddd;'>" . $parent_phone . "</td>
										</tr>
									</table>
									";
								} else {
									echo "Student not found.";
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

	<?php require('../studentdb/includes/footer.php'); ?>

</body>


					