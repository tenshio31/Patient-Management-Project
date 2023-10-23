<?php
  session_start();
  include('assets/inc/config.php');
  include('assets/inc/checklogin.php');
  check_login();
  $aid=$_SESSION['ad_id'];
?>

<!DOCTYPE html>
    <html lang="en">

    <?php include('assets/inc/head.php');?>

    <body>
        <div id="wrapper">
            <?php include("assets/inc/nav.php");?>
            <?php include("assets/inc/sidebar.php");?>

            <?php
                $pat_number=$_GET['pat_number'];
                $pat_id=$_GET['pat_id'];
                $ret="SELECT  * FROM his_patients WHERE pat_id=?";
                $stmt= $mysqli->prepare($ret) ;
                $stmt->bind_param('i',$pat_id);
                $stmt->execute() ;//ok
                $res=$stmt->get_result();
                //$cnt=1;
                while($row=$res->fetch_object())
            {
                $mysqlDateTime = $row->pat_date_joined;
            ?>
            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tableau de bord</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Patients</a></li>
                                            <li class="breadcrumb-item active">Voir patients</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Profile de <?php echo $row->pat_fname;?> <?php echo $row->pat_lname;?></h4>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-xl-4">
                                <div class="card-box text-center">
                                    <img src="assets/images/users/patient.png" class="rounded-circle avatar-lg img-thumbnail"
                                        alt="profile-image">

                                    
                                    <div class="text-left mt-3">
                                        
                                        <p class="text-muted mb-2 font-13"><strong>Nom complet :</strong> <span class="ml-2"><?php echo $row->pat_fname;?> <?php echo $row->pat_lname;?></span></p>
                                        <p class="text-muted mb-2 font-13"><strong>Téléphone :</strong><span class="ml-2"><?php echo $row->pat_phone;?></span></p>
                                        <p class="text-muted mb-2 font-13"><strong>Adresse :</strong> <span class="ml-2"><?php echo $row->pat_addr;?></span></p>
                                        <p class="text-muted mb-2 font-13"><strong>Date de naissance :</strong> <span class="ml-2"><?php echo $row->pat_dob;?></span></p>
                                        <p class="text-muted mb-2 font-13"><strong>Âge :</strong> <span class="ml-2"><?php echo $row->pat_age;?> Ans</span></p>
                                        <p class="text-muted mb-2 font-13"><strong>Maladie :</strong> <span class="ml-2"><?php echo $row->pat_ailment;?></span></p>
                                        <hr>
                                        <p class="text-muted mb-2 font-13"><strong>Ajouté le :</strong> <span class="ml-2"><?php echo date("d/m/Y - h:m", strtotime($mysqlDateTime));?></span></p>
                                        <hr>




                                    </div>
                                </div> 
                            </div> 
                            
                            <?php }?>
                            <div class="col-lg-8 col-xl-8">
                                <div class="card-box">
                                    <ul class="nav nav-pills navtab-bg nav-justified">
                                        <li class="nav-item">
                                            <a href="#aboutme" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                                Prescription
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="tab-content">
                                        <div class="tab-pane show active" id="aboutme">
                                             <ul class="list-unstyled timeline-sm">
                                                <?php
                                                    $pres_pat_number =$_GET['pat_number'];
                                                    $ret="SELECT  * FROM his_prescriptions WHERE pres_pat_number ='$pres_pat_number'";
                                                    $stmt= $mysqli->prepare($ret) ;
                                                    $stmt->execute() ;//ok
                                                    $res=$stmt->get_result();
                                                    //$cnt=1;
                                                    
                                                    while($row=$res->fetch_object())
                                                        {
                                                    $mysqlDateTime = $row->pres_date; 

                                                ?>
                                                    <li class="timeline-sm-item">
                                                        <span class="timeline-sm-date"><?php echo date("Y-m-d", strtotime($mysqlDateTime));?></span>
                                                        <h5 class="mt-0 mb-1"><?php echo $row->pres_pat_ailment;?></h5>
                                                        <p class="text-muted mt-2">
                                                            <?php echo $row->pres_ins;?>
                                                        </p>

                                                    </li>
                                                <?php }?>
                                            </ul>                                        
                                        </div>
                                        </div>
                                    </div> 
                                </div> 
                            </div> 
                        </div>
                    </div> 
                </div> 

                <?php include('assets/inc/footer.php');?>

            </div>
        </div>
        <div class="rightbar-overlay"></div>

        <script src="assets/js/vendor.min.js"></script>
        <script src="assets/js/app.min.js"></script>

    </body>


</html>