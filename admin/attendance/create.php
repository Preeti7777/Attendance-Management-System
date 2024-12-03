<?php
require('../config/config.php'); // Include the database connection code

// Fetch students and classes for the form
$students_query = "SELECT * FROM students";
$students_result = $conn->query($students_query);

$coures_query = "SELECT * FROM courses";
$courses_result = $conn->query($courses_query);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_id = $_POST['course_id'];
    $date = $_POST['date'];

    foreach ($_POST['attendance'] as $reg_id => $status) {
        $sql = "INSERT INTO attendance (std_id, course_id, date, status) VALUES ('$std_id', '$course_id', '$date', '$status')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iisi', $std_id, $course_id, $date, $status);
    }

    echo "Attendance marked successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mark Attendance</title>
</head>
<body>
    <h2>Mark Attendance</h2>
    <form method="post" action="">
        <label for="course_id">Class:</label>
        <select name="course_id" required>
            <?php
            if ($courses_result->num_rows > 0) {
                while ($row = $courses_result->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                }
            }
            ?>
        </select><br><br>

        <label for="date">Date:</label>
        <input type="date" name="date" required><br><br>

        <table border="1">
            <tr>
                <th>Student Name</th>
                <th>Register Number</th>
                <th>Attendance</th>
            </tr>
            <?php
            if ($students_result->num_rows > 0) {
                while ($row = $students_result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['name']) . "</td>
                            <td>" . htmlspecialchars($row['reg_id']) . "</td>
                            <td>
                                <input type='radio' name='attendance[" . $row['id'] . "]' value='1' required> Present
                                <input type='radio' name='attendance[" . $row['id'] . "]' value='0' required> Absent
                            </td>
                        </tr>";
                }
            }
            ?>
        </table><br>
        <input type="submit" value="Mark Attendance">
    </form>
</body>
</html>
