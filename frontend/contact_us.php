<?php
	include 'header.php';
?>
<div class="container ">

	<!-- FORM BOOKING -->
	<form class="needs-validation form-cust" novalidate>
	<div class="row form-bg" style="padding: 5px;">
		<div class="col-md-6 mx-auto form-border">
			<center style="padding-top: 1em;"><h4>Form Kontak</h4></center>
  				<div class="form-group align">
  					<label for="nama-validasi" style="padding-top: 5px;">Nama:</label><br>
  					<input type="text" class="form-control " id="nama-validasi" name="nama" required>
  					<div class="invalid-feedback">Masukkan nama anda.</div>
  				</div>
  				<div class="form-group">
  					<label for="email-validasi">Email:</label><br>
  					<input type="text" class="form-control " id="email-validasi" name="email" required>
  					<div class="invalid-feedback">Masukkan alamat email yang benar.</div>
  				</div>
  				<div class="form-group">
  					<label for="subject-validasi">Subject</label><br>
  					<input type="text" class="form-control " id="subject-validasi" name="subject" required>
  					<div class="invalid-feedback">Isikan subjek pesan anda.</div>
  				</div>
  				<div class="form-group">
    				<label for="pesan-validasi">Pesan</label><br>
     				<textarea class="form-control " id="pesan-validasi" rows="3" name="pesan" required></textarea>
     				<div class="invalid-feedback">Isikan pesan anda.</div>
				</div>
				<div class="col text-center">
					<button type="submit" class="btn btn-primary mx-auto" style="max-width: 30%; margin: auto;">Kirim</button>
				</div>
					
		</div>
		<div class="col-md-6 " >
			<div class="container" style="text-align: center;">
				<h4>Alamat</h4>
				<table style="text-align: center; margin: auto; width: 100%;">
					<tr>
						<th>KostIn Office</th>
					</tr>
					<tr>
						<td>ALamat dan Nomor</td>
					</tr>
					<tr>
						<td><div id="our-map"></div></td>
					</tr>
				</table>
			</div>			
		</div>		
	</div>
	</form>

</div>

<!--VALIDATING FORM Contact-->
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

<?php
	include 'footer.php';
?>