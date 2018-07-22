<?php

require 'auth.php';
require 'ap/db_connect.php';
require 'ap/functions.php';

$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
	if (isset($_POST['paket']) && !empty($_POST['paket']) && $_POST['paket'] > 0 && $_POST['paket'] < 6) {
		$paket = escape($_POST['paket']);
	} else {
		$errors['paket'] = "Paket nije validan.";
	}

	if (isset($_POST['com']) && !empty($_POST['com']) && is_string($_POST['com'])) {
		$com = test($_POST['com']);
	} else {
		$com = "";
	}

	$target_dir = "images/uplate/";
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
			        $errors['slika6'] = "Došlo je do geške pri slanju slike.";
			    }
			} else {
				$errors['slika7'] = "Došlo je do gške pri slanju slike.";
			}
	} else {
	  		$errors['slika8'] = "Slika nije odabrana.";
  	}
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit']) && empty($errors)) {
	$id = $_SESSION['login_id'];

	$sql = "INSERT INTO narudzbe ";
	$sql .= "(korisnik_id, paket, slika, datum_narudzbe)";
	$sql .= " VALUES ";
	$sql .= "('{$id}', '{$paket}', '{$naziv_slike}', CURDATE())";

	$result = mysqli_query($conn, $sql);

	if (!$result) {
		$errors['error'] = "Došlo je do greške";
	}

}

?>

<div class="py-5 bg-light">
	<div class="container">
		<h1 class="display-3 mb-5">Narudžba</h1>

		<a href="#">Upustvo za uplaćivanje paketa</a>

		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
			<input type="number" name="id" value="<?php echo $_SESSION['login_id']; ?>" hidden readonly>
			<div class="form-row">
				<div class="form-group col-4">
					<label for="paket" class="col-form-label col-form-label-lg">Paket</label><br>
					<select name="paket" id="paket" class="form-control form-control-lg">
						<option value=""></option>
						<option value="1">L</option>
						<option value="2">X</option>
						<option value="3">XL</option>
						<option value="4">XXL</option>
						<option value="5">XXXL</option>
					</select>
				</div>

				<div class="form-group col-4">
					<label for="slika" class="col-form-label col-form-label-lg">Slika uplatnice</label><br>
					<input type="file" name="slika" id="slika" class="form-control form-control">
				</div>

				<div class="form-group col-4">
					<label for="com" class="col-form-label col-form-label-lg">Komentar</label>
					<input type="text" name="com" class="form-control form-control-lg" id="com">
				</div>
			</div>
			<input type="submit" name="submit" class="form-control btn btn-lg btn-outline-primary" value="Naruči">
		</form>
		<?php if (isset($_POST['submit']) && empty($errors)) { ?>
					<tr>
						<td colspan="2">
								<div class="alert alert-success alert-dismissible fade show contact-alert mt-4" role="alert">Uspješna narudžba!
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								</div>
						</td>
					</tr>
				<?php } elseif (!empty($errors)) { ?>
					<tr>
						<td colspan="2">
							<div class="alert alert-danger alert-dismissible fade show contact-alert mt-4" role="alert">Neuspješna narudžba! <br> <?php 
								foreach ($errors as $error) {
									echo "{$error}<br>";
								} ?>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							</div>
						</td>
					</tr>
				<?php } ?>
	</div>
</div>