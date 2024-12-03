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

                                // Query to fetch attendance details for all students across all courses
                                $sql = "SELECT c.id,c.name, SUM(a.status = 'present') AS present, 
                                SUM(a.status = 'absent') AS absent,
                                SUM(a.status IN ('present', 'absent')) AS total_class  
                                FROM courses c
                                JOIN attendance a ON a.course_id = c.id
                                WHERE a.std_id='$student_id'
                                GROUP BY  c.id";
                                
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    echo "<h2>All Courses Attendance Records</h2>";
                                    echo "<table style='border-collapse: collapse; width: 100%; max-width: 800px; margin: 20px auto; font-family: Arial, sans-serif; box-shadow: 0px 0px 10px rgba(0,0,0,0.1);'>
                                            <tr style='background-color: #f2f2f2;'>
                                                <th style='padding: 12px; border: 1px solid #ddd;'>Course Name</th>
                                                <th style='padding: 12px; border: 1px solid #ddd;'>Total Present</th>
                                                <th style='padding: 12px; border: 1px solid #ddd;'>Total Absent</th>
                                                <th style='padding: 12px; border: 1px solid #ddd;'>Total Classes</th>
                                                <th style='padding: 12px; border: 1px solid #ddd;'>Attendance Chart</th>
                                            </tr>";

                                    // Loop through each course and display attendance with pie chart
                                    $chartData = [];
                                    while ($row = $result->fetch_assoc()) {
                                        $course_name = $row['name'];
                                        $total_class = $row['total_class'];
                                        $present = $row['present'];
                                        $absent = $row['absent'];

                                        // Calculate percentages
                                        $present_percentage = ($total_class > 0) ? round(($present / $total_class) * 100, 2) : 0;
                                        $absent_percentage = 100 - $present_percentage;

                                        // Generate unique chart ID for each course
                                        $chartId = "chart_" . $row['id'];
                                        $chartData[] = [
                                            'chartId' => $chartId,
                                            'present_percentage' => $present_percentage,
                                            'absent_percentage' => $absent_percentage,
                                            'course_name' => $course_name,
                                        ];

                                        echo "<tr>
                                                <td style='padding: 12px; border: 1px solid #ddd; text-align: center;'>" . htmlspecialchars($course_name) . "</td>
                                                <td style='padding: 12px; border: 1px solid #ddd; text-align: center;'>" . htmlspecialchars($present) . "</td>
                                                <td style='padding: 12px; border: 1px solid #ddd; text-align: center;'>" . htmlspecialchars($absent) . "</td>
                                                <td style='padding: 12px; border: 1px solid #ddd; text-align: center;'>" . htmlspecialchars($total_class) . "</td>
                                                <td style='padding: 12px; border: 1px solid #ddd; text-align: center;'>
                                                    <canvas id='" . htmlspecialchars($chartId) . "' width='150' height='150'></canvas>
                                                </td>
                                            </tr>";
                                    }
                                    echo "</table>";
                                } else {
                                    echo "<p style='text-align: center; font-family: Arial, sans-serif; color: #888;'>No attendance records found.</p>";
                                }

                                $conn->close();
                                ?>

                                <!-- Chart.js Library -->
                                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                                <script>
                                    // Data for each course's chart
                                    var chartData = <?php echo json_encode($chartData); ?>;

                                    // Render each chart for each course
                                    chartData.forEach(function(data) {
                                        var ctx = document.getElementById(data.chartId).getContext('2d');
                                        new Chart(ctx, {
                                            type: 'pie',
                                            data: {
                                                labels: ["Present (" + data.present_percentage + "%)", "Absent (" + data.absent_percentage + "%)"],
                                                datasets: [{
                                                    data: [data.present_percentage, data.absent_percentage],
                                                    backgroundColor: ["#4CAF50", "#FF5722"],
                                                }]
                                            },
                                            options: {
                                                responsive: true,
                                                plugins: {
                                                    legend: {
                                                        position: 'top',
                                                    },
                                                    tooltip: {
                                                        callbacks: {
                                                            label: function(tooltipItem) {
                                                                return tooltipItem.label;
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require('../studentdb/includes/footer.php'); ?>
</body>
</html>
