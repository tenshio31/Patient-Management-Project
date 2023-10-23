<?php
	session_start();
	include('assets/inc/config.php');
		if(isset($_POST['add_patient_mdr']))
		{
			$mdr_pat_name = $_POST['mdr_pat_name'];
			$mdr_pat_number = $_POST['mdr_pat_number'];
            $mdr_pat_adr = $_POST['mdr_pat_adr'];
            $mdr_pat_age = $_POST['mdr_pat_age'];
            $mdr_number = $_POST['mdr_number'];
            $mdr_pat_prescr = $_POST['mdr_pat_prescr'];
            $mdr_pat_ailment = $_POST['mdr_pat_ailment'];
 
			$query="INSERT INTO  his_medical_records  (mdr_pat_name, mdr_pat_number, mdr_pat_adr, mdr_pat_age, mdr_number, mdr_pat_prescr, mdr_pat_ailment) VALUES(?,?,?,?,?,?,?)";
			$stmt = $mysqli->prepare($query);
			$rc=$stmt->bind_param('sssssss', $mdr_pat_name, $mdr_pat_number, $mdr_pat_adr, $mdr_pat_age, $mdr_number, $mdr_pat_prescr, $mdr_pat_ailment);
			$stmt->execute();

			if($stmt)
			{
				$success = "Dossier médical ajouté";
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
                $pat_number = $_GET['pat_number'];
                $ret="SELECT  * FROM his_patients WHERE pat_number=?";
                $stmt= $mysqli->prepare($ret) ;
                $stmt->bind_param('s',$pat_number);
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tableau de bord</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dossiers médicaux</a></li>
                                            <li class="breadcrumb-item active">Ajouter dossier médical</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">Ajouter un dossier médical</h4>
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

                                                    <div class="form-group col-md-4">
                                                        <label for="inputEmail4" class="col-form-label">Nom du patient</label>
                                                        <input type="text" required="required" readonly name="mdr_pat_name" value="<?php echo $row->pat_fname;?> <?php echo $row->pat_lname;?>" class="form-control" id="inputEmail4" placeholder="Nom du patient">
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label for="inputPassword4" class="col-form-label">Âge</label>
                                                        <input required="required" type="text" readonly name="mdr_pat_age" value="<?php echo $row->pat_age;?>" class="form-control"  id="inputPassword4" placeholder="Age du patient">
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label for="inputPassword4" class="col-form-label">Adresse</label>
                                                        <input required="required" type="text" readonly name="mdr_pat_adr" value="<?php echo $row->pat_addr;?>" class="form-control"  id="inputPassword4" placeholder="Patient`s Last Name">
                                                    </div>

                                                </div>

                                                <div class="form-row">

                                                    <div class="form-group col-md-6">
                                                        <label for="inputEmail4" class="col-form-label">Numéro du patient</label>
                                                        <input type="text" required="required" readonly name="mdr_pat_number" value="<?php echo $row->pat_number;?>" class="form-control" id="inputEmail4" placeholder="DD/MM/YYYY">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="inputPassword4" class="col-form-label">Maladie</label>
                                                        <input required="required" type="text" readonly name="mdr_pat_ailment" value="<?php echo $row->pat_ailment;?>" class="form-control"  id="inputPassword4" placeholder="Patient`s Age">
                                                    </div>
                                                </div>
                                                <?php }?>
                                                <hr>
                                                <div class="form-row">
                                                    
                                            
                                                    <div class="form-group col-md-2" style="display:none">
                                                        <?php 
                                                            $length = 5;    
                                                            $pres_no =  substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
                                                        ?>
                                                        <label for="inputZip" class="col-form-label">Numéro du dossier médical</label>
                                                        <input type="text" name="mdr_number" value="<?php echo $pres_no;?>" class="form-control" id="inputZip">
                                                    </div>
                                                </div>
                                                <?php
                                                    $pres_pat_number = $_GET['pat_number'];
                                                    $ret="SELECT  * FROM his_prescriptions WHERE pres_pat_number = ?";
                                                    $stmt= $mysqli->prepare($ret) ;
                                                    $stmt->bind_param('s',$pres_pat_number);
                                                    $stmt->execute() ;//ok
                                                    $res=$stmt->get_result();
                                                    //$cnt=1;
                                                    while($row=$res->fetch_object())
                                                    {
                                                ?>
                                                <div class="form-group">
                                                        <label for="inputAddress" class="col-form-label">Patient's Prescription</label>
                                                        <textarea required="required"  type="text" class="form-control" name="mdr_pat_prescr" id="editor"><?php echo $row->pres_ins;?> </textarea>
                                                </div>
                                                <?php }?>

                                                <button type="submit" name="add_patient_mdr" class="ladda-button btn btn-primary" data-style="expand-right">Ajouter dossier médical</button>

                                            </form>
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