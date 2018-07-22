<?php

session_start();
if (!isset($_SESSION['login_user'])){
	header("Location: login.php");
	session_unset();
	session_destroy();
	exit();
}

?>