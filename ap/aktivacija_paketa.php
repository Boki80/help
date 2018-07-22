<?php

include 'auth.php';
include 'db_connect.php';
include 'functions.php';

if (access(2)) {
$errors = array();
$korisnik = $radnik = "";
$permisije = $trajanje = 0;
$datum = date('Y-m-d H:i:s');

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
	if (isset($_POST['korisnik']) && !empty($_POST['korisnik']) && $_POST['korisnik'] >= 0) {
		$korisnik = escape($_POST['korisnik']);
	} else {
		$errors['korisnik'] = "Korisnik nije validan.";
	}

	if (isset($_POST['radnik']) && !empty($_POST['radnik']) && $_POST['radnik'] >= 0) {
		$radnik = escape($_POST['radnik']);
	} else {
		$errors['radnik'] = "Radnik nije validan.";
	}

	if (isset($_POST['uplata']) && !empty($_POST['uplata']) && $_POST['uplata'] >= 0) {
		$uplata = escape($_POST['uplata']);
	} else {
		$errors['uplata'] = "Uplata nije validan.";
	}

	if (isset($_POST['paket']) && !empty($_POST['paket']) && $_POST['paket'] > 0 && $_POST['paket'] < 6) {
		$paket = escape($_POST['paket']);
	} else {
		$errors['paket'] = "Paket nije validan.";
	}

	if (isset($_POST['trajanje']) && !empty($_POST['trajanje'])) {
		$trajanje = escape($_POST['trajanje']);
	} else {
		$errors['trajanje'] = "Trajanje nije validno.";
	}

	$date = date_create(date('Y-m-d'));
	date_add($date,date_interval_create_from_date_string("{$trajanje} days"));
	$dt = date_format($date, 'Y-m-d');

	$sql = "SELECT korisnik FROM clanarine ";
	$sql .= "WHERE korisnik = $korisnik";

	$res = mysqli_query($conn, $sql);
}

if (isset($_POST['submit']) && empty($errors) && mysqli_num_rows($res) == 1) {
	$sql = "INSERT INTO istorija_uplata (";
	$sql .= "korisnik, radnik, uplata, datum, datum_isteka";
	$sql .= ") VALUES (";
	$sql .= "'{$korisnik}', '{$radnik}', '{$uplata}', '{$datum}', '{$dt}')";

	$res = mysqli_query($conn, $sql);

	if(!$res) {
		die("Neuspješan upis." . mysqli_error($conn));
	}

	$sql = "UPDATE clanarine ";
	$sql .= "SET radnik = $radnik, uplata = $uplata, paket = $paket, datum_uplate = '{$datum}', datum_isteka = '{$dt}' ";
	$sql .= "WHERE korisnik = $korisnik";

	$res = mysqli_query($conn, $sql);

	if(!$res) {
		die("Neuspješan upis." . mysqli_error($conn));
	}

	$sql = "SELECT ukupne_uplate ";
	$sql .= "FROM users ";
	$sql .= "WHERE id = $korisnik";

	$res = mysqli_query($conn, $sql);

	if(mysqli_num_rows($res) == 1) {
		$row = mysqli_fetch_assoc($res);
		$ukupne_uplate = $row['ukupne_uplate'];
		$ukupno = $ukupne_uplate + $uplata;
	} else {
		die("Neuspješan upis." . mysqli_error($conn));
	}

	$sql = "UPDATE users ";
	$sql .= "SET ukupne_uplate = $ukupno ";
	$sql .= "WHERE id = $korisnik";

	$res = mysqli_query($conn, $sql);

	if (!$res) {
		die("Neuspješan upis." . mysqli_error($conn));
	}
} elseif (isset($_POST['submit']) && empty($errors) && mysqli_num_rows($res) == 0) {
	$sql = "INSERT INTO istorija_uplata (";
	$sql .= "korisnik, radnik, uplata, datum, datum_isteka";
	$sql .= ") VALUES (";
	$sql .= "'{$korisnik}', '{$radnik}', '{$uplata}', '{$datum}', '{$dt}')";

	$res = mysqli_query($conn, $sql);

	if(!$res) {
		die("Neuspješan upis." . mysqli_error($conn));
	}

	$sql = "INSERT INTO clanarine (";
	$sql .= "korisnik, radnik, uplata, paket, datum_uplate, datum_isteka";
	$sql .= ") VALUES (";
	$sql .= "'{$korisnik}', '{$radnik}', '{$uplata}', '{$paket}', '{$datum}', '{$dt}')";

	$res = mysqli_query($conn, $sql);

	if(!$res) {
		die("Neuspješan upis." . mysqli_error($conn));
	}

	$sql = "SELECT ukupne_uplate ";
	$sql .= "FROM users ";
	$sql .= "WHERE id = $korisnik";

	$res = mysqli_query($conn, $sql);

	if(mysqli_num_rows($res) == 1) {
		$row = mysqli_fetch_assoc($res);
		$ukupne_uplate = $row['ukupne_uplate'];
		$ukupno = $ukupne_uplate + $uplata;
	} else {
		die("Neuspješan upis." . mysqli_error($conn));
	}

	$sql = "UPDATE users ";
	$sql .= "SET ukupne_uplate = $ukupno ";
	$sql .= "WHERE id = $korisnik";

	$res = mysqli_query($conn, $sql);

	if (!$res) {
		die("Neuspješan upis." . mysqli_error($conn));
	}
} elseif (isset($_POST['submit']) && empty($errors) && mysqli_num_rows($res) > 1) {
	die("Došlo je do greške." . mysqli_error($conn));
}

