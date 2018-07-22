<?php

include 'auth.php';
include 'db_connect.php';
include 'functions.php';

$title = "Aktivnosti";

$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
	if (isset($_POST['mjesec']) && is_numeric($_POST['mjesec']) && $_POST['mjesec'] > 0 && $_POST['mjesec'] <= 12) {
		$mjesec = escape($_POST['mjesec']);
		$mjesec = sprintf("%02d", $mjesec);
	} else {
	}

	if (isset($_POST['god']) && is_numeric($_POST['god']) && $_POST['god'] > 1990 && $_POST['god'] <= date("Y")) {
		$god = escape($_POST['god']);
	} else {
		$errors['godina'] = "Godina nije validna";
	}
}

?>

<?php include 'layouts/header.php'; ?>
	<title><?php echo $title; ?></title>
</head>
<body class="bg-primary">
	<?php include 'layouts/nav.php'; ?>
	<div class="container py-5">
		<div class="text-center text-white">
			<h1 class="mb-5">Aktivnosti</h1>
		</div>

		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
			<div class="form-row">
				<div class="col-3">
					<?php
						if(isset($mjesec) && isset($god)) {
					?>
						<p>Pretraga za <?php echo escape($mjesec); ?>.<?php echo escape($god); ?>.</p>
					<?php
						} elseif (isset($god)) {
					?>
						<p>Pretraga za <?php echo escape($god); ?>.</p>
					<?php
						} else {
					?>
						<p>Pretraga: </p>
					<?php
						}
					?>
				</div>
				<div class="col-3">
					<select name="mjesec" class="form-control">
						<option value="">Mjesec</option>
						<?php 
							for ($i = 1; $i <= 12; $i++){
						?>
								<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						<?php
							}
						?>
					</select>
				</div>
				<div class="col-3">
					<select name="god" class="form-control">
						<option value="">Godina</option>
						<?php 
							for ($i = 1991; $i <= date("Y"); $i++) {
						?>
								<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						<?php
							}
						?>
					</select>
				</div>
				<div class="col-3">
					<input type="submit" name="submit" class="btn btn-outline-light">
				</div>
			</div>
		</form>

		<table class="table table-hover table-dark rounded mt-5">
			<thead class="thead-light">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Korisnik</th>
					<th scope="col">Radnik</th>
					<th scope="col">Aktivnost</th>
					<th scope="col">Komentar</th>
					<th scope="col">Završeno</th>
					<th scope="col">Datum unosa</th>
					<th scope="col">Datum završavanja</th>
					<th scope="col">Opcije</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$sql = "SELECT * FROM aktivnosti";
					$result = mysqli_query($conn, $sql) or trigger_error(mysql_error());

					if (mysqli_num_rows($result) > 0) {
					    while($row = mysqli_fetch_assoc($result)) {
					    	if (!empty($god) && !empty($mjesec)) {
					    		$datum = date("Y-m", strtotime($row['datum_unosa']));
					    		$dat = "{$god}-{$mjesec}";
					    		strtotime($dat);
					    		if ($datum == $dat) {
				?>

					<?php include 'uslov-godina.php'; ?>

				<?php } } elseif (!empty($god) && empty($mjesec)) {
							$datum = date("Y", strtotime($row['datum_unosa']));
				    		if ($datum == $god) {
    			?>

					<?php include 'uslov-godina.php'; ?>

				<?php } } elseif (!empty($mjesec) && empty($god)) { ?>
				<?php } else { ?>

					<?php include 'uslov-godina.php'; ?>
					
				<?php } } } ?>
			</tbody>
		</table>
	</div>
	<?php include 'layouts/footer.php'; ?>