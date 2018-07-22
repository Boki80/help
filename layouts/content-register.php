<?php

require 'ap/db_connect.php';
require 'ap/functions.php';

$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
	if (isset($_POST['ime']) && !empty($_POST['ime']) && strlen($_POST['ime']) > 2 && strlen($_POST['ime']) < 33) {
		$ime = escape($_POST['ime']);
	} else {
		$ime = "";
		$errors['ime'] = "Ime nije validno.";
	}

	if (isset($_POST['prezime']) && !empty($_POST['prezime']) && strlen($_POST['prezime']) > 2 && strlen($_POST['prezime']) < 33) {
		$prezime = escape($_POST['prezime']);
	} else {
		$prezime = "";
		$errors['prezime'] = "Prezime nije validno.";
	}

	if (isset($_POST['mail']) && !empty($_POST['mail']) && strlen($_POST['mail']) > 3 && strlen($_POST['mail']) < 50) {
		$mail = escape($_POST['mail']);
	} else {
		$mail = "";
		$errors['mail'] = "Mail nije validan.";
	}

	if (isset($_POST['tel']) && !empty($_POST['tel']) && strlen($_POST['tel']) > 3 && strlen($_POST['tel']) < 50) {
		$tel = escape($_POST['tel']);
	} else {
		$tel = "";
		$errors['tel'] = "Telefon nije validan.";
	}

	if (isset($_POST['pw']) && !empty($_POST['pw']) && strlen($_POST['pw']) > 4 && strlen($_POST['pw']) < 500) {
		$pw1 = escape($_POST['pw']);
	} else {
		$pw1 = "";
		$errors['pw'] = "Šifra nije validna.";
	}

	if (isset($_POST['pw2']) && !empty($_POST['pw2']) && strlen($_POST['pw2']) > 4 && strlen($_POST['pw2']) < 500) {
		$pw2 = escape($_POST['pw2']);
	} else {
		$pw2 = "";
		$errors['pw2'] = "Ponovljena šifra nije validna.";
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit']) && empty($errors) && $pw1 === $pw2) {
		$pw = password_hash($pw1, PASSWORD_ARGON2I);

		$sql = "INSERT INTO registracija (";
		$sql .= "ime, prezime, email, telefon, sifra, datum_reg";
		$sql .= ") VALUES (";
		$sql .= "'{$ime}', '{$prezime}', '{$mail}', '{$tel}', '{$pw}', CURDATE())";

		$result = mysqli_query($conn, $sql);

		if ($result) {
			header('Location: index.php');
		} else {
			echo "Došlo je do greške.";
		}
	}
}

?>

<div class="py-5 bg-light">
	<div class="container">
		<h1 class="display-3 mb-5">Registracija</h1>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
			<div class="form-row">
				<div class="form-group col-6">
					<label for="ime" class="col-form-label col-form-label-lg">Ime</label>
					<input type="text" name="ime" class="form-control form-control-lg" id="ime">
				</div>
				<div class="form-group col-6">
					<label for="prezime" class="col-form-label col-form-label-lg">Prezime</label>
					<input type="text" name="prezime" class="form-control form-control-lg" id="prezime">
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-6">
					<label for="mail" class="col-form-label col-form-label-lg">Email</label>
					<input type="email" name="mail" class="form-control form-control-lg" id="mail">
				</div>
				<div class="form-group col-6">
					<label for="tel" class="col-form-label col-form-label-lg">Broj telefona</label>
					<input type="text" name="tel" class="form-control form-control-lg" id="tel">
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-6">
					<label for="pw" class="col-form-label col-form-label-lg">Šifra</label>
					<input type="password" name="pw" class="form-control form-control-lg" id="pw">
					<small id="passwordHelpBlock" class="form-text text-muted">
  						Šifra mora sadržavati najmanje 5 karaktera.
					</small>
				</div>
				<div class="form-group col-6">
					<label for="pw2" class="col-form-label col-form-label-lg">Šifra ponovo</label>
					<input type="password" name="pw2" class="form-control form-control-lg" id="pw2">
				</div>
			</div>
			<input type="submit" name="submit" class="form-control btn btn-lg btn-outline-primary">
		</form>
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
	</div>
</div>