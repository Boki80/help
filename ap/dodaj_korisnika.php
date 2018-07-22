<?php

include 'auth.php';
include 'db_connect.php';
include 'functions.php';

$errors = array();
$ime = $prezime = $email = $tel = $permisije = $aktivan = $paket = "";
$datum_reg = date('Y-m-d H:i:s');

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
	if (isset($_POST['ime']) && !empty($_POST['ime']) && is_string($_POST['ime']) && strlen($_POST['ime']) > 0 && strlen($_POST['ime']) < 33) {
		$ime = ucfirst(escape($_POST['ime']));
	} else {
		$errors['ime'] = "Ime nije validno.";
	}

	if (isset($_POST['prezime']) && !empty($_POST['prezime']) && is_string($_POST['prezime']) && strlen($_POST['prezime']) > 0 && strlen($_POST['prezime']) < 33) {
		$prezime = ucfirst(escape($_POST['prezime']));
	} else {
		$errors['prezime'] = "Prezime nije validno.";
	}

	if (isset($_POST['email']) && !empty($_POST['email']) && is_string($_POST['email']) && strlen($_POST['email']) < 51 && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
		$email = escape($_POST['email']);
	} else {
		$errors['email'] = "Email nije validan.";
	}

	if (isset($_POST['tel']) && !empty($_POST['tel']) && is_string($_POST['tel']) && strlen($_POST['tel']) < 33) {
		$tel = escape($_POST['tel']);
	} else {
		$errors['tel'] = "Telefon nije validan.";
	}

	if (isset($_POST['permisije']) && !empty($_POST['permisije']) && $_POST['permisije'] > 0 && $_POST['permisije'] < 4) {
		$permisije = escape($_POST['permisije']);
	} else {
		$errors['permisije'] = "Uloga nije validna.";
	}

	if (isset($_POST['aktivan']) && !empty($_POST['aktivan']) && $_POST['aktivan'] >= 0 && $_POST['aktivan'] < 2) {
		$aktivan = escape($_POST['aktivan']);
	} else {
		$errors['aktivan'] = "Aktivan nije validno.";
	}

	$target_dir = "images/users/";
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
	  		$errors['slika8'] = "Slika nije odabrana.";
  	}
}

if(isset($_POST['submit']) && empty($errors)) {
	$sql = "INSERT INTO users (";
	$sql .= "ime, prezime, permisije, aktivan, slika, datum_reg, paket, email, telefon";
	$sql .= ") VALUES (";
	$sql .= "'{$ime}', '{$prezime}', '{$permisije}', '{$aktivan}', '{$naziv_slike}', '{$datum_reg}', '{$paket}', '{$email}', '{$tel}')";

	$res = mysqli_query($conn, $sql);

	if(!$res) {
		die("Neuspješan upis." . mysqli_error($conn));
	}
}

?>

<?php include 'layouts/header.php'; ?>
	<title>HELP AP - Dodaj korisnika</title>
</head>
<body class="bg-primary">
	<?php include 'layouts/nav.php'; ?>
	<div class="container py-5">
		<div class="text-center text-white">
			<h1 class="mb-5">Dodaj korisnika</h1>
		</div>
		<form id="raspored" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
			<table class="table table-dark">
				<tr>
					<td>Ime</td>
					<td><input type="text" name="ime" id="ime" class="form-control" value="<?php if(!empty($errors)) { echo $ime; } else { echo ""; } ?>"></td>
				</tr>
				<tr>
					<td>Prezime</td>
					<td><input type="text" name="prezime" id="prezime" class="form-control" value="<?php if(!empty($errors)) { echo $prezime; } else { echo ""; } ?>"></td>
				</tr>
				<tr>
					<td>Email</td>
					<td><input type="email" name="email" id="email" class="form-control" value="<?php if(!empty($errors)) { echo $email; } else { echo ""; } ?>"></td>
				</tr>
				<tr>
					<td>Telefon</td>
					<td><input type="text" name="tel" id="tel" class="form-control" value="<?php if(!empty($errors)) { echo $tel; } else { echo ""; } ?>"></td>
				</tr>
				<tr>
					<td>Uloga</td>
					<td>
						<select class="form-control" name="permisije" id="permisije">
							<option value="1" <?php if(!empty($errors) && $permisije === "1") { echo "selected"; } ?>>Korisnik</option>
							<option value="2" <?php if(!empty($errors) && $permisije === "2") { echo "selected"; } ?>>Radnik</option>
							<option value="3" <?php if(!empty($errors) && $permisije === "3") { echo "selected"; } ?>>Administrator</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Aktivan</td>
					<td>
						<select class="form-control" name="aktivan" id="aktivan">
							<option value="1" <?php if(!empty($errors) && $aktivan === "1") { echo "selected"; } ?>>Da</option>
							<option value="0" <?php if(!empty($errors) && $aktivan === "0") { echo "selected"; } ?>>Ne</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Slika</td>
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