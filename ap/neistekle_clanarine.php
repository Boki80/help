<?php
include 'auth.php';
include 'db_connect.php';
include 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
	if (isset($_POST['dani']) && !empty($_POST['dani']) && is_numeric($_POST['dani'])) {
		$dani = escape($_POST['dani']);
		$id = escape($_POST['id']);
		$datum_isteka = $_POST['datum_isteka'];
		$date = date_create($datum_isteka);
		date_add($date,date_interval_create_from_date_string("{$dani} days"));
		$dt = date_format($date, 'Y-m-d');
	} else {
		$errors['dani'] = "Dani nisu validni.";
	}
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit']) && empty($errors)) {
	$sql2 = "UPDATE clanarine ";
	$sql2 .= "SET datum_isteka = '{$dt}' ";
	$sql2 .= "WHERE korisnik = $id";

	$res2 = mysqli_query($conn, $sql2);

	if (!$res2) {
		die("Neuspješan upis." . mysqli_error($conn));
	}
}

?>

<?php include 'layouts/header.php'; ?>
	<title>HELP AP - Članarine koje nisu pri isteku</title>
</head>
<body class="bg-primary">
	<?php include 'layouts/nav.php'; ?>
	<div class="container py-5">
		<div class="text-center text-white">
			<h1 class="mb-5">Članarine koje nisu pri isteku</h1>
		</div>
		<table class="table table-hover table-dark rounded">
			<thead class="thead-light">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Ime</th>
					<th scope="col">Prezime</th>
					<th scope="col">Aktivan</th>
					<th scope="col">Datum isteka paketa</th>
					<th scope="col">Telefon</th>
					<th scope="col">Opcije</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$sql = "SELECT id, korisnik, datum_isteka FROM clanarine ";
					$sql .= "WHERE datum_isteka > CURDATE() AND datum_isteka > CURDATE() + INTERVAL 7 DAY";
					$result = mysqli_query($conn, $sql) or trigger_error(mysql_error());

					if (mysqli_num_rows($result) > 0) {
					    // output data of each row
					    while($row = mysqli_fetch_assoc($result)) {
					    	$korisnik = $row['korisnik'];
				?>
				<tr>
					<th scope="row"><?php echo $korisnik; ?></th>
					<?php
						$sql = "SELECT ime, prezime, aktivan, telefon FROM users ";
						$sql .= "WHERE id = $korisnik";

						$res = mysqli_query($conn, $sql);

						if (mysqli_num_rows($res) > 0) {
							$row2 = mysqli_fetch_assoc($res);
						} else {
							die ("Došlo je do greške.");
						}
					?>
					<td><?php echo ucfirst($row2["ime"]); ?></td>
					<td><?php echo ucfirst($row2["prezime"]); ?></td>
					<td><?php if ($row2["aktivan"] == 1) { echo "Da"; } else { echo "Ne"; } ?></td>
					<td><?php echo $row['datum_isteka']; ?></td>
					<td><?php echo $row2["telefon"]; ?></td>
					<td>
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class="form-inline">
						<a href="profil.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-light"role="button">Profil</a> &nbsp;
							<input type="number" name="id" value="<?php echo $row["id"]; ?>" hidden readonly>
							<input type="text" name="datum_isteka" value="<?php echo $dat_ist; ?>" hidden readonly>
							<input type="number" class="form-control-sm" name="dani" placeholder="Produži (dani)">
							<input type="submit" class="btn btn-sm btn-primary" name="submit" value="Produži">
						</form>
					</td>
				</tr>
				<?php } } ?>
			</tbody>
		</table>
	</div>
	<?php include 'layouts/footer.php'; ?>