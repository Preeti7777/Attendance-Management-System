<?php
include 'db_connect.php'; // Include the database connection code

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_id = $_POST['course_id'];
    $date = $_POST['date'];

    $sql = "SELECT s.s_name, s.red_id, SUM(a.status = 'present') AS total_present, 
               SUM(a.status = 'absent') AS total_absent  
            FROM attendance a
            JOIN students s ON a.std_id = s.id
            WHERE a.class_id = '$course_id'
            GROUP BY s.reg_id
            ORDER BY s.s_name";

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
            include 'db_connect.php'; // Include the database connection code
            $courses_query = "SELECT * FROM courses";
            $courses_result = $conn->query($courses_query);
            if ($courses_result->num_rows > 0) {
                while ($row = $courses_result->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['course_name'] . "</option>";
                }
            }
            $conn->close();
            ?>
        </select><br><br>

        <input type="submit" value="View Attendance">
    </form>
</body>
</html>
