<?php

try
		{

	$bdd = new PDO('mysql:host=localhost;dbname=bcg','root','Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

			if (isset($_POST['Enregistrer'])) {

				$nomEmploye = htmlspecialchars($_POST['nomEmploye']);
				$genre = htmlspecialchars($_POST['genre']);
				$adresse = htmlspecialchars($_POST['adresse']);
				$tel = htmlspecialchars($_POST['tel']);	
				$email = htmlspecialchars($_POST['email']);			
				$departement = htmlspecialchars($_POST['departement']);
				$fonction = htmlspecialchars($_POST['fonction']);

				$password = sha1(bcg1234);

				// var_export($_POST);
				// var_export($password); 
				

				if (!empty($nomEmploye) AND !empty($genre)AND !empty($adresse) AND !empty($tel)AND !empty($email) AND !empty($departement) AND !empty($fonction) ){


// la création d'un matricule
							$countMat = $bdd->query("SELECT COUNT(*) AS nombre FROM employe");
					      $countMat = $countMat->fetch();
						

					      $oldMat =$bdd->query("SELECT * FROM employe ORDER BY dateEnregistrement DESC");
					      $oldMat = $oldMat->fetch();


					        $oldCode = explode('/', $oldMat['matricule']);
					        $newCode = $oldCode[1] + 1;
					        if ($countMat["nombre"] == 0) {
					        	$matricule = "BCG/00001/".date('Y');
					        	
					        }elseif (strlen($newCode) < 5) {
					            $nbr0 = 5 - strlen($newCode);
					            $zero = str_repeat("0", $nbr0);
					            $code=$zero.$newCode;
					            $matricule = "BCG/".$code."/".date('Y');
					            // echo $matricule;
					        }else{
					            $code=$newCode;
					            $matricule = "BCG/".$code."/".date('Y');
					            // echo $matricule;
					        }
							

						$testnom = $bdd -> prepare("SELECT id FROM employe WHERE nomEmploye= ? ");
						$testnom -> execute(array($nomEmploye));

							if ($testnom -> rowCount() < 1) {

							$insert = $bdd->prepare("INSERT INTO employe (matricule, nomEmploye, genre, adresse, tel,  email, password,  departement, fonction, etatService, photoEmploye) VALUES(:matricule, :nomEmploye, :genre, :adresse, :tel,:email, :password, :departement, :fonction, :etatService, :photoEmploye)");
							
							$insert->execute(array(
								'matricule'=>$matricule,
								'nomEmploye'=>$nomEmploye,
								'genre'=>$genre, 
								'adresse'=>$adresse,
								'tel'=>$tel, 
								'email'=>$email,
								'password'=>$password,

								'departement'=>$departement, 
								'fonction'=>$fonction, 
								'etatService'=> "En Service",
								'photoEmploye'=>"no-avatar.jpg"));


									$testevent = $bdd -> prepare("SELECT id_events FROM events WHERE nomEmploye= ? ");

									$testevent -> execute(array($nomEmploye));

							if ($testevent -> rowCount() < 1) {

								$ins = $bdd->prepare('INSERT INTO events (nomEmploye, etatService) VALUES (:nomEmploye, :etatService)');
								$ins->execute(array('nomEmploye'=>$nomEmploye,'etatService'=> "En Service"));

									}
									
								$return = "Employé créé avec succès";

							header("location:afficherEmploye.php");


							}else $return = " l'agent ".$nomEmploye." existe déjà  ";
							

					}else $return = "Champs manquant!";
			}

}
	catch(Exception $e){
	die("erreur".$e->getMessage());
	}

				

?>
<div style=" background-color: #0f983d; " class="gtco-container">
			<h1 style="color: black; text-align: center;">ENREGISTREMENT EMPLOYE</h1>
			<div style=" background-color: #0f983d; " class="row">
				
				
			</div>
			
		</div>

<?php 
	 require_once('includes/header.php');
 ?>

 <div class="gtco-loader"></div>
	
	<div >
<header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" style="background-image: url(images/img_bg_2.jpg)">
		<div class="overlay"></div>
		<div class="gtco-container h-100">

							<div class="container-fluid h-100" >
								<div class="row h-50">
									<div class="container">
										<div class="row ">
											<div class="col text-center" data-animate-effect="fadeInUp">
												<img src="bcglogo.png" alt="Logo" id="logo" />
											</div>
										</div>
										<div class="row h-100 align-items-center">
											<div class="col">
												<div class="row ">
											<div class="col-md-6">

												<div class="form-wrap ">
													<div class="tab">
														
														<div class="tab-content" >
															<div class="tab-content-inner active" data-content="signup">
																<h3><i class=" fa fa-home"></i>	Tableau de Bord</h3>

																	<ul class="dropdown">
																		<?php echo '<li><a href="departement.php">Departements</a></li>'; ?>
																		<?php echo '<li><a href="employe.php">Personnel</a></li>'; ?>
																		<?php echo '<li><a href="conge.php">Congés</a></li>'; ?>
																		<?php echo '<li><a href="salaire.php">Salaires</a></li>'; ?>
																		<?php echo '<li><a href="statistique.php">Statistique</a></li>'; ?>
																
																	</ul>
															</div>
															
														</div>


													</div>
												</div>

											</div>

											<div class="col-md-6 y-5">
												
												<div class="form-wrap ">
													<div class="tab">
														
														<div class="tab-content">
															<div class="tab-content-inner active" data-content="signup">
																<h3>Gestion des employé(e)s</h3>

																<li><a href="afficherEmploye.php">Afiichage de l'Employé</a></li>

															</div>
																	
														</div>
																	
													</div>
												</div>

											</div>
											</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							</div>

						</header>


	<div class="col-md-12" style=" background-color: #0f983d; " id="gtco-subscribe">
	<!-- <div  > -->
		<div class="gtco-container">
			<div class="row animate-box">
				<div class="col-md-12 col-md-offset-2 text-center gtco-heading">
					<h2>ENREGISTREMENT</h2>
					<p>Employé</p>
					<p style="color: red;"><?php if(isset ($_POST['Enregistrer']) AND isset($return)) echo $return; ?></p>
				</div>
			</div>
			<div class="row animate-box">
				<div class="col-md-12 col-md-offset-2">
					<form style="color: black;" class="form-inline" action="#" method="POST" enctype="multipart/form-data" >

				<div class="col-md-12 col-md-push-1">
				<div class="gtco-widget">

					<fieldset>
						<legend>Identité et Adresse</legend>			
							
						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="name">Nom :</label>
								<input type="text"  name="nomEmploye" id="name" class="form-control" placeholder="Nom Post-nom Prénom" value="<?php if(isset($nomEmploye)) { echo $nomEmploye;} ?>">
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<select class="form-control" name="genre" value="<?php if(isset($genre)) { echo $genre;} ?>"  >
									<option disabled selected>Genre</option>
									    <option value="H" style="color: black;"> Homme </option>
                                    	<option value="F" style="color: black;"> Femme </option>
                                 </select>
							</div>
							
						</div>
				
						<div class="row form-group">

							<div class="col-md-12">
								<label class="sr-only" for="name">Adresse :</label>
								<input type="text" name="adresse" id="name" class="form-control" placeholder="Adresse" value="<?php if(isset($adresse)) { echo $adresse;} ?>">
							</div>
                        
						</div>
					</fieldset>
				</div>
				</div>

				<div class="col-md-6 col-md-push-1">
				<div class="gtco-widget">

					<fieldset>
						<legend>Contact</legend>
						<div class="col-md-12">
							<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="name">Téléphone :</label>
								<input type="text"  name="tel" id="name" class="form-control" placeholder="Téléphone" value="<?php if(isset($tel)) { echo $tel;} ?>">
							</div>
							</div>

							<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="name">Email :</label>
								<input type="email"  name="email" id="name" class="form-control" placeholder="Email" value="<?php if(isset($email)) { echo $email;} ?>">
							</div>
							</div>
						</div>
					</fieldset>
				</div>
				</div>

				<div class="col-md-6 col-md-push-1">
				<div class="gtco-widget">

					<fieldset>
						<legend>Département et Fonction</legend>		
							<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="name">Departement</label>

								<select class="form-control" name="departement" value="<?php if(isset($departement)) { echo $departement;} ?>"  >

									<option disabled selected>Departement</option>
									<option value="Dev_Produit_Cartographiques" style="color: black;">Développement de produits cartographiques</option>				
									<option value="Systeme_Gestion_Donnees" style="color: black;">Système et Gestion des Données</option>
									<option value="Suivievaluation_Controle_Qualite" style="color: black;">Suiviévaluation contrôle qualité</option>
									<option value="Catalogage_Document" style="color: black;">Catalogage-Document</option>
                                    	
                                 </select>
							</div>
							
						</div>


						<div class="row form-group">

							<div class="col-md-12">
								<label class="sr-only" for="name">Fonction :</label>
								<input type="text" name="fonction" id="name" class="form-control" placeholder="Fonction" value="<?php if(isset($fonction)) { echo $fonction;} ?>">
							</div>
                        
						</div>

					</fieldset>

				</div>
				</div>

				<div class="col-md-6 col-md-push-1">
				<div class="gtco-widget">

						<div class="form-group">
							<input type="submit"  id="Enregistrer" name="Enregistrer" value="Enregistrer" class="btn btn-primary">
						</div>

				</div>
				</div>
					</form>
				</div>
			</div>
		</div>
	</div>


  <?php 

	 require_once('includes/footer.php');

  ?>
<script src="js/jquery.min.js"></script>

<script src="sweetalert2/dist/sweetalert2.all.js"></script>

	<script src="sweetalert2/dist/sweetalert2.all.min.js"></script>
	
	<script src="js/jquery.easing.1.3.js"></script>

	<script src="js/bootstrap.min.js"></script>

	<script src="js/jquery.waypoints.min.js"></script>

	<script src="js/owl.carousel.min.js"></script>

	<script src="js/jquery.countTo.js"></script>

	<script src="js/jquery.stellar.min.js"></script>

	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	
	<script src="js/bootstrap-datepicker.min.js"></script>

	<script src="js/main.js"></script>

	<script type="text/javascript">
		
	$("#Enregistrer").click(function(){

		Swal.fire(
			  'Enregistrement!',
			  'Réussi!',
			  'success'
			)

	})

	</script>