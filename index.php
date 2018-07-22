<?php

include 'ap/functions.php';
include 'ap/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	if (isset($_POST['mail']) && !empty($_POST['mail']) && filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
		$mail = escape($_POST['mail']);

		$sql = "INSERT INTO bilten (mail) VALUES ('{$mail}')";

		$result = mysqli_query ($conn, $sql) or trigger_error(mysql_error());

		if (!$result) {
			$errors['conn'] = "Došlo je do greške.";
		}
	} else {
		$errors['mail'] = "Mail nije validan.";
	}
}

include 'layouts/header.php';
include 'layouts/nav2.php';
include 'layouts/nav.php';
include 'layouts/carousel.php';
include 'layouts/registracija.php';
include 'layouts/paketi.php';
include 'layouts/headings.php';
include 'layouts/vijest.php';
include 'layouts/fb.php';
include 'layouts/sponzori.php';
include 'layouts/bilten.php';
include 'layouts/footer.php';

?>