<div style=" background-color: #0f983d; " class="gtco-container">
			<h1 style="color: black; text-align: center;">GESTION DU STAGIAIRE</h1>
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

											<div class="col-md-6 ">
												
												<div class="form-wrap ">
													<div class="tab">
														
														<div class="tab-content">
															<div class="tab-content-inner active" data-content="signup">
											<h3>Gestion des stagiaire</h3>
											
											<form action="" method="GET" ?>

												<div class="row form-group">
													<div class="col-md-12">
														
														<input style="color: black;" type="text"  name="recherche" id="name" class="form-control" placeholder="Nom Employer" value="<?php if(isset($_GET['recherche'])) { echo $_GET['recherche'];} ?>">
														 <button value="Rechercher" name="Rechercher" class="input-group-text btn-primary " id="basic-addon2"><i class="fa fa-search"></i></button> 
													</div>
												</div>
											</form>
											Nouveau stagiaire :<?php echo '<li style="color:red;"><a href="stage.php" style="color:red;">ici</a></li>'; ?>		
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
	
<?php 
$bdd = new PDO('mysql:host=localhost;dbname=bcg', 'root', 'Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

$rech = $bdd->query('SELECT * FROM stagiaire ORDER BY idStagiaire DESC');


if (isset($_GET['recherche']) AND !empty($_GET['recherche'])) {
	
		$recherche= htmlspecialchars($_GET['recherche']);

		$rech = $bdd->query('SELECT * FROM stagiaire WHERE nomStagiaire LIKE "'.$recherche.'%" ORDER BY idStagiaire DESC ');

			if ($rech->rowCount()==0) {
				
				$rech = $bdd->query('SELECT * FROM stagiaire WHERE postnomStagiaire LIKE "'.$recherche.'%" ORDER BY idStagiaire DESC ');

				if ($rech->rowCount()==0) {
					$rech = $bdd->query('SELECT * FROM stagiaire WHERE prenomStagiaire LIKE "'.$recherche.'%" ORDER BY idStagiaire DESC ');


					if ($rech->rowCount()==0) {
						$rech = $bdd->query('SELECT * FROM stagiaire WHERE genre LIKE "'.$recherche.'%" ORDER BY idStagiaire DESC ');

						if ($rech->rowCount()==0) {
							$rech = $bdd->query('SELECT * FROM stagiaire WHERE sujet LIKE "'.$recherche.'%" ORDER BY idStagiaire DESC ');


							if ($rech->rowCount()==0) {
								$rech = $bdd->query('SELECT * FROM stagiaire WHERE encadreur LIKE "'.$recherche.'%" ORDER BY idStagiaire DESC ');

								if ($rech->rowCount()==0) {
									$rech = $bdd->query('SELECT * FROM stagiaire WHERE superviseur LIKE "'.$recherche.'%" ORDER BY idStagiaire DESC ');

										if ($rech->rowCount()==0) {
												$rech = $bdd->query('SELECT * FROM stagiaire WHERE editeur LIKE "'.$recherche.'%" ORDER BY idStagiaire DESC ');
										}
			
								}

							}

						}

					}

				}
			}

}
 ?>
<?php if ($rech->rowCount() > 0) {
	
?>
 	
			<div  class="container box">
				<div class="col-md-12 col-md-offset-3 text-center gtco-heading">
			
			<div class=" col-md-12 table-responsive">
				<h2>Liste de stagiaires</h2>
				<table id="customer_data" class="table table-bordered table-dark  table-striped">
			<thead>
				<tr>
					<th style="color: black;">Id</th>
					<th style="color: black;">Nom</th>
					<th style="color: black;">Post-nom</th>
					<th style="color: black;">Prénom</th>
					<th style="color: black;">Genre</th>
					<th style="color: black;">Université</th>
					<th style="color: black;">Sujet</th>
					<th style="color: black;">Encadreur</th>
					<th style="color: black;">Superviseur</th>
					<th style="color: black;">Editeur</th>
					<th style="color: black;">PromotionStage</th>
					<th style="color: black;">Debut Stage</th>
					<th style="color: black;">Fin Stage</th>
					<th style="color: black;">Durée</th>
				</tr>
			</thead>	
		
				<?php
				$id=1; 

				while($row = $rech->fetch()) { ?>
				<tr>
					<td><?php echo $row['idStagiaire'];?></td>
					<td><?php echo $row['nomStagiaire'];?></td>
					<td><?php echo $row['postnomStagiaire'];?></td>
					<td><?php echo $row['prenomStagiaire'];?></td>
					<td><?php echo $row['genre'];?></td>
					<td><?php echo $row['institutionSc'];?></td>
					<td><?php echo $row['sujet'];?></td>
					<td><?php echo $row['encadreur'];?></td>
					<td><?php echo $row['superviseur'];?></td>
					<td><?php echo $row['editeur'];?></td>
					<td><?php echo $row['promotion'];?></td>
					<td><?php echo $row['debutStage'];?></td>
					<td><?php echo $row['finStage'];?></td>
					<td><?php echo $row['duree'];?></td>
					
				</tr>

			<?php } ?>
		</table>
<?php } else { echo '<p style = "color:black;">Aucun resultat</p>'.$recherche;  } ?>
	

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
	<style>
		table,tr,th,td{
			border: 3px solid white;
		}
	</style>


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