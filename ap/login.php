<?php

session_start();

if (isset($_SESSION['login_user'])) {
	header('Location: index.php');
	exit();
} else {
	include 'db_connect.php';
	include 'functions.php';
	if (isset($_POST['submit'])) {
		if (isset($_POST['email'])) {
			$email = escape($_POST['email']);
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
		$sql = "SELECT id, sifra FROM users ";
		$sql .= "WHERE email = '{$email}'";

		$qry = mysqli_query($conn, $sql);

		if (!$qry || mysqli_num_rows($qry) < 1) {
			$errors['prijava'] = "Podaci nisu tačni.";
		} elseif (mysqli_num_rows($qry) == 1) {
			$row = mysqli_fetch_assoc($qry);
			$db_pw = $row['sifra'];
	        if (password_verify($pw, $db_pw)) {
	        	$_SESSION['login_id'] = $row['id'];
	        	$_SESSION['login_user'] = $email;
				header("Location: index.php");
				exit();
			} else {
				$errors['prijava'] = "Podaci nisu tačni.";
			}
		} else {
			$errors['prijava'] = "Podaci nsu tačni.";
		}
	}
}

?>

	<?php include 'layouts/header.php'; ?>
		<title>Prijava</title>
	</head>
	<body>
		<?php include 'layouts/nav.php'; ?>
		<div class="container">
			<div class="card p-5 text-center">
				<form class="form-signin" action="login.php" method="POST">
					<h2 class="h1 m-5">Prijava</h2>
					<input type="text" name="email" class="form-control mb-4" placeholder="Ime" value="<?php if(!empty($errors)) { echo $email; } else { echo ""; } ?>" required autofocus>
					<input type="password" name="pw" class="form-control mb-4" placeholder="Šifra" required>
					<button class="btn btn-lg btn-primary btn-block mb-2" type="submit" name="submit">Prijava</button>
        			<a href="register.php">Registracija</a>
				</form>
				<?php if(isset($_POST['submit']) && !empty($errors)) { ?>
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
	<?php include 'layouts/footer.php'; ?>