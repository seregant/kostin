<!DOCTYPE html>
<html>
<head>
  <title>R-Library - Register</title>
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
            <form name="registrasi" onsubmit="return regValidation()" action="index.html" method="get">
            <table width="70%">
              <tr>
                <th colspan="3"><center><h2>FORM KONFIRMASI PEMBAYARAN</h2></center></th>
              </tr>
              <tr>
                <td>Kode Booking</td>
                <td>&nbsp;:&nbsp;</td>
                <td><input type="text" name="nama"></td>
              </tr>
              <tr>
                <td>Tanggal Transer</td>
                <td>&nbsp;:&nbsp;</td>
                <td><input type="text" name="kodebook"></td>
              </tr>
              <tr>
                <td>Nama Pemilik Rekening</td>
                <td>&nbsp;:&nbsp;</td>
                <td><input type="password" name="psw"></td>
              </tr>
               <tr>
                <td>Jumlah Transfer</td>
                <td>&nbsp;:&nbsp;</td>
                <td>
                  <input type="text" name="kodebook">
                </td>
              </tr>              
                </center>
              </td>
              </tr>
              <tr>
                <td>Bukti Bayar</td>
                <td>&nbsp;:&nbsp;</td>
                <td><input type="file" id="exampleInputFile"></td>
              </tr>
                <td colspan="3">
                  <center>
                    <button type="submit" class="btn btn-sm btn-primary">Kirim</button>
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