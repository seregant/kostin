<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Login</title>

    <!-- Fontfaces CSS-->
    <link href="template/css/font-face.css" rel="stylesheet" media="all">
    <link href="template/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="template/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="template/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="template/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="template/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="template/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="template/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="template/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="template/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="template/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="template/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="template/css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <?php if(isset($errMsg)){ ?>
                        <div class="alert alert-danger"><?php echo $errMsg; ?></div>
                    <?php } ?>
                    <div class="login-content" style="background-color: #2bb1ff;">
                        <div class="login-logo">
                            <a href="#">
                                <img src="images/icon/logo.png" alt="CoolAdmin">
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label style="color: white">Username / Email Address</label>
                                    <input class="au-input au-input--full" name="username" placeholder="Email / Username">
                                </div>
                                <div class="form-group">
                                    <label style="color: white">Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                                </div>
                                <button class="au-btn au-btn--block au-btn--blue m-b-20" type="submit">sign in</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="template/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="template/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="template/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="template/vendor/slick/slick.min.js">
    </script>
    <script src="template/vendor/wow/wow.min.js"></script>
    <script src="template/vendor/animsition/animsition.min.js"></script>
    <script src="template/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="template/vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="template/vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="template/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="template/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="template/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="template/vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="template/js/main.js"></script>

</body>

</html>
<!-- end document-->