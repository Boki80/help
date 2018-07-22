<?php
include 'auth.php';
include 'db_connect.php';
include 'functions.php';

$errors = array();
$brojac = 1;

$id = escape($_GET['id']);

if ($id === $_SESSION['login_id'] || access(2)) {
	
if (isset($_POST['brisanje'])) {
	$id = $_POST['del_id'];
	$del = "DELETE FROM users ";
	$del .= "WHERE id = $id ";
	$del .= "LIMIT 1";

	$res = mysqli_query($conn, $del);

	if($res) {
		header("Location: spisak_korisnika.php");
	}
} else {

?>

<?php include 'layouts/header.php'; ?>
	<title>Korisnik</title>
</head>
<body>
	<?php include 'layouts/nav.php'; ?>
	<div class="bg-primary py-5">
		<?php 
			if(!isset($_POST['brisanje'])) {
			$sql = "SELECT * FROM users ";
			$sql .= "WHERE id = '{$id}' ";
			$sql .= "LIMIT 1";
			$result = mysqli_query($conn, $sql) or trigger_error(mysql_error());

			if (mysqli_num_rows($result) > 0) {
			    // output data of each row
			    while($row = mysqli_fetch_assoc($result)) {
		?>
		<div class="container text-white">
			<div class="text-center text-white">
				<h1 class="mb-5">Profil korisnika <?php echo $row['ime'] . " " . $row['prezime']; ?></h1>
			</div>

			<div class="row">
				<div class="col-lg-6">
					<img src="images/users/<?php echo $row['slika']; ?>" width="500" alt="Korisnička slika">
					<div class="text-center mt-3">
						<a href="images/users/<?php echo $row['slika']; ?>" class="btn btn-lg btn-info" role="button">Slika u punoj veličini</a>
					</div>
				</div>
				<div class="col-lg-6">
					<p class="h4"><span class="text-dark">Ime:</span> <?php echo $row['ime']; ?></p>
					<p class="h4"><span class="text-dark">Prezime:</span> <?php echo $row['prezime']; ?></p>
					<p class="h4"><span class="text-dark">Permisije:</span> <?php echo $row['permisije']; ?></p>
					<p class="h4"><span class="text-dark">Aktivan:</span> <?php echo $row['aktivan']; ?></p>
					<p class="h4"><span class="text-dark">Registracija:</span> <?php echo $row['datum_reg']; ?></p>
					<p class="h4"><span class="text-dark">Paket:</span> <?php echo $row['paket']; ?></p>
					<?php
						$sql2 = "SELECT datum_uplate, datum_isteka ";
						$sql2 .= "FROM clanarine ";
						$sql2 .= "WHERE korisnik = $id ";
						$sql2 .= "ORDER BY id DESC";

						$res2 = mysqli_query($conn, $sql2);

						if ($res2) {
							$row2 = mysqli_fetch_assoc($res2);
						} else {
							die("Neuspješan ispis." . mysqli_error($conn));
						}
					?>
					<p class="h4"><span class="text-dark">Poslednja uplata:</span> <?php echo $row2['datum_uplate']; ?></p>
					<p class="h4"><span class="text-dark">Istek:</span> <?php echo $row2['datum_isteka']; ?></p>
					<p class="h4"><span class="text-dark">Ukupno uplaćeno:</span> <?php echo $row['ukupne_uplate']; ?></p>
					<p class="h4"><span class="text-dark">Email:</span> <?php echo $row['email']; ?></p>
					<p class="h4"><span class="text-dark">Telefon:</span> <?php echo $row['telefon']; ?></p>
				</div>
			</div>
			<div class="text-center text-white mt-5">
				<form action="<?php echo escape($_SERVER['PHP_SELF']); ?>?id=<?php echo $id; ?>" method="POST" onsubmit="return confirm('Da li stvarno želite obrisati profil?');">
		      		<input type="text" class="form-control" name="del_id" value="<?php echo $id; ?>" readonly hidden>
		        	<button type="submit" class="btn btn-lg btn-danger" name="brisanje">Obriši korisnika <?php echo $row['ime']; ?></button>
		        	<a href="kartica.php?id=<?php echo $id; ?>" class="btn btn-lg btn-info" role="button">Identifikaciona kartica korisnika <?php echo $row['ime']; ?></a>
				</form>
			</div>
			
			<div class="text-center text-white">
				<h1 class="m-5">Aktivnosti</h1>
			</div>

			<table class="table table-hover rounded">
				<thead class="thead-light">
					<tr>
						<th scope="col">#</th>
						<th scope="col">Aktivnost</th>
						<th scope="col">Radnik</th>
						<th scope="col">Završeno</th>
						<th scope="col">Datum završenja</th>
						<th scope="col">Komentar</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$sql = "SELECT * FROM aktivnosti ";
						$sql .= "WHERE id_korisnika = $id";

						$result = mysqli_query($conn, $sql) or trigger_error(mysql_error());

						if (mysqli_num_rows($result) > 0) {
						    // output data of each row
						    while($row = mysqli_fetch_assoc($result)) {
					?>
					<tr>
						<th scope="row"><?php echo $brojac++; ?></th>
						<td><?php echo ucfirst($row["opis_aktivnosti"]); ?></td>
						<td>
							<?php
								$ide = $row['id_radnika'];

								$sql = "SELECT ime, prezime FROM users ";
								$sql .= "WHERE id = $ide";

								$result = mysqli_query($conn, $sql) or trigger_error(mysql_error());

								if (mysqli_num_rows($result) == 1) {
									$row2 = mysqli_fetch_assoc($result);
									echo ucfirst($row2['ime']) . " " . ucfirst($row2['prezime']);
								}
							?>
						<td><?php if ($row['zavrseno'] == 1) { echo 'Da'; } else { echo 'Ne'; } ?></td>
						<td><?php echo $row['datum_zavrsenja']; ?></td>
						<td><?php echo $row['komentar']; ?></td>
					</tr>
					<?php } } ?>
				</tbody>
			</table>

			<?php } } } else {
				header('Location: index.php');
			} ?>
		</div>
	</div>

<?php } ?>
<?php include 'layouts/footer.php'; ?>

<?php

} else {
	header('Location: index.php');
	exit();
}

?>