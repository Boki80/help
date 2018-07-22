<div class="bg-white py-5">

	<div class="container">
		<h1 class="display-3">Kontaktirajte nas</h1>
	</div>

	<div class="mapouter my-5">
		<div class="gmap_canvas">
			<iframe width="100%" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=kralja%20aleksandra&t=&z=18&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
		</div>
	</div>

	<div class="container text-justify">
		<div class="row">
			<div class="col-9">
				<form class="needs-validation" novalidate>
					<div class="form-row">
						<div class="col-12">
							<label for="ime" class="col-form-label col-form-label-lg">Ime i prezime</label>
							<input type="text" class="form-control form-control-lg" id="ime" required>
							<div class="valid-feedback">Validno.</div>
							<div class="invalid-feedback">Ime i prezime nije validno.</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-12">
							<label for="email" class="col-form-label col-form-label-lg">Email</label>
							<input type="email" class="form-control form-control-lg" id="email">
							<div class="valid-feedback">Validno.</div>
							<div class="invalid-feedback">Email nije validan.</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-12">
							<label for="tel" class="col-form-label col-form-label-lg">Broj telefona</label>
							<input type="text" class="form-control form-control-lg" id="tel">
							<div class="valid-feedback">Validno.</div>
							<div class="invalid-feedback">Broj telefona nije validan.</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-12">
								<label for="poruka" class="col-form-label col-form-label-lg">Poruka</label>
								<textarea class="form-control form-control-lg" id="poruka" rows="5" required></textarea>
							<div class="valid-feedback">Validno.</div>
							<div class="invalid-feedback">Poruka nije validna.</div>
						</div>
					</div>
					<button class="btn btn-primary mt-3" type="submit">Pošalji</button>
				</form>
			</div>
			<div class="col-3">
				<p>Telefon:</p>
				<p class="font-weight-bold">+387 63 370 263</p>
				<p>Mobilni:</p>
				<p class="font-weight-bold">+387 66 117 590</p>
				<p>Adresa:</p>
				<p class="font-weight-bold">Kralja Aleksandra bb, Doboj</p>
				<p>Email:</p>
				<p class="font-weight-bold">mail@mail.com</p>
			</div>
		</div>
		<script>
		// Example starter JavaScript for disabling form submissions if there are invalid fields
		(function() {
		'use strict';
		window.addEventListener('load', function() {
		// Fetch all the forms we want to apply custom Bootstrap validation styles to
		var forms = document.getElementsByClassName('needs-validation');
		// Loop over them and prevent submission
		var validation = Array.prototype.filter.call(forms, function(form) {
		form.addEventListener('submit', function(event) {
		if (form.checkValidity() === false) {
		event.preventDefault();
		event.stopPropagation();
		}
		form.classList.add('was-validated');
		}, false);
		});
		}, false);
		})();
		</script>
	</div>
</div>