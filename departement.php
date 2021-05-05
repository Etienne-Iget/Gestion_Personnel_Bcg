
<div style=" background-color: #0f983d; " class="gtco-container">
			<h1 style="color: black; text-align: center;">DEPARTEMENTS</h1>
			<div style=" background-color: #0f983d; " class="row">
				
				
			</div>
			
		</div>

<?php 
	 require_once('includes/header.php');
 ?>
		
	<div class="gtco-loader"></div>

<br>	
	<div>

	</div>			
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
											<div class="col-md-6 y-5 ">

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

											<div class="col-md-6">
												
												<div class="form-wrap ">
													<div class="tab">
														
														<div class="tab-content">
															<div class="tab-content-inner active" data-content="signup">
																<h3>Departement</h3>
																	<ul class="dropdown">
																		<li><a href="?action=Dev_Produit_Cartographiques">Développement de produits cartographiques</a></li>
																		<li><a href="?action=Systeme_Gestion_Donnees">Maintenance Système et Gestion des Données</a></li>
																		<li><a href="?action=Suivievaluation_Controle_Qualite">Suivi et évaluation contrôle qualité</a></li>
																		<li><a href="?action=Catalogage_Document">Catalogage-Document</a></li>
																	</ul>
															</div>
																	
														</div>
																	<form method="POST" action="excel_activite.php">
																	<label  for="name">Liste d'activités :</label>
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

						</header>



<?php 


				$bdd = new PDO('mysql:host=localhost;dbname=bcg', 'root', 'Iget1209');
			

		if (isset($_GET['action']) ) {
			
			if ($_GET['action']=='Dev_Produit_Cartographiques') {


								$getaction=$_GET['action'];

			
				$af = $bdd->query ('SELECT * FROM employe WHERE departement LIKE "%'.$getaction.'%" ORDER BY dateEnregistrement DESC ');

				?>

				<?php if ($af->rowCount() > 0) {
 

				?>
					<div  class="container box">
				<div class="col-md-12 col-md-offset-3 text-center gtco-heading">
			
			<div class=" col-md-12 table-responsive">
				<h2>Développement de produits cartographiques</h2>
				<table id="customer_data" class="table table-bordered table-dark  table-striped">
			<thead>

					<tr>
						
						<th>Matricule</th>
						<th>Nom</th>
						<th>Département</th>
						<th>Fonction</th>
					</tr>
			</thead>

					<?php while($row = $af->fetch()) { ?>
					<tr>
						<td><?php echo $row['matricule'];?></td>
						<td><?php echo $row['nomEmploye'];?></td>
						<td><?php echo $row['departement'];?></td>
						<td><?php echo $row['fonction'];?></td>
						<td><?php echo '<a style="color:black;" href="?id='.$row['id'].'" onclick="return confirm(\'voulez-vous lui donner une activité ?\');" class="btn btn-warning">Activité</a>'; ?></td>
						
					</tr>
				<?php } ?>
				</table>
			</div>
		</div>

			</div>
			<?php } ?>

	<?php
	
			}elseif ($_GET['action']=='Systeme_Gestion_Donnees') {

					$getaction=$_GET['action'];

			
				$af = $bdd->query ('SELECT * FROM employe WHERE departement LIKE "'.$getaction.'" ORDER BY dateEnregistrement DESC ');

				?>

				<?php if ($af->rowCount() > 0) {
 

				?>
				<div  class="container box">
				<div class="col-md-12 col-md-offset-3 text-center gtco-heading">
			
			<div class=" col-md-12 table-responsive">
				<h2>Maintenance Système et Gestion des Données</h2>
				<table id="customer_data" class="table table-bordered table-dark  table-striped">
					<tr>
						
						<th>Matricule</th>
						<th>Nom</th>
						<th>Département</th>
						<th>Fonction</th>
					</tr>

					<?php while($row = $af->fetch()) { ?>
					<tr>
						<td><?php echo $row['matricule'];?></td>
						<td><?php echo $row['nomEmploye'];?></td>
						<td><?php echo $row['departement'];?></td>
						<td><?php echo $row['fonction'];?></td>
						<td><?php echo '<a style="color:black;" href="?id='.$row['id'].'" onclick="return confirm(\'voulez-vous lui donner une activité ?\');" class="btn btn-warning">Activité</a>'; ?></td>
						
					</tr>
					<?php } ?>
				</table>

				</div>
				</div>
			</div>

					<?php }
				?>
					

	<?php
				
			}elseif ($_GET['action']=='Suivievaluation_Controle_Qualite') {


								$getaction=$_GET['action'];

			
				$af = $bdd->query ('SELECT * FROM employe WHERE departement LIKE "'.$getaction.'" ORDER BY dateEnregistrement DESC ');

				?>

				<?php if ($af->rowCount() > 0) {
 

				?>
				<div  class="container box">
				<div class="col-md-12 col-md-offset-3 text-center gtco-heading">
			
			<div class=" col-md-12 table-responsive">
				<h2>Suivi et évaluation contrôle qualité</h2>
				<table id="customer_data" class="table table-bordered table-dark  table-striped">
					<tr>
						
						<th>Matricule</th>
						<th>Nom</th>
						<th>Département</th>
						<th>Fonction</th>
					</tr>

					<?php while($row = $af->fetch()) { ?>
					<tr>
						<td><?php echo $row['matricule'];?></td>
						<td><?php echo $row['nomEmploye'];?></td>
						<td><?php echo $row['departement'];?></td>
						<td><?php echo $row['fonction'];?></td>
						<td><?php echo '<a style="color:black;" href="?id='.$row['id'].'" onclick="return confirm(\'voulez-vous lui donner une activité ?\');" class="btn btn-warning">Activité</a>'; ?></td>
						
					</tr>
					<?php } ?>
				</table>

				</div>
			</div>
		</div>

					<?php } ?>


	<?php
				
			}elseif ($_GET['action']=='Catalogage_Document') {



				$getaction=$_GET['action'];

			
				$af = $bdd->query ('SELECT * FROM employe WHERE departement LIKE "'.$getaction.'" ORDER BY dateEnregistrement DESC ');

				?>

				<?php if ($af->rowCount() > 0) {
 

				?>
				<div  class="container box">
				<div class="col-md-12 col-md-offset-3 text-center gtco-heading">
			
			<div class=" col-md-12 table-responsive">
				<h2>Catalogage-Document</h2>
				<table id="customer_data" class="table table-bordered table-dark  table-striped">
					<tr>
						
						<th>Matricule</th>
						<th>Nom</th>
						<th>Département</th>
						<th>Fonction</th>
					</tr>

					<?php while($row = $af->fetch()) { ?>
					<tr>
						<td><?php echo $row['matricule'];?></td>
						<td><?php echo $row['nomEmploye'];?></td>
						<td><?php echo $row['departement'];?></td>
						<td><?php echo $row['fonction'];?></td>
						<td><?php echo '<a style="color:black;" href="?id='.$row['id'].'" onclick="return confirm(\'voulez-vous lui donner une activité ?\');" class="btn btn-warning">Activité</a>'; ?></td>
						
					</tr>
					<?php } ?>
				</table>

				</div>
			</div>
		</div>

					<?php 

					} 

					}?>

	<?php
		
			
		}

 	?>

