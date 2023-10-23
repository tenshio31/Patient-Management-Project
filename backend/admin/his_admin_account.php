<?php
	session_start();
	include('assets/inc/config.php');
		if(isset($_POST['update_profile']))
		{
			$ad_fname=$_POST['ad_fname'];
			$ad_lname=$_POST['ad_lname'];
			$ad_id=$_SESSION['ad_id'];
            $ad_email=$_POST['ad_email'];

            $ad_dpic=$_FILES["ad_dpic"]["name"];
		    move_uploaded_file($_FILES["ad_dpic"]["tmp_name"],"assets/images/users/".$_FILES["ad_dpic"]["name"]);

 
			$query="UPDATE his_admin SET ad_fname=?, ad_lname=?,  ad_email=?, ad_dpic=? WHERE ad_id = ?";
			$stmt = $mysqli->prepare($query);
			$rc=$stmt->bind_param('ssssi', $ad_fname, $ad_lname, $ad_email, $ad_dpic, $ad_id);
			$stmt->execute();

			if($stmt)
			{
				$success = "Profile Updated";
			}
			else {
				$err = "Please Try Again Or Try Later";
			}
			
			
        }
        if(isset($_POST['update_pwd']))
		{
            $ad_id=$_SESSION['ad_id'];
            $ad_pwd=sha1(md5($_POST['ad_pwd']));
            
			$query="UPDATE his_admin SET ad_pwd =? WHERE ad_id = ?";
			$stmt = $mysqli->prepare($query);
			$rc=$stmt->bind_param('si', $ad_pwd, $ad_id);
			$stmt->execute();
			if($stmt)
			{
				$success = "Password Updated";
			}
			else {
				$err = "Please Try Again Or Try Later";
			}
			
			
		}
?>
<!DOCTYPE html>
    <html lang="en">
        <?php include('assets/inc/head.php');?>
    <body>

        <div id="wrapper">
            <?php include('assets/inc/nav.php');?>

                <?php include('assets/inc/sidebar.php');?>

            <?php
                $aid=$_SESSION['ad_id'];
                $ret="select * from his_admin where ad_id=?";
                $stmt= $mysqli->prepare($ret) ;
                $stmt->bind_param('i',$aid);
                $stmt->execute() ;//ok
                $res=$stmt->get_result();
                //$cnt=1;
                while($row=$res->fetch_object())
                {
            ?>
                <div class="content-page">
                    <div class="content">


                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-12">
                                    <div class="page-title-box">
                                        <div class="page-title-right">
                                            <ol class="breadcrumb m-0">
                                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                                <li class="breadcrumb-item active">Profile</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title"><?php echo $row->ad_fname;?> <?php echo $row->ad_lname;?>'s Profile</h4>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-xl-4">
                                    <div class="card-box text-center">
                                        <img src="assets/images/users/<?php echo $row->ad_dpic;?>" class="rounded-circle avatar-lg img-thumbnail"
                                            alt="profile-image">

                                        <h4 class="mb-0"><?php echo $row->ad_fname;?> <?php echo $row->ad_lname;?></h4>
                                        <p class="text-muted">@System_Administrator_HMIS</p>
                                        <div class="text-left mt-3">
                                            <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span class="ml-2"><?php echo $row->ad_fname;?> <?php echo $row->ad_lname;?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ml-2 "><?php echo $row->ad_email;?></span></p>
                                        </div>

                                    </div> 
                                   
                                </div> 

                                <div class="col-lg-8 col-xl-8">
                                    <div class="card-box">
                                        <ul class="nav nav-pills navtab-bg nav-justified">
                                            <li class="nav-item">
                                                <a href="#aboutme" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                                    Modifier profile
                                                </a>
                                            </li>
                                            
                                            <li class="nav-item">
                                                <a href="#settings" data-toggle="tab" aria-expanded="false" class="nav-link">
                                                    Changer mot de passe
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="aboutme">

                                            <form method="post" enctype="multipart/form-data">
                                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle mr-1"></i> Personal Info</h5>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="firstname">Nom</label>
                                                                <input type="text" name="ad_fname"  class="form-control" id="firstname" placeholder="<?php echo $row->ad_fname;?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="lastname">Prénom</label>
                                                                <input type="text" name="ad_lname" class="form-control" id="lastname" placeholder="<?php echo $row->ad_lname;?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="useremail">E-mail</label>
                                                                <input type="email" name="ad_email" class="form-control" id="useremail" placeholder="<?php echo $row->ad_email;?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="useremail">Photo de profile</label>
                                                                <input type="file" name="ad_dpic" class="form-control btn btn-success" id="useremail" placeholder="<?php echo $row->ad_email;?>">
                                                            </div>
                                                        </div>
                                                        
                                                    </div> 

                                                    
                                                    <div class="text-right">
                                                        <button type="submit" name="update_profile" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Enregistrer</button>
                                                    </div>
                                                </form>


                                            </div>                                      

                                            <div class="tab-pane" id="settings">
                                                <form method="post">
                                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle mr-1"></i>Informations personnelles</h5>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="firstname">Ancien mot de passe</label>
                                                                <input type="password" class="form-control" id="firstname" placeholder="Enter Old Password">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="lastname">Nouveau mot de passe</label>
                                                                <input type="password" class="form-control" name="ad_pwd" id="lastname" placeholder="Enter New Password">
                                                            </div>
                                                        </div> 
                                                    </div> 

                                                    <div class="form-group">
                                                        <label for="useremail">Confirmer mot de passe</label>
                                                        <input type="password" class="form-control" id="useremail" placeholder="Confirm New Password">
                                                    </div>

                                                    <div class="text-right">
                                                        <button type="submit" name="update_pwd" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Mettre à jour</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div> 
                    </div>
                    <?php include("assets/inc/footer.php");?>

                </div>
            <?php }?>
        </div>
        <div class="rightbar-overlay"></div>
        <script src="assets/js/vendor.min.js"></script>
        <script src="assets/js/app.min.js"></script>

    </body>


</html>
