<div class="bg-white py-5">
	<div class="container">
		<h1 class="display-4 mb-4"><?php echo "Vijesti"; ?></h1>

		<?php
			$sql = "SELECT * FROM vijesti";

			$result = mysqli_query($conn, $sql);

			if ($result) {
				while ($row = mysqli_fetch_assoc($result)) {
					$id = escape($row['id']);
					$naslov = escape($row['naslov']);
					$tekst = escape($row['tekst']);
					$txt = substr("{$tekst}", 0, 400);

		?>
		<div class="row mb-5">
			<div class="col-6">
				<img src="images/vijesti/<?php echo escape($row['slika']); ?>" alt="<?php echo escape($row['naslov']); ?>" class="card-img-top">
			</div>
			<div class="col-6">
				<a href="vijest.php?id=<?php echo $id; ?>" class="h1"><?php echo escape($row['naslov']); ?></a>
				<p><?php echo $txt; ?>... <a href="vijest.php?id=<?php echo $id; ?>">Pročitaj sve</a></p>
			</div>
		</div>
		<?php } } ?>
	</div>
</div>