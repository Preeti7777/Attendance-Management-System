
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
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $course_id = $_POST['course_id'];
        // $date = $_POST['date'];
    
        $sql = "SELECT c.name, SUM(a.status = 'present') AS p, 
                SUM(a.status = 'absent') AS a,
                SUM(a.status IN ('present', 'absent')) AS total_class  
                FROM courses c
                JOIN attendance a ON a.course_id = c.id
                WHERE a.course_id = '$course_id' && a.std_id='$student_id' ";
    
        $result = $conn->query($sql);
    
        // Your PHP logic for fetching attendance records remains unchanged.
        if ($result->num_rows > 0) {
            echo "<table style='border-collapse: collapse; width: 100%; max-width: 800px; margin: 20px auto; font-family: Arial, sans-serif; box-shadow: 0px 0px 10px rgba(0,0,0,0.1);'>
                    <tr style='background-color: #f2f2f2;'>
                        <th style='padding: 12px; border: 1px solid #ddd;'>Course Name</th>
                        <th style='padding: 12px; border: 1px solid #ddd;'>Total Present</th>
                        <th style='padding: 12px; border: 1px solid #ddd;'>Total Absent</th>
                        <th style='padding: 12px; border: 1px solid #ddd;'>Total Class</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td style='padding: 12px; border: 1px solid #ddd; text-align: center;'>" . htmlspecialchars($row['name']) . "</td>
                        <td style='padding: 12px; border: 1px solid #ddd; text-align: center;'>" . htmlspecialchars($row['p']) . "</td>
                        <td style='padding: 12px; border: 1px solid #ddd; text-align: center;'>" . htmlspecialchars($row['a']) . "</td>
                        <td style='padding: 12px; border: 1px solid #ddd; text-align: center;'>" . htmlspecialchars($row['total_class']) . "</td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "<p style='text-align: center; font-family: Arial, sans-serif; color: #888;'>No attendance records found for the selected class and date.</p>";
        }
    }
        $conn->close();
    ?>
    
    <!DOCTYPE html>
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
                max-width: 500px;
                margin: 20px auto;
                background: #fff;
                padding: 20px;
                box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
                border-radius: 8px;
            }
            label {
                font-weight: bold;
                color: #555;
            }
            select, input[type="submit"] {
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
                background: #fff;
                margin-top: 20px;
            }
            th, td {
                text-align: center;
            }
        </style>
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
    </body>
    </html>
    
	


				</div><!--//tab-content-->



			</div><!--//container-fluid-->
		</div><!--//app-content-->



		<?php require('../studentdb/includes/footer.php'); ?>