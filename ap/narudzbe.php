<?php
include 'auth.php';
include 'db_connect.php';
include 'functions.php';

?>

<?php include 'layouts/header.php'; ?>
	<title>HELP AP - Narudžbe</title>
</head>
<body class="bg-primary">
	<?php include 'layouts/nav.php'; ?>
	<div class="container py-5">
		<div class="text-center text-white">
			<h1 class="mb-5">Narudžbe</h1>
		</div>
		<table class="table table-hover table-dark rounded">
			<thead class="thead-light">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Ime</th>
					<th scope="col">Prezime</th>
					<th scope="col">Paket</th>
					<th scope="col">Slika</th>
					<th scope="col">Datum narudžbe</th>
					<th scope="col">Opcije</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$sql = "SELECT * FROM narudzbe";

					$result = mysqli_query($conn, $sql) or trigger_error(mysql_error());

					if (mysqli_num_rows($result) > 0) {
					    // output data of each row
					    while($row = mysqli_fetch_assoc($result)) {

				?>
				<tr>
					<th scope="row"><?php echo $id = $row['id']; ?></th>
					<td><?php echo ucfirst($row["ime"]); ?></td>
					<td><?php echo ucfirst($row["prezime"]); ?></td>
					<td>
						<?php
							$sql2 = "SELECT datum_isteka FROM clanarine ";
					    	$sql2 .= "WHERE korisnik = $id";

					    	$result2 = mysqli_query($conn, $sql2);

					    	if (mysqli_num_rows($result2) == 1) {
					    		$row2 = mysqli_fetch_assoc($result2);
					    		echo $row2['datum_isteka'];
 					    	}
						?>
					</td>
					<td><a href="profil.php?id=<?php echo $row['id']; ?>">Profil</a></td>
				</tr>
				<?php } } ?>
			</tbody>
		</table>
	</div>
	<?php include 'layouts/footer.php'; ?>