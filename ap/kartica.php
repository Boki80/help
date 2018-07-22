<?php
include 'db_connect.php';
include 'functions.php';

$errors = array();

$id = escape($_GET['id']);

if(isset($_POST['brisanje'])) {
	$id = $_POST['del_id'];
	echo $id;
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
			<div class="row">
				<div class="bg-secondary p-4">
					<div class="float-left kartica-img">
						<img src="images/users/<?php echo $row['slika']; ?>" alt="Korisnička slika">
					</div>
					<div class="float-right ml-4">
						<p class="h4"><span class="text-dark">Identifikacioni broj:</span> <?php echo $row['id']; ?></p>
						<p class="h4"><span class="text-dark">Ime i prezime:</span> <?php echo $row['ime'] . " " . $row['prezime']; ?></p>
						<p class="h4"><span class="text-dark">Paket:</span> <?php echo $row['paket']; ?></p>
					</div>
				</div>
			</div>
			

			<?php } } } else {
				header('Location: index.php');
			} ?>
		</div>
	</div>

<?php } ?>
<?php include 'layouts/footer.php'; ?>
