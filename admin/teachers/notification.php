<?php require('../includes/header.php'); ?>

<body class="app">
    <?php require('../includes/navbar.php'); ?>
    <?php require('../includes/sidebar.php'); ?>
    <div class="app-wrapper">

        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="app-card app-card-orders-table shadow-sm mb-5">
                <div class="p-3">
                <?php
                    require('../config/config.php');
                    // include 'db_connect.php'; 

                    $applications = $conn->prepare("SELECT * FROM application");
                    $applications->execute();
                    $result = $applications->get_result();
                ?>  

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <style>
        body {
            margin: 20px;
        }
        .notification {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 10px;
            background-color: #f9f9f9;
        }
        .notification h3 {
            margin: 0;
            font-size: 1.2em;
            color: #333;
        }
        .notification p {
            margin: 5px 0;
        }
        .mark-read {
            color: #007BFF;
            text-decoration: none;
            cursor: pointer;
        }
        .mark-read:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Leave Notifications</h1>
    <?php if ($result->num_rows > 0): ?>
        <?php foreach ($result as $application): ?>
            <div class="notification">
                <h3><?php echo htmlspecialchars($application['name']); ?> (<?php echo htmlspecialchars($application['email']); ?>)</h3>
                <p><strong>From:</strong> <?php echo htmlspecialchars($application['from_date']); ?></p>
                <p><strong>To:</strong> <?php echo htmlspecialchars($application['to_date']); ?></p>
                <p><strong>Reason:</strong> <?php echo htmlspecialchars($application['reason']); ?></p>
                <a class="mark-read" href="deletenotification.php?id=<?php echo $application['id']; ?>">Delete</a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No new notifications.</p>
    <?php endif; ?>
</body>
</html>
            </div><!--//container-fluid-->
        </div><!--//app-content-->

        <?php require('../includes/footer.php'); ?>
