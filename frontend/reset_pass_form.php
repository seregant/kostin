<?php
    //menentukan action form agar unik mengikuti req safekey
    $action = "reset_password.php?id=".$_GET['id']."&safekey=".$_GET['safekey'];
?>

<div class="container ">
    <form class="form-cust" method="post" action="<?php echo $action; ?>">
        <div class="col-md-6 mx-auto form-bg form-border" >
            <center style="padding-top: 1em;"><h4>Reset Password</h4></center>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Masukkan password baru anda :</label><br>
                        <input type="password" class="form-control " id="usr" name="newpass" ><br>
                        <label for="exampleFormControlSelect1">Ulangi password :</label><br>
                        <input type="password" class="form-control " id="usr" name="renewpass" >
                    </div>                   
                    <div class="col text-center">
                        <button type="submit" class="btn btn-primary " style="max-width: 50%;">Reset Password</button>
                    </div>
        </div>   
    </form>

</div>
