<?php

session_start();
if (!isset($_SESSION['user_name'])){
	header("Location: login.php");
	session_unset();
	session_destroy();
	exit();
}

?>