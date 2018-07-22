<div class="bg-3 jumbotron jumbotron-fluid text-white border-bottom">
	<form class="container text-center" action="index.php" method="POST">
		<h1 class="display-4 mb-4"><?php echo $bilten_h; ?></h1>
		<div class="form-group row">
			<div class="col-8 col-sm-9">
				<input type="email" name="mail" class="form-control form-control-lg" placeholder="vaša@mail.adresa">
			</div>
			<div class="col-4 col-sm-3">
				<button type="submit" name="submit" class="btn btn-lg btn-outline-light"><?php echo $bilten_btn; ?></button>
			</div>
		</div>
	</form>
</div>
