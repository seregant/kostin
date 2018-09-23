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
                <th colspan="3"><center><h2>Input Data User</h2></center></th>
              </tr>
              <tr>
                <td>Nama User</td>
                <td>&nbsp;:&nbsp;</td>
                <td><input type="text" name="nama"></td>
              </tr>
              <tr>
                <td>Username</td>
                <td>&nbsp;:&nbsp;</td>
                <td><input type="text" name="username"></td>
              </tr>
              <tr>
                <td>Password</td>
                <td>&nbsp;:&nbsp;</td>
                <td><input type="password" name="psw"></td>
              </tr>
               <tr>
                <td>Hak Akses</td>
                <td>&nbsp;:&nbsp;</td>
                <td>
                  <select>
                    <option value="admin">Admin</option>
                    <option value="fO">FO</option>
                    <option value="user">User Kos</option>
                  </select>
                </td>
              </tr>
 
                  

                </center>
              </td>
              </tr>
                <td colspan="3">
                  <center>
                    <button type="reset" class="btn btn-sm btn-primary">Reset</button>
                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
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