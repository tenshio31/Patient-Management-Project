<?php
  session_start();
  include('assets/inc/config.php');
  include('assets/inc/checklogin.php');
  check_login();
  $aid=$_SESSION['ad_id'];
  if(isset($_GET['delete_mdr_number']))
  {
        $id=intval($_GET['delete_mdr_number']);
        $adn="DELETE FROM his_medical_records WHERE  mdr_number = ?";
        $stmt= $mysqli->prepare($adn);
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $stmt->close();	 
  
          if($stmt)
          {
            $success = "Dossier médical supprimé";
          }
            else
            {
                $err = "Veuillez réessayer";
            }
    }
?>

<!DOCTYPE html>
<html lang="en">
    
<?php include('assets/inc/head.php');?>

    <body>
        <div id="wrapper">
                <?php include('assets/inc/nav.php');?>
                <?php include("assets/inc/sidebar.php");?>

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
                                    <h4 class="page-title">Voir dossiers médicaux</h4>
                                </div>
                            </div>
                        </div>     

                        <div class="row">
                            <div class="col-12">
                                <div class="card-box">
                                    <h4 class="header-title"></h4>
                                    <div class="mb-2">
                                        <div class="row">
                                            <div class="col-12 text-sm-center form-inline" >
                                                <div class="form-group">
                                                    <input id="demo-foo-search" type="text" placeholder="Rechercher" class="form-control form-control-sm" autocomplete="on">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="table-responsive">
                                        <table id="demo-foo-filtering" class="table table-bordered toggle-circle mb-0" data-page-size="7">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th data-toggle="true">Nom du patient</th>
                                                <th data-hide="phone">Numéro </th>
                                                <th data-hide="phone">Adresse</th>
                                                <th data-hide="phone">Maladie</th>
                                                <th data-hide="phone">Âge</th>
                                                <th data-hide="phone">Action</th>
                                            </tr>
                                            </thead>
                                            <?php
                                                $ret="SELECT * FROM  his_medical_records ORDER BY RAND() ";
                                                $stmt= $mysqli->prepare($ret) ;
                                                $stmt->execute() ;//ok
                                                $res=$stmt->get_result();
                                                $cnt=1;
                                                while($row=$res->fetch_object())
                                                {
                                            ?>

                                                <tbody>
                                                <tr>
                                                    <td><?php echo $cnt;?></td>
                                                    <td><?php echo $row->mdr_pat_name;?></td>
                                                    <td><?php echo $row->mdr_pat_number;?></td>
                                                    <td><?php echo $row->mdr_pat_adr;?></td>
                                                    <td><?php echo $row->mdr_pat_ailment;?></td>
                                                    <td><?php echo $row->mdr_pat_age;?> Ans</td>
                                                    <td>
                                                        <a href="his_admin_view_single_medical_record.php?mdr_id=<?php echo $row->mdr_id;?>&&mdr_number=<?php echo $row->mdr_number;?>" class="badge badge-success"><i class="fas fa-eye"></i> Voir</a>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            <?php  $cnt = $cnt +1 ; }?>
                                            <tfoot>
                                            <tr class="active">
                                                <td colspan="8">
                                                    <div class="text-right">
                                                        <ul class="pagination pagination-rounded justify-content-end footable-pagination m-t-10 mb-0"></ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tfoot>
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
        <script src="assets/libs/footable/footable.all.min.js"></script>
        <script src="assets/js/pages/foo-tables.init.js"></script>
        <script src="assets/js/app.min.js"></script>
        
    </body>

</html>