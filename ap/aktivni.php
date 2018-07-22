<?php

include 'auth.php';
include 'db_connect.php';
include 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deaktiviraj']) && isset($_POST['id'])) {
	$id = escape($_POST['id']);

	$sql = "UPDATE users ";
	$sql .= "SET aktivan = 0 ";
	$sql .= "WHERE id = '{$id}'";

	$result = mysqli_query($conn, $sql);

	if (!$result) {
		echo "Došlo je do greške.";
	}
}

?>

<?php include 'layouts/header.php'; ?>
	<title>HELP AP - Aktivni korisnici</title>
</head>
<body class="bg-primary">
	<?php include 'layouts/nav.php'; ?>
	<div class="container py-5">
		<div class="text-center text-white">
			<h1 class="mb-5">Aktivni korisnici</h1>
		</div>
		<table class="table table-hover table-dark rounded">
			<thead class="thead-light">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Ime</th>
					<th scope="col">Prezime</th>
					<th scope="col">Aktivan</th>
					<th scope="col">Telefon</th>
					<th scope="col">Opcije</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$sql = "SELECT id, ime, prezime, aktivan, telefon FROM users ";
					$sql .= "WHERE aktivan = 1";

					$result = mysqli_query($conn, $sql) or trigger_error(mysql_error());

					if (mysqli_num_rows($result) > 0) {
					    // output data of each row
					    while($row = mysqli_fetch_assoc($result)) {
				?>
				<tr>
					<th scope="row"><?php echo $row["id"]; ?></th>
					<td><?php echo ucfirst($row["ime"]); ?></td>
					<td><?php echo ucfirst($row["prezime"]); ?></td>
					<td><?php if ($row["aktivan"] == 1) { echo "Da"; } else { echo "Ne"; } ?></td>
					<td><?php echo $row["telefon"]; ?></td>
					<td>
						<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
							<a href="profil.php?id=<?php echo $row['id']; ?>">Profil</a>
							<input type="number" name="id" value="<?php echo $row['id']; ?>" readonly hidden>
							<input type="submit" name="deaktiviraj" value="Deaktiviraj" class="btn btn-sm btn-outline-light">
						</form>
					</td>
				</tr>
				<?php } } ?>
			</tbody>
		</table>
	</div>
	<?php include 'layouts/footer.php'; ?>