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
							<div class="app-card-body">
							<div class="p-3">
					</div><!--//tab-pane-->
					
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            width: 100%;
            max-width: 400px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        .form-group textarea {
            resize: vertical;
        }
        .btn {
            display: block;
            width: 100%;
            padding: 10px;
            font-size: 16px;
            color: #fff;
            background-color: grey;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: black;
        }
    </style>
</head>
<?php
	$select ="SELECT * FROM students WHERE id=$student_id";
	$result=mysqli_query($conn,$select);
	$data=mysqli_fetch_assoc($result);
 ?>
  <?php
    if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $fromdate = $_POST['fromdate'];
    $todate = $_POST['todate'];
    $reason = $_POST['reason'];

    if ($name == "" || $email == "" || $fromdate == "" || $todate == "" || $reason == "") {
        echo "<div class='alert alert-danger'>All fields are required</div>";
                                        // header("Refresh:2;URL=create.php");
        echo "<meta http-equiv=\"refresh\" content=\"2;URL=application.php\">";
    } else {
        $sql = "INSERT INTO application ( name, email, from_date, to_date, reason) VALUES ( '$name', '$email', '$fromdate', '$todate','$reason')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo '<div class="alert alert-success">Application sent!!</div>';
                                            // header("Location: index.php");
            echo "<meta http-equiv=\"refresh\" content=\"2;URL=application.php\">";
        } else {
            echo '<div class="alert alert-danger">An error occurred</div>';
        }
        }
    }
    $conn->close();
    ?>
<body>

<div class="form-container">
    <h2>Application Form</h2>
    <form id="applicationForm" onsubmit="return validateForm()" method="POST">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?php echo $data['name'];?>">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo $data['email'];?>">
        </div>
        <div class="form-group">
            <label for="fromdate">From Date</label>
            <input type="date" id="fromdate" name="fromdate" required>
        </div>
        <div class="form-group">
            <label for="todate">To Date</label>
            <input type="date" id="todate" name="todate" required>
        </div>
        <div class="form-group">
            <label for="reason">Reason</label>
            <textarea id="reason" name="reason" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn" name="save">Submit</button>
    </form>
</div>

<script>
    // Set 'fromdate' min attribute to today's date
    document.getElementById("fromdate").setAttribute("min", new Date().toISOString().split("T")[0]);

    function validateForm() {
        const fromDate = document.getElementById("fromdate").value;
        const toDate = document.getElementById("todate").value;
        const today = new Date().toISOString().split("T")[0];

        // Check if 'fromdate' is before today
        if (fromDate < today) {
            alert("From Date cannot be before today's date.");
            return false;
        }

        // Check if 'fromdate' is before or equal to 'todate'
        if (new Date(fromDate) > new Date(toDate)) {
            alert("From Date cannot be after To Date.");
            return false;
        }
    }
</script>

</body>
</html>



				</div><!--//tab-content-->



			</div><!--//container-fluid-->
		</div><!--//app-content-->



		<?php require('../studentdb/includes/footer.php'); ?>