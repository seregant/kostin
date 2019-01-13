<?php

include 'header.php';
	$dataAddon = getAllData('kostin_addons','*', null, null);
?>
<?php 
  if(isset($_COOKIE['confirmed'])){
    if ($_COOKIE['confirmed'] == "no") {
      echo '
        <div class="col  mx-auto">
          <div class="alert alert-danger alert-dismissible fade show" role="alert" style="padding: 1.1em; text-align: center;">
              '.$_COOKIE['message'].'
          <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="max-width: 5%; position: absolute; margin-top: 0;" >
            <span aria-hidden="true" style="font-size: 0.9em;">&times;</span>
          </button>
          </div>  
         </div>';
    } 
  }
?>
<div class="container ">

	<!-- FORM BOOKING -->
	<form class="needs-validation form-cust" enctype="multipart/form-data" action="data_input.php?category=booking" method="post" novalidate>
	<div class="row form-bg" style="padding: 5px;">
		<div class="col-md-5 mx-auto form-border" >
  				<center style="padding-top: 1em;"><h4>Data Booking</h4></center>
  				
  					<div class="form-group">
  						<label for="usr-validation" style="padding-top: 5px;">Nama:</label><br>
  						<input type="text" class="form-control" id="usr-validation" name="nama" required>
              <div class="invalid-feedback">Masukkan nama anda.</div>
              <div class="valid-feedback">Looks good!</div>
  					</div>
  					<div class="form-group">
  						<label for="alamat-validation">Alamat:</label><br>
  						<textarea class="form-control " id="alamat-validation" rows="3" name="alamat" required></textarea>
              <div class="invalid-feedback">Masukkan alamat anda.</div>
              <div class="valid-feedback">Looks good!</div>
  					</div>
  					<div class="form-group">
  						<label for="email-validation">Email:</label><br>
  						<input type="text" class="form-control " id="email-validation" name="mail" required>
              <div class="invalid-feedback">Masukkan alamat email yang benar.</div>
              <div class="valid-feedback">Looks good!</div>  					</div>
  					<div class="form-group">
  						<label for="telp-validation">No. Telp/HP</label><br>
  						<input type="text" class="form-control " id="telp-validation" name="phone" required>
              <div class="invalid-feedback">Masukkan No. Telp yang benar.</div>
              <div class="valid-feedback">Looks good!</div>
  					</div>
  					<div class="form-group">
  						<label for="tglLahir-validation">Tanggal Lahir</label><br>
  						<input type="date" class="form-control " id="tglLahir-validation" name="tanggal-lahir" required>
              <div class="invalid-feedback">Masukkan tanggal lahir.</div>
              <div class="valid-feedback">Looks good!</div>
  					</div>
  					<div class="form-group">
    					<label for="ktp-validation">No. KTP/SIM</label><br>
     					<input type="text" class="form-control " id="ktp-validation" name="noktp" required>
              <div class="invalid-feedback">Masukkan No. KTP.</div>
              <div class="valid-feedback">Looks good!</div>
					</div> 
					<div class="form-group">
			  			<label for="foto-validation">Foto KTP/SIM</label><br>
			  			<input type="file" id="foto-validation" accept="image/*" name="ktp_pict" required>
			  			<p class="help-block">Unggah foto atau hasil scan KTP/SIM.</p>					
              <div class="invalid-feedback">Lampirkan foto KTP/SIM.</div>
					</div>
					<button type="submit" class="btn btn-primary" >Booking</button>

		</div>
		<div class="col-md-7" >
			<div class="container form-border" style="text-align: center;">
				<h4>Daftar Add-ons</h4>
        <br>
				<table class="table table-sm table-hover" style="width: 100%;">
  						<thead>
  							<tr>
  								<th></th>
  								<th>Nama</th>
  								<th>Harga</th>
                  <th>Stock</th>
  							</tr>
  						</thead>
  						<tbody>
  					<?php
              $id_addon = 1;
  						foreach ($dataAddon as $addon) {
  							echo '
			  					<tr>
			  						<td>
                    <input id="checkbox'.$id_addon.'" type="checkbox" name="add-on[]" value="'.$addon['ao_id'].'"></td>
			  						<td>
			  							'.$addon['ao_name'].'
			  						</td>
			  						<td>
			  							'.$addon['ao_price'].'
			  						</td>
                    <td>
                      '.$addon['ao_stock'].' unit
                    </td>
			  					</tr>
  							';
                $id_addon++;
  						}
  					?>
  					</tbody>
  				</table>
			</div>
      <div class="container form-border">
        <center>
          <b>Jumlah Addon</b>
        </center>
          <?php
            $id_addon = 1;
            foreach ($dataAddon as $addon) {
              echo '
                <div id="input_jumlah'.$id_addon.'" style="display: none"><label>'.$addon['ao_name'].'</label> <input id="form_input_jumlah'.$id_addon.'" type="text" class="form-control" name="jml_addon[]"></div>
              ';
              $id_addon++;
            }
          ?>
      </div>			
		</div>		
	</div>
	</form>

</div>

<!--VALIDATING FORM Booking-->
<script type="text/javascript" src="frontend/js/jquery-3.3.1.min.js"></script>
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

<?php
  $id_addon = 1;
  foreach ($dataAddon as $addon) {
    echo "
  $('#checkbox$id_addon').change(function(){
        document.getElementById('form_input_jumlah$id_addon').value=''
        if (!this.checked) {
            $('#input_jumlah$id_addon').fadeOut('fast');
        }
        else {
            $('#input_jumlah$id_addon').fadeIn('fast');
        }                   
    });
    ";
    $id_addon++;
  }
?>
</script>

<?php
	include 'footer.php';
?>