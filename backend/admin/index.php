<?php
    session_start();
    include('assets/inc/config.php');
    if(isset($_POST['admin_login']))
    {
        $ad_email=$_POST['ad_email'];
        $ad_pwd=sha1(md5($_POST['ad_pwd']));
        $stmt=$mysqli->prepare("SELECT ad_email ,ad_pwd , ad_id FROM his_admin WHERE ad_email=? AND ad_pwd=? ");
        $stmt->bind_param('ss',$ad_email,$ad_pwd);
        $stmt->execute();
        $stmt -> bind_result($ad_email,$ad_pwd,$ad_id);
        $rs=$stmt->fetch();
        $_SESSION['ad_id']=$ad_id;

        if($rs)
            {
                header("location:his_admin_dashboard.php");
            }

        else
            {
                $err = "Accès refusé";
            }
    }
?>
<!DOCTYPE html>
<html lang="en">
    
<head>
        <meta charset="utf-8" />
        <title>Gestion Patient</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="" name="description" />
        <meta content="" name="MartDevelopers" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
        
        <script src="assets/js/swal.js"></script>
        <?php if(isset($success)) {?>
                <script>
                            setTimeout(function () 
                            { 
                                swal("Succès","<?php echo $success;?>","Succès");
                            },
                                100);
                </script>

        <?php } ?>

        <?php if(isset($err)) {?>
                <script>
                            setTimeout(function () 
                            { 
                                swal("Erreur","<?php echo $err;?>","Erreur");
                            },
                                100);
                </script>

        <?php } ?>



    </head>

    <body class="authentication-bg authentication-bg-pattern">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-pattern">

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                    <a href="index.php">
                                        <span><img src="assets/images/logo_logo.png" alt="" height="35"></span>
                                    </a>
                                    <p class="text-muted mb-4 mt-3">Saisissez votre numéro et votre mot de passe pour accéder au système.</p>
                                </div>

                                <form method='post' >

                                    <div class="form-group mb-3">
                                        <label for="emailaddress">E-mail</label>
                                        <input class="form-control" name="ad_email" type="email" id="emailaddress" required="" placeholder="Enter your email">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password">Mot de passe</label>
                                        <input class="form-control" name="ad_pwd" type="password" required="" id="password" placeholder="Enter your password">
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary btn-block" name="admin_login" type="submit"> Se connecter </button>
                                    </div>

                                </form>
                            </div> 
                        </div>

                        <div class="row mt-3">
                        </div>
                    </div> 
                </div>
            </div>
        </div>


        <?php include ("assets/inc/footer1.php");?>
        <script src="assets/js/vendor.min.js"></script>
        <script src="assets/js/app.min.js"></script>
        
    </body>

</html>