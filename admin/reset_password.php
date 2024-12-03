<?php
require('../admin/config/config.php');

if (isset($_GET['token']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_GET['token'];
    $new_password = password_hash($_POST["new_password"], PASSWORD_DEFAULT);

    $sql = "SELECT * FROM users WHERE reset_token = '$token' AND token_expiry > NOW()";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $update_sql = "UPDATE users SET password='$new_password', reset_token=NULL, token_expiry=NULL WHERE reset_token='$token'";
        if ($conn->query($update_sql)) {
            echo "Password successfully reset!";
        } else {
            echo "Error resetting password.";
        }
    } else {
        echo "Invalid or expired token.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <form method="POST">
        <input type="password" name="new_password" placeholder="Enter new password" required>
        <button type="submit">Reset Password</button>
    </form>
</body>
</html>
