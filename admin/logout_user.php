<?php
session_start();
session_destroy();
header("Location: ../index/roles.php?message=logout_success");
exit();
?>
