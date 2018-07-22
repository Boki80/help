<?php

include 'auth.php';
include 'db_connect.php';
include 'layouts/header.php';

$sql = "SELECT * FROM clanarine ";
$sql .= "WHERE datum_isteka > CURDATE() AND datum_isteka < CURDATE() + INTERVAL 7 DAY";

$result = mysqli_query($conn, $sql) or trigger_error(mysql_error());

if ($result) {
	$istice = mysqli_num_rows($result);
}

$sql = "SELECT * FROM clanarine ";
$sql .= "WHERE datum_isteka < CURDATE()";

$result = mysqli_query($conn, $sql) or trigger_error(mysql_error());

if ($result) {
	$isteklo = mysqli_num_rows($result);
}

?>

	<title>HELP Admin Panel</title>
</head>
<body>

	<?php include 'layouts/nav.php'; ?>

	<div class="py-5 bg-primary">
		<div class="container text-white">
			<h1 class="display-4 mb-5 text-center text-white"><?php echo "Help Admin Panel" ?></h1>
			<p class="h6">Isteklo je <?php echo $isteklo; ?> članarina, a pri isteku je <?php echo $istice; ?>. <a href="clanarine.php" class="btn btn-sm btn-outline-light">Produži</a></p>
		</div>
	</div>

	<?php include 'layouts/footer.php'; ?>