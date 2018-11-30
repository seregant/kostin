<?php
    include 'header.php';

    //menentukan action form agar unik per request
?>
<div class="container ">
    <form class="form-cust" method="get" action="reset_password.php">
        <div class="col-md-6 mx-auto form-bg form-border" >
            <center style="padding-top: 1em;"><h4>Reset Password</h4></center>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Masukkan Username/Password anda.</label><br>
                        <input type="text" class="form-control " id="usr" name="credential" >
                    </div>                   
                    <div class="col text-center">
                        <button type="submit" class="btn btn-primary " style="max-width: 50%;">Reset Password</button>
                    </div>
        </div>   
    </form>

</div>

<?php
    include 'footer.php';
?>