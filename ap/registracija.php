<?php

include 'auth.php';
include 'db_connect.php';
include 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
	if (isset($_POST['id']) && !empty($_POST['id']) && is_numeric($_POST['id'])) {
		$id = escape($_POST['id']);
	} else {
		$errors['id'] = "Dani nisu validni.";
	}
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit']) && empty($errors)) {

	$sql = "SELECT * FROM registracija ";
	$sql .= "WHERE id = $id";

	$res = mysqli_query($conn, $sql);

	if (mysqli_num_rows($res) == 1) {
		$row = mysqli_fetch_assoc($res);
	
		$ime = $row['ime'];
		$prezime = $row['prezime'];
		$email = $row['email'];
		$telefon = $row['telefon'];
		$sifra = $row['sifra'];

		$sql2 = "INSERT INTO users (ime, prezime, permisije, aktivan, datum_reg, email, sifra, telefon) ";
		$sql2 .= "VALUES ";
		$sql2 .= "('{$ime}', '{$prezime}', '1', '1', 'CURDATE()', '{$email}', '{$sifra}', '{$telefon}')";

		$res2 = mysqli_query($conn, $sql2);

		if(!$res2) {
		die("Neuspješan upis." . mysqli_error($conn));
		}

		$sql3 = "DELETE FROM registracija ";
		$sql3 .= "WHERE id = $id";

		$res3 = mysqli_query($conn, $sql3);

		if (!$res3) {
			die("Neuspješan upis." . mysqli_error($conn));
		}

	} else {
		die("Neuspješan upis." . mysqli_error($conn));
	}

}

?>

<?php include 'layouts/header.php'; ?>
	<title>HELP AP - Novi korisnici</title>
</head>
<body class="bg-primary">
	<?php include 'layouts/nav.php'; ?>
	<div class="container py-5">
		<div class="text-center text-white">
			<h1 class="mb-5">Novi korisnici</h1>
		</div>
		<table class="table table-hover table-dark rounded">
			<thead class="thead-light">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Ime</th>
					<th scope="col">Prezime</th>
					<th scope="col">Email</th>
					<th scope="col">Telefon</th>
					<th scope="col">Datum registracije</th>
					<th scope="col">Komentar</th>
					<th scope="col">Opcije</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$sql = "SELECT id, ime, prezime, email, telefon, datum_reg, komentar FROM registracija ";
					$sql .= "WHERE aktivan = 0";

					$result = mysqli_query($conn, $sql) or trigger_error(mysql_error());

					if (mysqli_num_rows($result) > 0) {
					    // output data of each row
					    while($row = mysqli_fetch_assoc($result)) {
				?>
				<tr>
					<th scope="row"><?php echo $row["id"]; ?></th>
					<td><?php echo ucfirst($row["ime"]); ?></td>
					<td><?php echo ucfirst($row["prezime"]); ?></td>
					<td><?php echo $row["email"]; ?></td>
					<td><?php echo $row["telefon"]; ?></td>
					<td><?php echo $row["datum_reg"]; ?></td>
					<td><?php echo $row["komentar"]; ?></td>
					<td>
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class="form-inline">
							<input type="number" name="id" value="<?php echo $row["id"]; ?>" hidden readonly>
							<input type="submit" class="btn btn-sm btn-primary" name="submit" value="Odobri">
						</form>
					</td>
				</tr>
				<?php } } ?>
			</tbody>
		</table>
	</div>
	<?php include 'layouts/footer.php'; ?>