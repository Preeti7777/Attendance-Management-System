<?php require('../studentdb/includes/header.php'); ?>

<body class="app">
	<?php require('../studentdb/includes/navbar.php'); ?>
	<?php require('../studentdb/includes/sidebar.php'); ?>
    <div class="app-wrapper">

        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">

                <div class="tab-content" id="orders-table-tab-content">
                    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                        <div class="app-card app-card-orders-table shadow-sm mb-5">
                            <div class="p-3">
                            <?php
                                require('../config/config.php');
                                // include 'db_connect.php'; 

                                $students = "SELECT * FROM students";
                                $students_result = $conn->query($students);

                                $courses = "SELECT * FROM courses";
                                $courses_result = $conn->query($courses);
                                ?>
                                <?php

                                // Query to fetch attendance details for all students across all courses
                                $sql = "SELECT c.name, SUM(a.status = 'present') AS present, 
                                        SUM(a.status = 'absent') AS absent,
                                        SUM(a.status IN ('present', 'absent')) AS total_class  
                                        FROM courses c
                                        JOIN attendance a ON a.course_id = c.id
                                        WHERE a.std_id='$student_id'
                                        GROUP BY  c.id";
                                
                                $result = $conn->query($sql);

                                // Display attendance records in a single table
                                if ($result->num_rows > 0) {
                                    echo "<h2> Attendance Records</h2>";
                                    echo "<table style='border-collapse: collapse; width: 100%; max-width: 800px; margin: 20px auto; font-family: Arial, sans-serif; box-shadow: 0px 0px 10px rgba(0,0,0,0.1);'>
                                            <tr style='background-color: #f2f2f2;'>
                                                <th style='padding: 12px; border: 1px solid #ddd;'>Course Name</th>
                                                <th style='padding: 12px; border: 1px solid #ddd;'>Total Present</th>
                                                <th style='padding: 12px; border: 1px solid #ddd;'>Total Absent</th>
                                                <th style='padding: 12px; border: 1px solid #ddd;'>Total Classes</th>
                                                <th style='padding: 12px; border: 1px solid #ddd;'>Present (%)</th>
                                                <th style='padding: 12px; border: 1px solid #ddd;'>Absent (%)</th>
                                                <th style='padding: 12px; border: 1px solid #ddd;'>Chart</th>
                                            </tr>";
                                    while ($row = $result->fetch_assoc()) {
                                        $total_class = $row['total_class'];
                                        $present = $row['present'];
                                        $absent = $row['absent'];

                                        // Calculate percentages
                                        $present_percentage = ($total_class > 0) ? round(($present / $total_class) * 100, 2) : 0;
                                        $absent_percentage = 100 - $present_percentage;

                                        echo "<tr>
                                                <td style='padding: 12px; border: 1px solid #ddd; text-align: center;'>" . htmlspecialchars($row['name']) . "</td>
                                                <td style='padding: 12px; border: 1px solid #ddd; text-align: center;'>" . htmlspecialchars($present) . "</td>
                                                <td style='padding: 12px; border: 1px solid #ddd; text-align: center;'>" . htmlspecialchars($absent) . "</td>
                                                <td style='padding: 12px; border: 1px solid #ddd; text-align: center;'>" . htmlspecialchars($total_class) . "</td>
                                                <td style='padding: 12px; border: 1px solid #ddd; text-align: center;'>" . htmlspecialchars($present_percentage) . "%</td>
                                                <td style='padding: 12px; border: 1px solid #ddd; text-align: center;'>" . htmlspecialchars($absent_percentage) . "%</td>
                                                <td style='padding: 12px; border: 1px solid #ddd; text-align: center;'><a  href='viewinchart.php'>Pie Chart</a></td>
                                            </tr>";
                                    }
                                    echo "</table>";
                                } else {
                                    echo "<p style='text-align: center; font-family: Arial, sans-serif; color: #888;'>No attendance records found.</p>";
                                }

                                // Close the database connection
                                $conn->close();
                                ?>
                                
                            </div><!--//tab-content-->
                        </div><!--//container-fluid-->
                    </div><!--//app-content-->
                    <?php require('../studentdb/includes/footer.php'); ?>
                </div>
            </div>
        </div>
    </div>
</body>
