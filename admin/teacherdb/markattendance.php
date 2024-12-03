<?php require('../teacherdb/includes/header.php'); ?>

<body class="app">
    <?php require('../teacherdb/includes/navbar.php'); ?>
    <?php require('../teacherdb/includes/sidebar.php'); ?>
    <div class="app-wrapper">

    <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="tab-content" id="orders-table-tab-content">
                    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                        <div class="app-card app-card-orders-table shadow-sm mb-5">
                            <div class="app-card-body">
                                <div class="p-4">
                                <div class="m-4">
                                <div class="mt-4">
                                <div class="mb-4">
                                </div><!--//tab-pane-->

                                <?php
                                // Fetch students for the form
                                $students = "SELECT * FROM students ORDER BY name ASC";
                                $students_result = $conn->query($students);

                                // Fetch only the courses assigned to the teacher
                                $courses = "SELECT c.id, c.name 
                                            FROM courses c 
                                            JOIN teachers t ON t.id = c.teacher_id
                                            WHERE t.id = ?"; // Fetch courses based on teacher's ID
                                $stmt_courses = $conn->prepare($courses);
                                $stmt_courses->bind_param("i", $teacher_id);
                                $stmt_courses->execute();
                                $courses_result = $stmt_courses->get_result();

                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    $course_id = $_POST['course_id'];
                                    $date = $_POST['date'];

                                    if ($date !== date('Y-m-d')) {
                                        echo "Attendance can only be taken for today.";
                                        exit; // Stop further execution if the date is not today
                                    }
                                    $stmt_check = $conn->prepare("SELECT COUNT(*) FROM attendance WHERE course_id = ? AND date = ?");
                                    $stmt_check->bind_param("is", $course_id, $date);
                                    $stmt_check->execute();
                                    $stmt_check->bind_result($count);
                                    $stmt_check->fetch();
                                    $stmt_check->close();

                                    // If attendance has already been recorded for today
                                    if ($count > 0) {
                                        echo "<script>
                                                    window.onload = function() {
                                                        alert('Attendance has already been taken.');
                                                        window.location.href = 'markattendance.php'; // 
                                                    };
                                                </script>";
                                        exit; // Stop further execution if attendance is already recorded
                                    }

                                    // Prepare the statement for inserting attendance records
                                    $stmt = $conn->prepare("INSERT INTO attendance (std_id, course_id, date, status) VALUES (?, ?, ?, ?)");

                                    foreach ($_POST['attendance'] as $std_id => $status) {
                                        // Bind the parameters and execute the statement
                                        $stmt->bind_param("iiss", $std_id, $course_id, $date, $status);
                                        if (!$stmt->execute()) {
                                            echo "Error: " . $stmt->error . "<br>";
                                        }
                                    }
                                    if ($stmt) {
                                        echo "<script>
                                                    window.onload = function() {
                                                        alert('Attendance marked successfully.');
                                                        window.location.href = 'markattendance.php'; // 
                                                    };
                                                </script>";
                                    } else {
                                        echo '<div class="alert alert-danger">An error occurred</div>';
                                    }

                                    $stmt->close();
                                }
                                ?>

                                <!DOCTYPE html>
                                <html>

                                <head>
                                    <title>Mark Attendance</title>
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
                                        input[type="date"],
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
                                            background-color: #6c757d;
                                            color: #fff;
                                            border: none;
                                            cursor: pointer;
                                            transition: background-color 0.3s ease;
                                        }

                                        input[type="submit"]:hover {
                                            background-color: #5a6268;
                                        }

                                        table {
                                            width: 100%;
                                            border-collapse: collapse;
                                            margin-top: 20px;
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

                                        .radio-group {
                                            display: flex;
                                            gap: 10px;
                                        }
                                    </style>
                                </head>

                                <body>
                                    <h2>Mark Attendance</h2>
                                    <form method="post" action="">
                                        <label for="course_id">Class:</label>
                                        <select name="course_id" required>
                                            <option value="" disabled selected>Select a class</option>
                                            <?php
                                            if ($courses_result->num_rows > 0) {
                                                while ($row = $courses_result->fetch_assoc()) {
                                                    echo "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['name']) . "</option>";
                                                }
                                            } else {
                                                echo "<option value='' disabled>No courses assigned to you</option>";
                                            }
                                            ?>
                                        </select>

                                        <label for="date">Date:</label>
                                        <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" readonly required>

                                        <table>
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
                            <td class='radio-group'>
                                <input type='radio' name='attendance[" . htmlspecialchars($row['id']) . "]' value='present' required> Present
                                <input type='radio' name='attendance[" . htmlspecialchars($row['id']) . "]' value='absent' required> Absent
                            </td>
                        </tr>";
                                                }
                                            }
                                            ?>
                                        </table>
                                        <input type="submit" value="Mark Attendance">
                                    </form>
                                </body>

                                </html>

                            </div><!--//tab-content-->
                        </div><!--//container-fluid-->
                    </div><!--//app-content-->
                    <?php require('../teacherdb/includes/footer.php'); ?>
</body>