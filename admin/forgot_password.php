<?php
require('config/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $reset_token = bin2hex(random_bytes(50));
        $expiry_time = date("Y-m-d H:i:s", strtotime('+1 hour'));

        $update_sql = "UPDATE users SET reset_token='$reset_token', token_expiry='$expiry_time' WHERE email='$email'";
        if ($conn->query($update_sql)) {
            $reset_link = "http://yourwebsite.com/reset_password.php?token=$reset_token";
            mail($email, "Password Reset", "Click here to reset your password: $reset_link");
            echo "Password reset link has been sent to your email.";
        } else {
            echo "Error updating token.";
        }
    } else {
        echo "Email not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
</head>
<body>
    <form method="POST">
        <input type="email" name="email" placeholder="Enter your email" required>
        <button type="submit">Request Reset</button>
    </form>
</body>
</html>
