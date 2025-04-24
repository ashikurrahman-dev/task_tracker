<?php 

session_start();
unset($_SESSION["user"]);
header("Location:  http://task_tracker.test/views/auth/login.php");
exit();