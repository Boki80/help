<?php

session_start();

if (isset($_SESSION['user'])) {
	header('Location: index.php');
	exit();
} else {
	include 'ap/db_connect.php';
	include 'ap/functions.php';
	if (isset($_POST['submit'])) {
		if (isset($_POST['mail'])) {
			$email = escape($_POST['mail']);
		} else {
			$errors['email'] = "Email nije validan.";
		}

		if (isset($_POST['pw'])) {
			$pw = escape($_POST['pw']);
		} else {
			$errors['pw'] = "Šifra nije validna.";
		}
	}

	if (isset($_POST['submit']) && empty($errors)) {
		$sql = "SELECT id, ime, sifra FROM registracija ";
		$sql .= "WHERE email = '{$email}'";

		$qry = mysqli_query($conn, $sql);

		if (!$qry || mysqli_num_rows($qry) < 1) {
			$errors['prijava'] = "Podaci nisu tačni.";
		} elseif (mysqli_num_rows($qry) == 1) {
			$row = mysqli_fetch_assoc($qry);
			$db_pw = $row['sifra'];
	        if (password_verify($pw, $db_pw)) {
	        	$_SESSION['login_id'] = $row['id'];
	        	$_SESSION['user'] = $email;
	        	$_SESSION['user_name'] = $row['ime'];
				header("Location: index.php");
				exit();
			} else {
				$errors['prijava'] = "Podci nisu tačni.";
			}
		} else {
			$errors['prijava'] = "Podaci nsu tačni.";
		}
	}
}

?>

<div class="py-5 bg-light">
	<div class="container">
		<h1 class="display-3 mb-5">Prijava</h1>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
			<div class="form-row">
				<div class="form-group col-6">
					<label for="mail" class="col-form-label col-form-label-lg">Email</label>
					<input type="email" name="mail" class="form-control form-control-lg" id="mail">
				</div>
				<div class="form-group col-6">
					<label for="pw" class="col-form-label col-form-label-lg">Šifra</label>
					<input type="password" name="pw" class="form-control form-control-lg" id="pw">
				</div>
			</div>
			<input type="submit" name="submit" class="form-control btn btn-lg btn-outline-primary">
		</form>
		
		<p>Nemate korisnički nalog? <a href="register.php">Registrujte se</a></p>

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
							<div class="alert alert-danger alert-dismissible fade show contact-alert mt-4" role="alert">Neuspješna prijava! <br> <?php 
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