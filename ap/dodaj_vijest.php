<?php

include 'auth.php';
include 'db_connect.php';
include 'functions.php';

$errors = array();
$ime = $prezime = $email = $tel = $permisije = $aktivan = $paket = "";
$datum_unosa = date('Y-m-d H:i:s');

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

	if (isset($_POST['radnik']) && !empty($_POST['radnik']) && $_POST['radnik'] >= 0) {
		$radnik = escape($_POST['radnik']);
	} else {
		$errors['radnik'] = "Radnik nije validan.";
	}

	if (isset($_POST['aktivnost']) && !empty($_POST['aktivnost']) && is_string($_POST['aktivnost'])) {
		$aktivnost = escape($_POST['aktivnost']);
	} else {
		$errors['aktivnost'] = "Opis aktivnosti nije validan.";
	}

	if (isset($_POST['komentar'])) {
		$komentar = escape($_POST['komentar']);
	} else {
		$komentar = "";
	}

	if (isset($_POST['zavrseno'])) {
		$zavrseno = 1;
	} else {
		$zavrseno = 0;
	}

	if (isset($_POST['datum_zavr']) && !empty($_POST['datum_zavr'])) {
		$datum_zavr = escape($_POST['datum_zavr']);
	} else {
		$errors['datum_zavr'] = "Datum završavanja nije validan";
	}

	$target_dir = "images/racuni/";
	$target_file = $target_dir . basename($_FILES["slika"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// Check if image file is a actual image or fake image
    	if (file_exists($_FILES['slika']['tmp_name'])) {
    		$check = getimagesize($_FILES["slika"]["tmp_name"]);
		    if($check !== false) {
		        $uploadOk = 1;
		    } else {
		        $errors['slika'] = "Odabarni fajl nije validan.";
		        $uploadOk = 0;
		    }
			// Check if file already exists
			if (file_exists($target_file)) {
			    $errors['slika2'] = "Slika pod tim nazivom već postoji.";
			    $uploadOk = 0;
			}

			// Check file size
			if ($_FILES["slika"]["size"] > 500000) {
			    $errors['slika3'] = "Slika zauzima previše prostora.";
			    $uploadOk = 0;
			}

			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			    $errors['slika4'] = "Dozvoljeni su samo: JPG, JPEG, PNG i GIF formati.";
			    $uploadOk = 0;
			}

			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			    $errors['slika5'] = "Došlo je do greške pri slanju slike.";
			// if everything is ok, try to upload file
			} elseif (empty($errors)) {
			    if (move_uploaded_file($_FILES["slika"]["tmp_name"], $target_file)) {
			        $naziv_slike = $_FILES['slika']['name'];
			    } else {
			        $errors['slika6'] = "Došlo je do greške pri slanju slike.";
			    }
			} else {
				$errors['slika7'] = "Došlo je do greške pri slanju slike.";
			}
	} else {
	  		$naziv_slike = "";
	  	}
}

if(isset($_POST['submit']) && empty($errors)) {
	$sql = "INSERT INTO aktivnosti (";
	$sql .= "id_korisnika, id_radnika, opis_aktivnosti, komentar, zavrseno, datum_zavrsenja, datum_unosa, slika";
	$sql .= ") VALUES (";
	$sql .= "'{$korisnik}', '{$radnik}', '{$aktivnost}', '{$komentar}', '{$zavrseno}', '{$datum_zavr}', '{$datum_unosa}', '{$naziv_slike}')";

	$res = mysqli_query($conn, $sql);

	if(!$res) {
		die("Neuspješan upis." . mysqli_error($conn));
	}
}

?>

<?php include 'layouts/header.php'; ?>
	<title>HELP AP - Dodaj aktivnost</title>
</head>
<body class="bg-primary">
	<?php include 'layouts/nav.php'; ?>
	<div class="container py-5">
		<div class="text-center text-white">
			<h1 class="mb-5">Dodaj aktivnost</h1>
		</div>
		<form id="raspored" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
			<table class="table table-dark">
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
								$qry .= "WHERE permisije = 2";

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
					<td>Opis aktivnosti</td>
					<td><textarea name="aktivnost" class="form-control"></textarea></td>
				</tr>
				<tr>
					<td>Komentar</td>
					<td><textarea name="komentar" class="form-control"></textarea></td>
				</tr>
				<tr>
					<td>Završeno</td>
					<td><input type="checkbox" name="zavrseno" value="1" aria-label="Završeno"></td>
				</tr>
				<tr>
					<td>Datum završavanja</td>
					<td><input type="date" name="datum_zavr" class="form-control" value="<?php if(!empty($errors)) { echo $datum_zavr; } else { echo ""; } ?>"></td>
				</tr>
				<tr>
					<td>Slika računa</td>
					<td>
						<input type="file" name="slika" id="slika">
					</td>
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