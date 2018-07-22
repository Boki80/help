<?php

include 'auth.php';
include 'db_connect.php';
include 'functions.php';

?>

<?php include 'layouts/header.php'; ?>
	<title>HELP AP - Spisak završenih aktivnosti</title>
</head>
<body class="bg-primary">
	<?php include 'layouts/nav.php'; ?>
	<div class="container py-5">
		<div class="text-center text-white">
			<h1 class="mb-5">Spisak završenih aktivnosti</h1>
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
					$sql .= "WHERE zavrseno = 1";

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
					<td><a href="images/racuni/<?php echo $row['slika']; ?>">Slika</a></td>
				</tr>
				<?php } } ?>
			</tbody>
		</table>
	</div>
	<?php include 'layouts/footer.php'; ?>