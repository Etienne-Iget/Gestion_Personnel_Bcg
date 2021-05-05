<?php 
try
		{

	$bdd = new PDO('mysql:host=localhost;dbname=bcg','root','Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

			if (isset($_POST['Enregistrer'])) {

				$nomStagiaire = htmlspecialchars($_POST['nomStagiaire']);	
				$postnomStagiaire = htmlspecialchars($_POST['postnomStagiaire']);	
				$prenomStagiaire = htmlspecialchars($_POST['prenomStagiaire']);	
				$genre = htmlspecialchars($_POST['genre']);	
				$institutionSc = htmlspecialchars($_POST['institutionSc']);	
				$sujet = htmlspecialchars($_POST['sujet']);	
				$encadreur = htmlspecialchars($_POST['encadreur']);	
				$superviseur = htmlspecialchars($_POST['superviseur']);	
				$editeur = htmlspecialchars($_POST['editeur']);	
				$promotion = htmlspecialchars($_POST['promotion']);	
				$debutStage = htmlspecialchars($_POST['debutStage']);	
				$finStage = htmlspecialchars($_POST['finStage']);	
				$duree = htmlspecialchars($_POST['duree']);

				if (!empty($nomStagiaire) AND !empty($postnomStagiaire)	AND !empty($prenomStagiaire)	AND !empty($genre)	AND !empty($institutionSc)	AND !empty($sujet)	AND !empty($encadreur) AND !empty($superviseur)	AND !empty($editeur)	AND !empty($promotion)	AND !empty($debutStage)	AND !empty($finStage)	AND !empty($duree)){


							$insert = $bdd->prepare("INSERT INTO stagiaire(nomStagiaire, postnomStagiaire, prenomStagiaire, genre, institutionSc, sujet, encadreur, superviseur, editeur, promotion, debutStage, finStage, duree) VALUES(:nomStagiaire, :postnomStagiaire, :prenomStagiaire, :genre, :institutionSc, :sujet, :encadreur, :superviseur, :editeur, :promotion, :debutStage, :finStage, :duree)");
							$insert->execute(array(
							'nomStagiaire' => $nomStagiaire,
							'postnomStagiaire' => $postnomStagiaire,
							'prenomStagiaire' => $prenomStagiaire,
							'genre' => $genre,
							'institutionSc' => $institutionSc,
							'sujet' => $sujet,
							'encadreur' => $encadreur,
							'superviseur' => $superviseur,
							'editeur' => $editeur,
							'promotion' => $promotion,
							'debutStage' => $debutStage,
							'finStage' => $finStage,
							'duree' => $duree));
							$return = "Stagiaire Enregistrer avec succès";											



				}else $return = "Champs manquant!";
			}

}
	catch(Exception $e){
	die("erreur".$e->getMessage());
	}
 ?>


<div style=" background-color: #0f983d; " class="gtco-container">
			<h1 style="color: black; text-align: center;">AJOUT DU STAGIAIRE</h1>
			<div style=" background-color: #0f983d; " class="row">
				
				
			</div>
			
		</div>

<?php 
	 require_once('includes/header.php');
 ?>

 <div class="gtco-loader"></div>
	
	<div>
	
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
											<div class="col">

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

											<div class="col ">
												
												<div class="form-wrap ">
													<div class="tab">
														
														<div class="tab-content">
															<div class="tab-content-inner active" data-content="signup">
																	<h3>Enregistrement</h3>

																		<?php echo '<li><a href="agent.php">Employés</a></li>'; ?>
																		<form method="POST" action="excel_employe.php">
																			<input type="submit" name="export_excel" class="btn btn-succes" value="Exporter en Excel">
																		</form>
																		<?php echo '<li><a href="stagiaire.php">Stagiaires</a></li>'; ?>

																		<form method="POST" action="excel_stagiaire.php">
																			<input type="submit" name="export_excel" class="btn btn-succes" value="Exporter en Excel">
																		</form>
										

																	
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


	<div style=" background-color: #0f983d; " id="gtco-subscribe">
	<!-- <div  > -->
		<div class="gtco-container">
			<div class="row animate-box">
				<div class="col-md-12 col-md-offset-2 text-center gtco-heading">
					<h2>Stagiaires</h2>
					<p>enregistrement</p>
	
				</div>
			</div>
			<div class="row animate-box">
				<div class="col-md-12 col-md-offset-2">
					<form style="color: black;" class="form-inline " action="" method="POST" enctype="multipart/form-data" >

						<!-- <fieldset>
						<legend> Photo de profil</legend>
						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="name">Photo :</label>
								<input type="file"  name="photo" id="name" class="form-control" placeholder="Photo de profile">
							</div>
						</div>
					</fieldset> -->

						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="name">Nom :</label>
								<input type="text"  name="nomStagiaire" id="name" class="form-control border border-primary" placeholder="Nom" value="<?php if(isset($nomStagiaire)) { echo $nomStagiaire;} ?>">
							</div>
						</div>

							<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="name">Post-nom :</label>
								<input type="text"  name="postnomStagiaire" id="name" class="form-control border border-primary" placeholder="Post-nom" value="<?php if(isset($postnomStagiaire)) { echo $postnomStagiaire;} ?>">
							</div>
							</div>
							<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="name">Prénom :</label>
								<input type="text"  name="prenomStagiaire" id="name" class="form-control border border-primary" placeholder="Prénom" value="<?php if(isset($prenomStagiaire)) { echo $prenomStagiaire;} ?>">
							</div>
							</div>
							
						<div class="row form-group">
								
							<div class="col-md-12">
								<label class="sr-only" for="name">Genre</label>
								<select class="form-control border border-primary" name="genre" value="<?php if(isset($genreStagiaire)) { echo $genreStagiaire;} ?>"  >
										<option  style="color: black;"> Genre </option>
                                    	<option value="Homme" style="color: black;"> Homme </option>
                                    	<option value="Femme" style="color: black;"> Femme </option>
                                 </select>
							</div>
							
						</div>

						<div class="row form-group">

							<div class="col-md-12">
								<label class="sr-only" for="name">Université :</label>
								<input type="text" name="institutionSc" id="name" class="form-control border border-primary" placeholder="Université" value="<?php if(isset($institutionSc)) { echo $institutionSc;} ?>">
							</div>
                        
						</div>



						<div class="row form-group">

							<div class="col-md-12">
								<label class="sr-only" for="name">Sujet :</label>
								<input type="text" name="sujet" id="name" class="form-control border border-primary" placeholder="Sujet" value="<?php if(isset($sujet)) { echo $sujet;} ?>">
							</div>
                        
						</div>
						<div class="row form-group">

							<div class="col-md-12">
								<label class="sr-only" for="name">Encadreur :</label>
								<input type="text" name="encadreur" id="name" class="form-control border border-primary" placeholder="Encadreur" value="<?php if(isset($encadreur)) { echo $encadreur;} ?>">
							</div>
                        
						</div>

						<div class="row form-group">

							<div class="col-md-12">
								<label class="sr-only" for="name">Superviseur :</label>
								<input type="text" name="superviseur" id="name" class="form-control border border-primary" placeholder="Superviseur" value="<?php if(isset($superviseur)) { echo $superviseur;} ?>">
							</div>
                        
						</div>
						<div class="row form-group">

							<div class="col-md-12">
								<label class="sr-only" for="name">Editeur :</label>
								<input type="text" name="editeur" id="name" class="form-control border border-primary" placeholder="Editeur" value="<?php if(isset($editeur)) { echo $editeur;} ?>">
							</div>
                        
						</div>

						<div class="row form-group">

							<div class="col-md-12">
								<label class="sr-only" for="name">Promotion :</label>
								<input type="text" name="promotion" id="name" class="form-control border border-primary" placeholder="Promotion de Stage" value="<?php if(isset($promotion)) { echo $promotion;} ?>">
							</div>
                        
						</div>

						<div class="row form-group">

							<div class="col-md-12">
								<label  for="name">Debut du Stage :</label>
								<input type="date" name="debutStage" id="name" class="form-control border border-primary" placeholder="Debut du Stage" value="<?php if(isset($debutStage)) { echo $debutStage;} ?>">
							</div>
                        
						</div>

						<div class="row form-group">

							<div class="col-md-12">
								<label  for="name">Fin du Stage :</label>
								<input type="date" name="finStage" id="name" class="form-control border border-primary" placeholder="Fin du Stage" value="<?php if(isset($finStage)) { echo $finStage;} ?>">
							</div>
                        
						</div>

						<div class="row form-group">

							<div class="col-md-12">
								<label class="sr-only" for="name">Durée du Stage :</label>
								<input type="text" name="duree" id="name" class="form-control border border-primary" placeholder="Durée du Stage" value="<?php if(isset($duree)) { echo $duree;} ?>">
							</div>
                        
						</div>




						
						<div class="form-group">
							<input type="submit" name="Enregistrer" value="Enregistrer" class="btn btn-primary">
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