?>

<?php include 'layouts/header.php'; ?>
	<title>HELP AP - Aktivacija paketa</title>
</head>
<body class="bg-primary">
	<?php include 'layouts/nav.php'; ?>
	<div class="container py-5">
		<div class="text-center text-white">
				<h1 class="mb-5">Aktivacija paketa</h1>
			</div>
		<form id="raspored" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
			<table class="table table-dark rounded">
				<tr>
					<td>Korisnik</td>
					<td>
						<select class="form-control" name="korisnik">
							<?php 
								$qry = "SELECT id, ime, prezime, permisije FROM users ";
								$qry .= "WHERE permisije = 1";

								$res = mysqli_query($conn, $qry);

								if (mysqli_num_rows($res) > 0) {
									while ($row = mysqli_fetch_assoc($res)) {
							?>
								<option value="<?php echo $row['id']; ?>" <?php if(!empty($errors) && $korisnik === "1") { echo "selected"; } ?>><?php echo $row['id'] . " " . $row['ime'] . " " . $row['prezime']; ?></option>
							<?php
									}
								} else {
									$errors['db'] = "Došlo je do greške pri povezivanju sa bazom podataka.";
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Radnik</td>
					<td>
						<select class="form-control" name="radnik">
							<?php 
								$qry = "SELECT id, ime, prezime, permisije FROM users ";
								$qry .= "WHERE permisije > 1";

								$res = mysqli_query($conn, $qry);

								if (mysqli_num_rows($res) > 0) {
									while ($row = mysqli_fetch_assoc($res)) {
							?>
								<option value="<?php echo $row['id']; ?>" <?php if(!empty($errors) && $permisije === "1") { echo "selected"; } ?>><?php echo $row['id'] . " " . $row['ime'] . " " . $row['prezime']; ?></option>
							<?php
									}
								} else {
									$errors['db2'] = "Došlo je do greške pri povezivanju sa bazom podataka.";
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Uplata (KM)</td>
					<td><input type="number" name="uplata" class="form-control" value="<?php if(!empty($errors)) { echo $uplata; } else { echo ""; } ?>"></td>
				</tr>
				<tr>
					<td>Paket</td>
					<td>
						<select class="form-control" name="paket" id="paket">
							<option value="0"></option>
							<option value="1" <?php if(!empty($errors) && $paket === "1") { echo "selected"; } ?>>L</option>
							<option value="2" <?php if(!empty($errors) && $paket === "2") { echo "selected"; } ?>>X</option>
							<option value="3" <?php if(!empty($errors) && $paket === "3") { echo "selected"; } ?>>XL</option>
							<option value="4" <?php if(!empty($errors) && $paket === "4") { echo "selected"; } ?>>XXL</option>
							<option value="5" <?php if(!empty($errors) && $paket === "5") { echo "selected"; } ?>>Poseban</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Trajanje (dani)</td>
					<td><input type="number" name="trajanje" class="form-control" value="<?php if(!empty($errors)) { echo $trajanje; } else { echo ""; } ?>"></td>
				</tr>
				<tr>
					<td></td>
					<td><button type="submit" name="submit" class="btn btn-primary">Unesi</button></td>
				</tr>
				<?php if (isset($_POST['submit']) && empty($errors)) { ?>
					<tr>
						<td colspan="2">
								<div class="alert alert-success alert-dismissible fade show contact-alert mt-4" role="alert">Uspješan upis!
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								</div>
						</td>
					</tr>
				<?php } elseif (!empty($errors)) { ?>
					<tr>
						<td colspan="2">
							<div class="alert alert-danger alert-dismissible fade show contact-alert mt-4" role="alert">Neuspješan upis! <br> <?php 
								foreach ($errors as $error) {
									echo "{$error}<br>";
								} ?>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							</div>
						</td>
					</tr>
				<?php } ?>
			</table>
		</form>
	</div>
	<?php include 'layouts/footer.php'; ?>

	<?php

} else {
	header('Location: index.php');
	exit();
}