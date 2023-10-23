<?php
	session_start();
	include('assets/inc/config.php');
		if(isset($_POST['add_patient_presc']))
		{
			$pres_pat_name = $_POST['pres_pat_name'];
			$pres_pat_number = $_POST['pres_pat_number'];
            $pres_pat_type = $_POST['pres_pat_type'];
            $pres_pat_addr = $_POST['pres_pat_addr'];
            $pres_pat_age = $_POST['pres_pat_age'];
            $pres_number = $_POST['pres_number'];
            $pres_ins = $_POST['pres_ins'];
            $pres_pat_ailment = $_POST['pres_pat_ailment'];
          
			$query="INSERT INTO  his_prescriptions  (pres_pat_name, pres_pat_number, pres_pat_type, pres_pat_addr, pres_pat_age, pres_number, pres_pat_ailment, pres_ins) VALUES(?,?,?,?,?,?,?,?)";
			$stmt = $mysqli->prepare($query);
			$rc=$stmt->bind_param('ssssssss', $pres_pat_name, $pres_pat_number, $pres_pat_type, $pres_pat_addr, $pres_pat_age, $pres_number, $pres_pat_ailment, $pres_ins);
			$stmt->execute();

			if($stmt)
			{
				$success = "Ordonnace ajouté";
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
                                                 <li class="breadcrumb-item"><a href="his_doc_dashboard.php">Tableau de bord</a></li>
                                                <li class="breadcrumb-item"><a href="javascript: void(0);">Pharmacie</a></li>
                                                <li class="breadcrumb-item active">Ajouter ordonnance</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">Ajouter une ordonnance</h4>
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
                                                        <label for="inputEmail4" class="col-form-label">Nom </label>
                                                        <input type="text" required="required" readonly name="pres_pat_name" value="<?php echo $row->pat_fname;?> <?php echo $row->pat_lname;?>" class="form-control" id="inputEmail4" placeholder="Nom du patient">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="inputPassword4" class="col-form-label">Âge</label>
                                                        <input required="required" type="text" readonly name="pres_pat_age" value="<?php echo $row->pat_age;?>" class="form-control"  id="inputPassword4" placeholder="Âge du patient">
                                                    </div>

                                                </div>

                                                <div class="form-row">

                                                    <div class="form-group col-md-4">
                                                        <label for="inputEmail4" class="col-form-label">Numéro</label>
                                                        <input type="text" required="required" readonly name="pres_pat_number" value="<?php echo $row->pat_number;?>" class="form-control" id="inputEmail4" placeholder="Numéro du patient">
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label for="inputPassword4" class="col-form-label">Adresse</label>
                                                        <input required="required" type="text" readonly name="pres_pat_addr" value="<?php echo $row->pat_addr;?>" class="form-control"  id="inputPassword4" placeholder="Adresse du patient">
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label for="inputPassword4" class="col-form-label">Catégorie</label>
                                                        <input required="required" readonly type="text" name="pres_pat_type" value="<?php echo $row->pat_type;?>" class="form-control"  id="inputPassword4" placeholder="Type du patient">
                                                    </div>

                                                </div>

                                                <div class="form-group ">
                                                        <label for="inputCity" class="col-form-label">Maladie </label>
                                                        <input required="required" type="text" value="<?php echo $row->pat_ailment;?>" name="pres_pat_ailment" class="form-control" id="inputCity">
                                                </div>
                                                <hr>
                                                <div class="form-row">
                                                    
                                            
                                                    <div class="form-group col-md-2" style="display:none">
                                                        <?php 
                                                            $length = 5;    
                                                            $pres_no =  substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
                                                        ?>
                                                        <label for="inputZip" class="col-form-label">Numéro de l'ordonnance</label>
                                                        <input type="text" name="pres_number" value="<?php echo $pres_no;?>" class="form-control" id="inputZip">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                        <label for="inputAddress" class="col-form-label">Prescription</label>
                                                        <textarea required="required"  type="text" class="form-control" name="pres_ins" id="editor"></textarea>
                                                </div>

                                                <button type="submit" name="add_patient_presc" class="ladda-button btn btn-primary" data-style="expand-right">Ajouter ordonnance</button>
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