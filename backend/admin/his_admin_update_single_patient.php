<?php
	session_start();
	include('assets/inc/config.php');
		if(isset($_POST['update_patient']))
		{
            $pat_id = $_GET['pat_id'];
			$pat_fname=$_POST['pat_fname'];
			$pat_lname=$_POST['pat_lname'];
			$pat_number=$_POST['pat_number'];
            $pat_phone=$_POST['pat_phone'];
            $pat_type=$_POST['pat_type'];
            $pat_addr=$_POST['pat_addr'];
            $pat_age = $_POST['pat_age'];
            $pat_dob = $_POST['pat_dob'];
            $pat_ailment = $_POST['pat_ailment'];
			$query="UPDATE  his_patients  SET pat_fname=?, pat_lname=?, pat_age=?, pat_dob=?, pat_number=?, pat_phone=?, pat_type=?, pat_addr=?, pat_ailment=? WHERE pat_id = ?";
			$stmt = $mysqli->prepare($query);
			$rc=$stmt->bind_param('sssssssssi', $pat_fname, $pat_lname, $pat_age, $pat_dob, $pat_number, $pat_phone, $pat_type, $pat_addr, $pat_ailment, $pat_id);
			$stmt->execute();
			if($stmt)
            {
                $success = "Information à jour";
            }
            else {
                $err = "Veuillez réessayerr";
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

            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="his_admin_dashboard.php">Tableau de bord</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Patients</a></li>
                                            <li class="breadcrumb-item active">Gérer patients Patients</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Mettre à jour les information du patient</h4>
                                </div>
                            </div>
                        </div>     
                        <?php
                            $pat_id=$_GET['pat_id'];
                            $ret="SELECT  * FROM his_patients WHERE pat_id=?";
                            $stmt= $mysqli->prepare($ret) ;
                            $stmt->bind_param('i',$pat_id);
                            $stmt->execute() ;//ok
                            $res=$stmt->get_result();
                            //$cnt=1;
                            while($row=$res->fetch_object())
                            {
                        ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Veuillez remplir tous les champs</h4>
                                        <form method="post">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                     <label for="inputEmail4" class="col-form-label">Nom</label>
                                                    <input type="text" required="required" name="pat_fname" class="form-control" id="inputEmail4" placeholder="Nom du patient">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputPassword4" class="col-form-label">Prénom(s)</label>
                                                    <input required="required" type="text" name="pat_lname" class="form-control"  id="inputPassword4" placeholder="Prénom(s) du patient">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4" class="col-form-label">Date de naissance</label>
                                                    <input type="text" required="required" name="pat_dob" class="form-control" id="inputEmail4" placeholder="DD/MM/YYYY">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputPassword4" class="col-form-label">Âge</label>
                                                    <input required="required" type="text" name="pat_age" class="form-control"  id="inputPassword4" placeholder="Âge du patient">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputAddress" class="col-form-label">Adresse</label>
                                                <input required="required" type="text" class="form-control" name="pat_addr" id="inputAddress" placeholder="Adresse du patient ">
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputCity" class="col-form-label">Téléphone</label>
                                                    <input required="required" type="text" name="pat_phone" class="form-control" id="inputCity">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputCity" class="col-form-label">Maladie</label>
                                                    <input required="required" type="text" name="pat_ailment" class="form-control" id="inputCity">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputState" class="col-form-label">Type du patient</label>
                                                    <select id="inputState" required="required" name="pat_type" class="form-control">
                                                        <option>Veuillez choisir</option>
                                                        <option>Hospitalisé</option>
                                                        <option>En consultation externe</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-2" style="display:none">
                                                    <?php 
                                                        $length = 5;    
                                                        $patient_number =  substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
                                                    ?>
                                                    <label for="inputZip" class="col-form-label">Numéro </label>
                                                    <input type="text" name="pat_number" value="<?php echo $patient_number;?>" class="form-control" id="inputZip">
                                                </div>
                                            </div>

                                            <button type="submit" name="update_patient" class="ladda-button btn btn-success" data-style="expand-right">Ajouter patient</button>

                                        </form>
                                    </div> 
                                </div> 
                            </div> 
                        </div>
                        <?php  }?>

                    </div> 

                </div>
                <?php include('assets/inc/footer.php');?>

            </div>
        </div>

        <div class="rightbar-overlay"></div>
        <script src="assets/js/vendor.min.js"></script>
        <script src="assets/js/app.min.js"></script>
        <script src="assets/libs/ladda/spin.js"></script>
        <script src="assets/libs/ladda/ladda.js"></script>
        <script src="assets/js/pages/loading-btn.init.js"></script>
        
    </body>

</html>