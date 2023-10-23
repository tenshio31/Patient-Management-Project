<!--Server side code to handle  Patient Registration-->
<?php
	session_start();
	include('assets/inc/config.php');
		if(isset($_POST['update_patient_presc']))
		{
			$pres_pat_name = $_POST['pres_pat_name'];
            $pres_pat_type = $_POST['pres_pat_type'];
            $pres_pat_addr = $_POST['pres_pat_addr'];
            $pres_pat_age = $_POST['pres_pat_age'];
            $pres_number = $_GET['pres_number'];
            $pres_ins = $_POST['pres_ins'];
            $pres_pat_ailment = $_POST['pres_pat_ailment'];
			$query="UPDATE   his_prescriptions  SET pres_pat_name = ?, pres_pat_type = ?, pres_pat_addr = ?, pres_pat_age = ?, pres_pat_ailment = ?, pres_ins = ? WHERE pres_number = ?";
			$stmt = $mysqli->prepare($query);
			$rc=$stmt->bind_param('sssssss', $pres_pat_name, $pres_pat_type, $pres_pat_addr, $pres_pat_age,  $pres_pat_ailment, $pres_ins, $pres_number);
			$stmt->execute();
			if($stmt)
			{
				$success = "Ordonnance à jour";
            }
            else {
                $err = "Veuillez réessayer";
			}
			
			
		}
?>
<!DOCTYPE html>
<html lang="en">
    <?php include('assets/inc/head.php');?>
    <body>
        <div id="wrapper">

            <?php include("assets/inc/nav.php");?>
            <?php include("assets/inc/sidebar.php");?>

            <?php
                $pres_number = $_GET['pres_number'];
                $ret="SELECT  * FROM his_prescriptions WHERE pres_number=?";
                $stmt= $mysqli->prepare($ret) ;
                $stmt->bind_param('s',$pres_number);
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
                                                 <li class="breadcrumb-item"><a href="his_doc_dashboard.php">Tableau de bord</a></li>
                                                <li class="breadcrumb-item"><a href="javascript: void(0);">Pharmacie</a></li>
                                                <li class="breadcrumb-item active">Mise à jour ordonnances</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">Mise à jour d'une ordonnance</h4>
                                    </div>
                                </div>
                            </div>   
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="header-title">Veuillez remplir tous les champs</h4>
                                            <form method="post">
                                                <div class="form-row">

                                                    <div class="form-group col-md-6">
                                                        <label for="inputEmail4" class="col-form-label">Nom</label>
                                                        <input type="text" required="required" readonly name="pres_pat_name" value="<?php echo $row->pres_pat_name;?>" class="form-control" id="inputEmail4" placeholder="Nom du patient">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="inputPassword4" class="col-form-label">Âge</label>
                                                        <input required="required" type="text" readonly name="pres_pat_age" value="<?php echo $row->pres_pat_age;?>" class="form-control"  id="inputPassword4" placeholder="Âge du patient">
                                                    </div>

                                                </div>

                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="inputPassword4" class="col-form-label">Adresse </label>
                                                        <input required="required" type="text" readonly name="pres_pat_addr" value="<?php echo $row->pres_pat_addr;?>" class="form-control"  id="inputPassword4" placeholder="Adresse du patient">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="inputPassword4" class="col-form-label">Catégorie</label>
                                                        <input required="required" readonly type="text" name="pres_pat_type" value="<?php echo $row->pres_pat_type;?>" class="form-control"  id="inputPassword4" placeholder="Type du patient">
                                                    </div>

                                                </div>

                                                <div class="form-group ">
                                                        <label for="inputCity" class="col-form-label">Maladie </label>
                                                        <input required="required" type="text" value="<?php echo $row->pres_pat_ailment;?>" name="pres_pat_ailment" class="form-control" id="inputCity">
                                                </div>
                                                <hr>
                                                

                                                <div class="form-group">
                                                        <label for="inputAddress" class="col-form-label">Prescription</label>
                                                        <textarea required="required"  type="text" class="form-control" name="pres_ins" id="editor"><?php echo $row->pres_ins;?></textarea>
                                                </div>

                                                <button type="submit" name="update_patient_presc" class="ladda-button btn btn-primary" data-style="expand-right">Mettre à jour</button>

                                            </form>
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
        <script src="//cdn.ckeditor.com/4.6.2/basic/ckeditor.js"></script>
        <script type="text/javascript">
        CKEDITOR.replace('editor')
        </script>
        <script src="assets/js/vendor.min.js"></script>
        <script src="assets/js/app.min.js"></script>
        <script src="assets/libs/ladda/spin.js"></script>
        <script src="assets/libs/ladda/ladda.js"></script>
        <script src="assets/js/pages/loading-btn.init.js"></script>
        
    </body>

</html>