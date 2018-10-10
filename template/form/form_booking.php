<!DOCTYPE html>
<html>
<head>
  <title>Kostin Booking</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/ong" href="images/favicon.png">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/content.css">
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>  
    <script type="text/javascript" src="js/myScript.js"></script>
</head>
<body>
       <!--Content--> 

      <div class="row">
        <div class="col-md-12">
        <div class="reg-form">
          <center>
            <form name="registrasi" enctype="multipart/form-data" onsubmit="return regValidation()" action="../../module/data_input.php" method="post" >
            <table width="70%">
              <tr>
                <th colspan="3"><center><h2>BOOKING</h2></center></th>
              </tr>
              <tr>
                <td>Nama</td>
                <td>&nbsp;:&nbsp;</td>
                <td><input type="text" name="nama"></td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td>&nbsp;:&nbsp;</td>
                <td><input type="text" name="alamat"></td>
              </tr>
              <tr>
                <td>Tangal Lahir</td>
                <td>&nbsp;:&nbsp;</td>
                <td><input type="date" name="tanggal-lahir"></td>
              </tr>
              <tr>
                <td>E-Mail</td>
                <td>&nbsp;:&nbsp;</td>
                <td><input type="text" name="mail"></td>
              </tr>
              <tr>
                <td>No. KTP/Kitas</td>
                <td>&nbsp;:&nbsp;</td>
                <td><input type="text" name="noktp"></td>
              </tr>
              <tr>
                <td>Foto KTP/Kitas</td>
                <td>&nbsp;:&nbsp;</td>
                <td><input type="file" name="ktp_pict"></td>
              </tr>
              <tr>
              <tr>
                <td colspan="3">
                <center>
                  <br>
                  <h3>Add-ons</h3>
                  <p>Pilih fasilitas kamar yang anda diinginkan :</p>
                  
                  <table>
                    <td>
                        <input type="checkbox" name="add-on[]" value="AO001"> Televisi <br>
                        <input type="checkbox" name="add-on[]" value="AO002"> Meja <br>
                        <input type="checkbox" name="add-on[]" value="AO003"> Kulkas <br>
                    </td>
                    <td>
                      <input type="checkbox" name="add-on[]" value="AO004"> Kipas Angin <br>
                      <input type="checkbox" name="add-on[]" value="AO005"> AC <br>
                      <input type="checkbox" name="add-on[]" value="AO006"> Rice Cooker <br>
                    </td>
                  </table>
                </center>
              </td>
              </tr>
                <td colspan="3">
                  <center>
                    <button type="reset" class="btn btn-sm btn-primary">Reset</button>
                    <button type="submit" class="btn btn-sm btn-primary">Register</button>
                  </center>
                </td>
              </tr>
            </table>
          </form>
        </center>
        </div>
        </div>
    </div>
</body>
</html>