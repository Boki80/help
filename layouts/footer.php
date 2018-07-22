        <footer class="page-footer py-5 text-white">
            <div class="container text-center text-md-left">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-6 mb-4">
                        <h6 class="text-uppercase font-weight-bold">Udruženje HELP</h6>
                        <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                        <p>Udruženje HELP je formirano radi Vas, Vama kojima treba pomoć u svakodnevnim aktivnostima, te u nemogućnosti bližnjih da Vam pomognu mi Vam stojimo na usluzi. Svojim učlanjenjem u naše udruženje olakšavate sebi zlatno doba.</p>
                    </div>
                    <div class="col-6 col-md-6 col-lg-3 mx-auto mb-4">
                        <h6 class="text-uppercase font-weight-bold">Važni linkovi</h6>
                        <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                        <p><a href="#!" class="text-white">Awards</a></p>
                        <p><a href="#!" class="text-white">Become a member</a></p>
                        <p><a href="#!" class="text-white">Find home</a></p>
                        <p><a href="#!" class="text-white">Help</a></p>
                    </div>
                    <div class="col-6 col-md-6 col-lg-3 mx-auto mb-4">
                        <h6 class="text-uppercase font-weight-bold">Kontakt</h6>
                        <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                        <p>Kralja Aleksandra bb Doboj</p>
                        <p>+387 63 370 263</p>
                        <p>+387 66 117 590</p>
                        <p>mail@adresa.com</p>
                        <p><a href="#!" class="text-white">Kontakt forma</a></p>
                    </div>
                </div>
            </div><hr class="my-4">
            <div class="footer-copyright container">
                <div class="row">
                    <div class="col-6">
                        <p>© 2018 Copyright: <a href="#" class="text-white">link-stranice.com</a></p>
                    </div>
                    <div class="col-6 text-right">
                        <p>Development by <a href="mailto:bokifreelancer@gmail.com?Subject=Poruka%20sa%20HELP" class="text-white">Bojan</a></p>
                    </div>
                </div>
            </div>
        </footer>
                      
   <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  	<script>
  		function openNav() {
        	document.getElementById("myNav").style.width = "100%";
      	}

      	function closeNav() {
          	document.getElementById("myNav").style.width = "0%";
      	}

        function formatText(tag) {
           var Field = document.getElementById('mytextarea');
           var val = Field.value;
           var selected_txt = val.substring(Field.selectionStart, Field.selectionEnd);
           var before_txt = val.substring(0, Field.selectionStart);
           var after_txt = val.substring(Field.selectionEnd, val.length);
           Field.value += '[' + tag + ']' + '[/' + tag + ']';
        }
  	</script>
  </body>
</html>