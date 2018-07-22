<?php
include 'auth.php';
include 'db_connect.php';
include 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['zavrsi']) && isset($_POST['id']) && !empty($_POST['id']) && is_numeric($_POST['id'])) {
	$id = escape($_POST['id']);

	$sql = "UPDATE `aktivnosti` ";
	$sql .= "SET `zavrseno` = 1 ";
	$sql .= "WHERE `id` = $id";

	$result = mysqli_query($conn, $sql);

	if (!$result) {
		$errors['zavrsavanje'] = "Greška pri završavanju aktivnosti.";
	}
}

?>

<?php include 'layouts/header.php'; ?>
	<title>HELP AP - Spisak nezavršenih aktivnosti</title>
</head>
<body class="bg-primary">
	<?php include 'layouts/nav.php'; ?>
	<div class="container py-5">
		<div class="text-center text-white">
			<h1 class="mb-5">Spisak nezavršenih aktivnosti</h1>
		</div>
		<table class="table table-hover table-dark rounded">
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
					$sql = "SELECT * FROM aktivnosti ";
					$sql .= "WHERE zavrseno = 0";

					$result = mysqli_query($conn, $sql) or trigger_error(mysql_error());

					if (mysqli_num_rows($result) > 0) {
					    // output data of each row
					    while($row = mysqli_fetch_assoc($result)) {
				?>
				<tr>
					<th scope="row"><?php echo $row["id"]; ?></th>
					<td>
						<?php
							$id = $row['id_korisnika']; 
							$sql = "SELECT ime, prezime FROM users WHERE id = $id";
							
							$res = mysqli_query($conn, $sql) or trigger_error(mysql_error());

							if (mysqli_num_rows($res) == 1) {
								$row2 = mysqli_fetch_assoc($res);
								echo $row2['ime'] . " " . $row2['prezime'];
							}
						?>
					</td>
					<td>
						<?php
							$id = $row['id_radnika']; 
							$sql = "SELECT ime, prezime FROM users WHERE id = $id";
							
							$res = mysqli_query($conn, $sql) or trigger_error(mysql_error());

							if (mysqli_num_rows($res) == 1) {
								$row2 = mysqli_fetch_assoc($res);
								echo $row2['ime'] . " " . $row2['prezime'];
							}
						?>
					</td>
					<td><?php echo $row["opis_aktivnosti"]; ?></td>
					<td><?php echo $row["komentar"]; ?></td>
					<td><?php if ($row["zavrseno"] == 1) { echo "Da"; } else { echo "Ne"; } ?></td>
					<td><?php echo $row["datum_unosa"]; ?></td>
					<td><?php echo $row["datum_zavrsenja"]; ?></td>
					<td>
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
							<a href="images/racuni/<?php echo $row['slika']; ?>">Slika</a>
							<input type="number" name="id" value="<?php echo $row["id"]; ?>" hidden readonly>
							<input type="submit" name="zavrsi" class="btn btn-sm btn-outline-light" value="Završi">
						</form>
					</td>
				</tr>
				<?php } } ?>
			</tbody>
		</table>
	</div>
	<?php include 'layouts/footer.php'; ?>