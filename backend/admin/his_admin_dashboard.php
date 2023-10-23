<?php
  session_start();
  include('assets/inc/config.php');
  include('assets/inc/checklogin.php');
  check_login();
  $aid=$_SESSION['ad_id'];
?>
<!DOCTYPE html>
<html lang="en">
    
    <?php include("assets/inc/head.php");?>

    <body>

        <div id="wrapper">

            <?php include('assets/inc/nav.php');?>
            <?php include('assets/inc/sidebar.php');?>

            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    
                                    <h4 class="page-title">TABLEAU DE BORD</h4>
                                </div>
                            </div>
                        </div>     

                        <div class="row">
                            <div class="col-md-6 col-xl-6">
                                <div class="widget-rounded-circle card-box">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                                <i class="fab fa-accessible-icon  font-22 avatar-title text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <?php 
                                                    $result ="SELECT count(*) FROM his_patients WHERE pat_type = 'En consultation externe' ";
                                                    $stmt = $mysqli->prepare($result);
                                                    $stmt->execute();
                                                    $stmt->bind_result($outpatient);
                                                    $stmt->fetch();
                                                    $stmt->close();
                                                ?>
                                                <h3 class="text-dark mt-1"><span data-plugin="counterup"><?php echo $outpatient;?></span></h3>
                                                <p class="text-muted mb-1 text-truncate">Patients en consultation externe</p>
                                            </div>
                                        </div>
                                    </div> 
                                </div> 
                            </div> 

                            <div class="col-md-6 col-xl-6">
                                <div class="widget-rounded-circle card-box">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                                <i class="mdi mdi-hotel   font-22 avatar-title text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <?php 
                                                    $result ="SELECT count(*) FROM his_patients WHERE pat_type = 'Hospitalisé' ";
                                                    $stmt = $mysqli->prepare($result);
                                                    $stmt->execute();
                                                    $stmt->bind_result($inpatient);
                                                    $stmt->fetch();
                                                    $stmt->close();
                                                ?>
                                                <h3 class="text-dark mt-1"><span data-plugin="counterup"><?php echo $inpatient;?></span></h3>
                                                <p class="text-muted mb-1 text-truncate">Patients hospitalisés</p>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div> 
                        
                        </div>

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card-box">
                                    <h4 class="header-title mb-3">Employés</h4>

                                    <div class="table-responsive">
                                        <table class="table table-borderless table-hover table-centered m-0">

                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Nom</th>
                                                    <th>Prénom(s)</th>
                                                    <th>Maladie</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <?php
                                                $ret="SELECT * FROM his_patients ORDER BY RAND() LIMIT 10 "; 
                                                $stmt= $mysqli->prepare($ret) ;
                                                $stmt->execute() ;//ok
                                                $res=$stmt->get_result();
                                                $cnt=1;
                                                while($row=$res->fetch_object())
                                                {
                                            ?>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <?php echo $row->pat_fname;?> 
                                                    </td>    
                                                    <td>
                                                        <?php echo $row->pat_lname;?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row->pat_ailment;?>
                                                    </td>
                                                    <td>
                                                        <a href="his_admin_view_single_patient.php?pat_id=<?php echo $row->pat_id;?>&&pat_number=<?php echo $row->pat_number;?>" class="btn btn-xs btn-primary"><i class="mdi mdi-eye"></i> Voir</a>
                                                    </td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
                                                </tr>
                                            </tbody>
                                            <?php }?>
                                        </table>
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
        <script src="assets/libs/flatpickr/flatpickr.min.js"></script>
        <script src="assets/libs/jquery-knob/jquery.knob.min.js"></script>
        <script src="assets/libs/jquery-sparkline/jquery.sparkline.min.js"></script>
        <script src="assets/libs/flot-charts/jquery.flot.js"></script>
        <script src="assets/libs/flot-charts/jquery.flot.time.js"></script>
        <script src="assets/libs/flot-charts/jquery.flot.tooltip.min.js"></script>
        <script src="assets/libs/flot-charts/jquery.flot.selection.js"></script>
        <script src="assets/libs/flot-charts/jquery.flot.crosshair.js"></script>
        <script src="assets/js/pages/dashboard-1.init.js"></script>
        <script src="assets/js/app.min.js"></script>
        
    </body>

</html>