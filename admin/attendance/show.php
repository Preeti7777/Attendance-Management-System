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

                            <?php
                            require('../config/config.php');
                            // include 'db_connect.php'; 

                            $students = "SELECT * FROM students";
                            $students_result = $conn->query($students);

                            $courses = "SELECT * FROM courses";
                            $courses_result = $conn->query($courses);
                            ?>
                            <html>

                            <head>
                                <title>View Attendance</title>
                                <style>
                                    body {
                                        font-family: Arial, sans-serif;
                                        background-color: #f9f9f9;
                                        margin: 0;
                                        padding: 0;
                                    }

                                    h2 {
                                        text-align: center;
                                        color: #333;
                                        margin-top: 30px;
                                    }

                                    form {
                                        max-width: 600px;
                                        margin: 20px auto;
                                        background: #fff;
                                        padding: 20px;
                                        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                                        border-radius: 8px;
                                    }

                                    label {
                                        font-weight: bold;
                                        color: #555;
                                        display: block;
                                        margin-bottom: 8px;
                                    }

                                    select,
                                    input[type="submit"] {
                                        width: 100%;
                                        padding: 10px;
                                        margin-top: 10px;
                                        margin-bottom: 20px;
                                        border: 1px solid #ddd;
                                        border-radius: 4px;
                                        box-sizing: border-box;
                                        font-size: 16px;
                                    }

                                    input[type="submit"] {
                                        background-color: #6f9cde;
                                        color: #fff;
                                        border: none;
                                        cursor: pointer;
                                        transition: background-color 0.3s ease;
                                    }

                                    input[type="submit"]:hover {
                                        background-color: #6879d0;
                                    }

                                    table {
                                        width: 100%;
                                        border-collapse: collapse;
                                        margin-top: 20px;
                                        background: #fff;
                                        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                                    }

                                    th,
                                    td {
                                        padding: 12px;
                                        border: 1px solid #ddd;
                                        text-align: left;
                                    }

                                    th {
                                        background-color: #f2f2f2;
                                    }

                                    tr:nth-child(even) {
                                        background-color: #f9f9f9;
                                    }

                                    .no-records {
                                        text-align: center;
                                        font-size: 16px;
                                        color: #888;
                                        margin-top: 20px;
                                    }
                                    .chart-container {
                                        width: 100px;  /* Adjust size */
                                        height: 100px; /* Adjust size */
                                        margin: 0 auto;
                                    }
                                </style>
                                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                            </head>

                            <body>
                                <h2>View Attendance</h2>
                                <form method="post" action="">
                                    <label for="course_id">Class:</label>
                                    <select name="course_id" required>
                                        <option value="" disabled selected>Select a class</option>
                                        <?php
                                        if ($courses_result->num_rows > 0) {
                                            while ($row = $courses_result->fetch_assoc()) {
                                                echo "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['name']) . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>

                                    <input type="submit" value="View Attendance">
                                </form>

<?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $course_id = $_POST['course_id'];
        $course_name_query = "SELECT name FROM courses WHERE id = '$course_id'";
        $course_name_result = $conn->query($course_name_query);

        if ($course_name_result && $course_name_result->num_rows > 0) {
            $course_name = $course_name_result->fetch_assoc()['name'];
        } else {
            $course_name = "Unknown Course";
        }


        // Query to fetch attendance data for the selected course
        $sql = "SELECT s.name, s.reg_id, SUM(a.status = 'present') AS total_present, 
                   SUM(a.status = 'absent') AS total_absent,
                   SUM(a.status IN ('present', 'absent')) AS total_class
                FROM attendance a
                JOIN students s ON a.std_id = s.id
                WHERE a.course_id = '$course_id'
                GROUP BY s.reg_id
                ORDER BY s.name";

        $result = $conn->query($sql);

        echo "<h3 style='text-align: center; color: #444; font-size: 24px; margin-top: 20px; margin-bottom: 30px;'>
        Attendance for Course: <strong style='color: #007bff;'>" . htmlspecialchars($course_name) . "</strong>
      </h3>";


        if ($result->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>Student Name</th>
                        <th>Registration Number</th>
                        <th>Total Present</th>
                        <th>Total Absent</th>
                        <th>Total Class</th>
                        <th>Present Percentage</th>
                        <th>Absent Percentage</th>
                        <th>Attendance Pie Chart</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                // Calculate present and absent percentages
                $total_classes = $row['total_class'];
                $present_percentage = ($total_classes > 0) ? ($row['total_present'] / $total_classes) * 100 : 0;
                $absent_percentage = 100 - $present_percentage;

                // Create the pie chart data
                $pie_data = json_encode([round($present_percentage, 2), round($absent_percentage, 2)]);

                echo "<tr>
                        <td>" . htmlspecialchars($row['name']) . "</td>
                        <td>" . htmlspecialchars($row['reg_id']) . "</td>
                        <td>" . $row['total_present'] . "</td>
                        <td>" . $row['total_absent'] . "</td>
                        <td>" . $total_classes . "</td>
                        <td>" . round($present_percentage, 2) . "%</td>
                        <td>" . round($absent_percentage, 2) . "%</td>
                        <td>
                            <div class='chart-container'>
                                <canvas id='pieChart_" . $row['reg_id'] . "'></canvas>
                            </div>
                            <script>
                                var ctx = document.getElementById('pieChart_" . $row['reg_id'] . "').getContext('2d');
                                var myPieChart = new Chart(ctx, {
                                    type: 'pie',
                                    data: {
                                        labels: ['Present', 'Absent'],
                                        datasets: [{
                                            data: $pie_data,
                                            backgroundColor: ['#4CAF50', '#F44336'],
                                        }]
                                    }
                                });
                            </script>
                        </td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "<div class='no-records'>No attendance records found for the selected class.</div>";
        }
    }
    
    $conn->close();
    ?>
</body>
</html>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</html>
<?php require('../includes/footer.php'); ?>