<?php 
$bdd = new PDO('mysql:host=localhost;dbname=bcg', 'root', 'Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

$rech = $bdd->query('SELECT * FROM employe ORDER BY dateEnregistrement DESC ');


if (isset($_GET['recherche']) AND !empty($_GET['recherche'])) {
	
		$recherche= htmlspecialchars($_GET['recherche']);

		$rech = $bdd->query('SELECT * FROM employe WHERE matricule LIKE "%'.$recherche.'%" ORDER BY id DESC ');

			if ($rech->rowCount()==0) {
				
				$rech = $bdd->query('SELECT * FROM employe WHERE nomEmploye LIKE "%'.$recherche.'%" ORDER BY id DESC ');

				if ($rech->rowCount()==0) {
					$rech = $bdd->query('SELECT * FROM employe WHERE departement LIKE "%'.$recherche.'%" ORDER BY id DESC ');


					if ($rech->rowCount()==0) {
						$rech = $bdd->query('SELECT * FROM employe WHERE fonction LIKE "%'.$recherche.'%" ORDER BY id DESC ');

						if ($rech->rowCount()==0) {
							$rech = $bdd->query('SELECT * FROM employe WHERE etatService LIKE "%'.$recherche.'%" ORDER BY id DESC ');

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
				<h2>Affichage</h2>
				<table id="customer_data" class="table table-bordered table-dark  table-striped">
			<thead>
		
				<tr>
					<th>Id</th>
					<th>Matricule</th>
					<th>Nom</th>
					<th>Genre</th>
					<th>Adresse</th>
					<th>Téléphone</th>
					<th>Email</th>
					<th>Département</th>
					<th>Fonction</th>
					<th>Etat de Service</th>
					<th>Date d'Enregistrement</th>

				</tr>
			</thead>
				<?php 
				$id=1;
				while($row = $rech->fetch()) {  ?>
				<tr>
					<td><?php echo $id++;?></td>
					<td><?php echo $row['matricule'];?></td>
					<td><?php echo $row['nomEmploye'];?></td>
					<td><?php echo $row['genre'];?></td>
					<td><?php echo $row['adresse'];?></td>
					<td><?php echo $row['tel'];?></td>
					<td><?php echo $row['email'];?></td>
					<td><?php echo $row['departement'];?></td>
					<td><?php echo $row['fonction'];?></td>
					<td><?php echo $row['etatService'];?></td>
					<td><?php echo $row['dateEnregistrement'];?></td>
					<td><?php echo '<a style="color:black;" href="?id='.$row['id'].'" onclick="return confirm(\'voulez-vous lui donner une activité ?\');" class="btn btn-warning">Activité</a>'; ?></td>
					
					
					
				</tr>

			<?php } ?>
		</table>
<?php } else{ 
					if(isset($recherche)){
				 	echo '<p style = "color:black;">Aucun resultat</p>'.$recherche;  }

				 	} ?>
<?php
}
 ?>
</div></div></div>
 <?php 
 

 				if (isset($_GET['id']) AND $_GET['id']>0) {

 							$getid=intval($_GET['id']);

					$requser = $bdd->prepare('SELECT * FROM employe WHERE  id =?');
					$requser->execute(array($getid));

					$userinfo = $requser->fetch();

 				if ($_GET['id'] ==$getid) {

 					?>

 <?php

 function Securise($string){
		if (ctype_digit($string)) {
			$string=intval($string);
		}else{
			$string = strip_tags($string);
			$string = addcslashes($string, '%_');
		}
		return $string;
	}

	try
		{
		$bdd = new PDO('mysql:host=localhost;dbname=bcg','root','Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
			// formulaire inscription

			if (isset($_POST['donner'])) {

				$departement = Securise($_POST['departement']);			
				$fonction = Securise($_POST['fonction']);
				$nomEmploye = Securise($_POST['nomEmploye']);
				$activite = Securise($_POST['activite']);

				$documents =Securise($_POST['documents']);
				$mois=date("n");
				$annee = date("Y");
				

				if (!empty($departement) AND !empty($fonction) AND !empty($nomEmploye) AND !empty($activite)){	


						$verifActivite = $bdd->prepare('SELECT * FROM departement WHERE activite = ?  AND nomEmploye = ?');
						$verifActivite->execute(array($activite, $nomEmploye));

						// $userinfo = $verifActivite -> fetch();
				
						if($verifActivite -> rowcount() < 1){		



									$req= $bdd -> prepare(" INSERT INTO  departement (departement, fonction, nomEmploye, activite, documents, mois, annee) VALUES( :departement, :fonction, :nomEmploye, :activite, :documents, :mois, :annee)");
									$req->execute(array(
										'departement'=>$departement,
										'fonction'=>$fonction,
										'nomEmploye'=>$nomEmploye,
										'activite'=> $activite,
										'documents'=>$documents,
										'mois'=>$mois,
										'annee'=>$annee));



									$return = "l'activité donné à  ".$userinfo['nomEmploye']." ";

								}else $return = "l'activité a déjà été réalisé par  ".$userinfo['nomEmploye']." ";
									
									
				}else $return = "champs manquant!";
			}


		}
		catch(Exception $e){
		die("erreur".$e->getMessage());
	}

?>
			
<div style=" background-color: #0f983d ">
				
	<div class="col-md-12 col-md-push-1">
		<div class="gtco-widget">

			<p style="color: red;text-align: center;"><em><?php if(isset ($_POST['donner']) AND isset($return)) echo $return; ?></em></p>
				<h4 style="color: black; text-align: center;"> MATRICULE : <?php echo $userinfo['matricule']; ?></h4>
		</div>
</div>

								

				
		<div class="gtco-container">
			<div class="row justify-content-md-center">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading border border-primary">

					<form action="#" method="POST">
							
						<label style="color: black;">Département :</label>
						<input style="color: black;" type="text"  name="departement" id="name" class="form-control border border-primary" placeholder="Département" value="<?php echo $userinfo['departement'];?>">

						<label style="color: black;">Nom :</label>
						<input style="color: black;" type="text"  name="nomEmploye" id="name" class="form-control border border-primary" placeholder="Nom" value="<?php echo $userinfo['nomEmploye']; ?>">

						<label style="color: black;">Fonction :</label>
						<input style="color: black;" type="text"  name="fonction" id="name" class="form-control border border-primary" placeholder="Fonction" value="<?php echo $userinfo['fonction']; ?>">
						<br>
						
						<textarea id="comment" name="activite" cols="45" rows="8" maxlength="65525" required="required" class="border border-primary" placeholder="Activité"></textarea>
						<br>
						<label style="color: black;">Document :</label>
						<input type="file"  name="documents" id="name" class="form-control border border-primary" placeholder="Document" >

						<button type="submit" name="donner" class="btn btn-primary ">Donner</button>

					</form>

									
				</div>
			</div>
			
		</div>

	</div>

			
	<?php
 					
 				}
 			}
 		

  ?>

	
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