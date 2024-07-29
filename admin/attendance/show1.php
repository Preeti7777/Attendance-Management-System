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
								<div class="table-responsive">
                                <?php

                                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                            $course_id = $_POST['course_id'];
                                            $date = $_POST['date'];

                                            $sql = "SELECT s.name, s.reg_id, SUM(a.status = 'present') AS total_present, 
                                                    SUM(a.status = 'absent') AS total_absent  
                                                    FROM attendance a
                                                    JOIN students s ON a.std_id = s.id
                                                    WHERE a.course_id = '$course_id'
                                                    GROUP BY s.reg_id
                                                    ORDER BY s.name";

                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                                echo "<table border='1'>
                                                        <tr>
                                                            <th>Student Name</th>
                                                            <th>Registration number</th>
                                                            <th>Total Present</th>
                                                            <th>Total Absent</th>

                                                        </tr>";
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>
                                                            <td>" . htmlspecialchars($row['name']) . "</td>
                                                            <td>" . htmlspecialchars($row['reg_id']) . "</td>
                                                            <td>" . $row['total_present'] . "</td>
                                                            <td>" . $row['total_absent'] . "</td>
                                                        </tr>";
                                                }
                                                echo "</table>";
                                            } else {
                                                echo "No attendance records found for the selected class and date.";
                                            }
                                        }

                                        $conn->close();
                                 ?>
								<!DOCTYPE html>
                                <html>
                                <head>
                                    <title>View Attendance</title>
                                </head>
                                <body>
                                    <h2>View Attendance</h2>
                                    <form method="post" action="">
                                        <label for="course_id">Course:</label>
                                        <select name="course_id" required>
                                            <?php
                                            $courses_query = "SELECT * FROM courses";
                                            $courses_result = $conn->query($courses_query);
                                            if ($courses_result->num_rows > 0) {
                                                while ($row = $courses_result->fetch_assoc()) {
                                                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                                }
                                            }
                                            $conn->close();
                                            ?>
                                        </select><br><br>

                                        <input type="submit" value="View Attendance">
                                    </form>
                                </body>
                                </html>


		<?php require('../includes/footer.php'); ?>