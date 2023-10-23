<?php
  session_start();
  include('assets/inc/config.php');
  include('assets/inc/checklogin.php');
  check_login();
  $aid=$_SESSION['ad_id'];
?>
<!DOCTYPE html>
<html lang="en">
    
<?php include ('assets/inc/head.php');?>

    <body>
        <div id="wrapper">

            <?php include('assets/inc/nav.php');?>
            <?php include("assets/inc/sidebar.php");?>

            <?php
                $mdr_number=$_GET['mdr_number'];
                $mdr_id=$_GET['mdr_id'];
                $ret="SELECT  * FROM his_medical_records WHERE mdr_id = ?";
                $stmt= $mysqli->prepare($ret) ;
                $stmt->bind_param('i',$mdr_id);
                $stmt->execute() ;//ok
                $res=$stmt->get_result();
                //$cnt=1;
                while($row=$res->fetch_object())
                {
                    $mysqlDateTime = $row->mdr_date_rec;
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Rapports</a></li>
                                            <li class="breadcrumb-item active">Dossiers médicaux</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">#<?php echo $row->mdr_number;?></h4>
                                    </div>
                                </div>
                            </div> 

                            <div class="row">
                                <div class="col-12">
                                    <div class="card-box">
                                        <div class="row">
                                            <div class="col-xl-5">

                                                <div class="tab-content pt-0">

                                                    <div class="tab-pane active show" id="product-1-item">
                                                        <img src="assets/images/medical_record.png" alt="" class="img-fluid mx-auto d-block rounded">
                                                    </div>
                            
                                                </div>
                                            </div>
                                            <div class="col-xl-7">
                                                <div class="pl-xl-3 mt-3 mt-xl-0">
                                                    <h2 class="mb-3">Nom : <?php echo $row->mdr_pat_name;?></h2>
                                                    <hr>
                                                    <h3 class="text-danger">Âge : <?php echo $row->mdr_pat_age;?> Ans</h3>
                                                    <hr>
                                                    <h3 class="text-danger ">Numéro  : <?php echo $row->mdr_pat_number;?></h3>
                                                    <hr>
                                                    <h3 class="text-danger ">MAladie : <?php echo $row->mdr_pat_ailment;?></h3>
                                                    <hr>
                                                    <h3 class="text-danger ">Date d'enregistrement : <?php echo date("d/m/Y - h:m:s", strtotime($mysqlDateTime));?></h3>
                                                    <hr>
                                                    <h2 class="align-centre">Prescription</h2>
                                                    <hr>
                                                    <p class="text-muted mb-4">
                                                        <?php echo $row->mdr_pat_prescr;?>
                                                    </p>
                                                    <hr>
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
            <?php }?>

        </div>
        <div class="rightbar-overlay"></div>
        <script src="assets/js/vendor.min.js"></script>
        <script src="assets/js/app.min.js"></script>
        
    </body>

</html>