<?php  
					session_start();
                      $t=time();
                      if (isset($_SESSION['logged']) && ($t - $_SESSION['logged'] > 900)) {


                      session_destroy();
                      	 // echo"<script>alert('Your are logged out');</script>";
                      session_unset();
                      header('location: index.php');
                      exit;

                      }else {$_SESSION['logged'] = time();}
 
?>

<?php
// session_start();
if (!isset($_SESSION['idAdmin'], $_SESSION['nomAdmin'],$_SESSION['postnomAdmin'])) {
	header('location:index.php');
}
?>

<!DOCTYPE HTML>

<html>
	<head>
	
	<title>Direction &mdash; Liste stagiaire </title>
	<meta http-equiv="refresh" content="900;url=logout.php" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/icomoon.css">
	<link rel="stylesheet" href="css/themify-icons.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/magnific-popup.css">
	<link rel="stylesheet" href="css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="js/modernizr-2.6.2.min.js"></script>

	</head>
	<body>
		
<div class="gtco-loader"></div>
	
	<div id="page">

	
		<nav class="gtco-nav" role="navigation">
		<div class="gtco-container">
			
			<div class="row">
				<div class="col-sm-4 col-xs-12">
					<!-- <div id="gtco-logo"><a href="index.php"><h4 style="color: red;">BUREAU DE CENTRALISATION GEOMATIQUE &copy;</h4></a></div> -->
					<div id="gtco-logo"><a href="index.php"><img src="bu.png" alt="Logo" id="logo" width="100px" /></a></div>
				</div>
				<br>
				<div class="col-xs-8 text-right menu-1">
					<ul>
							
								<li><a href="accueil.php">Accueil</a></li>
							
							<li><a href="logout.php" class="btn btn-danger">Deconnexion</a></li>
							
						
			
					</ul>	
				</div>
			</div>
			
		</div>
	</nav>
	
	<header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" style="background-image: url(images/img_bg_2.jpg)">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-left">
					

					<div class="row row-mt-15em">
						<div class="col-md-7 mt-text animate-box" data-animate-effect="fadeInUp">
							<blockquote><img src="bcglogo.png" alt="Logo" id="logo" /></blockquote>
							<h1>DIRECTION</h1>	
						</div>
						<div class="col-md-4 col-md-push-1 animate-box" data-animate-effect="fadeInRight">
							<div class="form-wrap">
								<div class="tab">
									
									<div class="tab-content">
										<div class="tab-content-inner active" data-content="signup">
											
											<form action="#" method="GET" ?>

											<div class="row form-group">
													<div class="col-md-12">
														<input type="text" name="recherche" id="fullname" class="form-control" placeholder="Recherche">
													</div>
												</div>
												
												
												<div class="row form-group">
													<div class="col-md-12">
														<input type="submit" name="rechercher" class="btn btn-primary btn-block" value="Rechercher">
													</div>
												</div>
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

			</form>	
			</div>
		</div>
	</div>

		</div>
	</header>


	<!-- <div style=" background-color: #0f983d; " id="gtco-subscribe"> -->
	<!-- <div  > -->
		<div class="gtco-container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
					<h2>Stagiaires</h2>
					<p>Affichages</p>
				</div>
			</div>
		</div>

<?php 
$bdd = new PDO('mysql:host=localhost;dbname=bcg', 'root', 'Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

$rech = $bdd->query('SELECT * FROM stagiaire ORDER BY idStagiaire DESC LIMIT 5');


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
			<div class="col-md-12 text-center gtco-heading">
			
			<div class=" col-md-12 table-responsive">
				<table id="customer_data" class="table table-bordered  table-striped">
			<thead>
			
				<tr>
					<th>Id</th>
					<th>Nom</th>
					<th>Post-nom</th>
					<th>Prénom</th>
					<th>Genre</th>
					<th>Université</th>
					<th>Sujet</th>
					<th>Encadreur</th>
					<th>Superviseur</th>
					<th>Editeur</th>
					<th>PromotionStage</th>
					<th>Debut Stage</th>
					<th>Fin Stage</th>
					<th>Durée</th>
				</tr>
			</thead>

				<?php
					$id=1;
				 while($row = $rech->fetch()) { ?>
				<tr>
					<td><?php echo $id++;?></td>
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
					
					<td><?php echo '<a style="color:black;" href="supprimer.php?id='.$row['idStagiaire'].'" onclick="return confirm(\'voulez-vous supprimer '.$row['nomStagiaire'].' '.$row['postnomStagiaire'].' ?\');" class="btn btn-warning">Supprimer</a>'; ?></td>
					
				</tr>

			<?php } ?>
		</table>
	</div>
</div>
<?php } else { echo '<p style = "color:black;text-align:center;">Aucun resultat</p>'.$recherche;  } ?>
	
	<form method="POST" action="excel_stagiaire.php">
		<input type="submit" name="export_excel" class="btn btn-succes" value="Exporter en Excel">
	</form>

		</div>
			</div>
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2">
					
				</div>
			</div>
		</div>
	</div>
	<style>
		table,tr,th,td{
			border: 3px solid white;
		}
	</style>


	<footer id="gtco-footer" role="contentinfo">
		<div class="gtco-container">
			<div class="row row-p	b-md">

				<div class="col-md-4">
					<div class="gtco-widget">
						<h3>A propos</h3>
						<p>Le Secrétariat Exécutif Permanent du Bureau de Centralisation Géomatique, est responsable de la mise en
							œuvre de la politique et des orientations stratégiques du BCG. Plus particulièrement, ses rôles sont :<br>
							orchestrer le développement de l’Infrastructure Nationale Des Données Spaciales du Burundi(INDSB).
							coordonner les activités des différentes institutions publiques en matière de géomatique ;
							assurer la gestion des flux d’information suivant conventions d’échange et de partage de données passées
							avec les différentes institutions.</p>
					</div>
				</div>

				<div class="col-md-2 col-md-push-1">
					<div class="gtco-widget">
						<h3>Services</h3>
						<ul class="gtco-footer-links">
							<li><a href="#">Développement de produits cartographiques</a></li>					
													<li><a href="#">Maintenance Système et Gestion des Données</a></li>
													<li><a href="#">Suiviévaluation contrôle qualité</a></li>
													<li><a href="#">Catalogage-Document</a></li>
						</ul>
					</div>
				</div>


			<div class="col-md-2 col-md-push-1">
					<div class="gtco-widget">
						<h3>Raccourcis</h3>
						<ul>
							<li><a href="logout.php">Deconnexion</a></li>
							<li><a href="accueil.php">Accueil</a></li>
							<li><a href="inscription.php">Inscription</a></li>
						</ul>	
					</div>
				</div>

				<div class="col-md-3 col-md-push-1">
					<div class="gtco-widget">
						<h3>Contact</h3>
						<ul class="gtco-quick-contact">
							<li><a href="#"> <blockquote> Building du Ministère de Finance, 3ème étage, Boulevard du Japon, Bujumbura, Burundi</blockquote></a></li>
							<li><a href="#"><i class="icon-mail2"></i> info@sp-bcg.gov.bi</a></li>
							
						</ul>
					</div>
				</div>

			</div>

			<div class="row copyright">
				<div class="col-md-12">
					<p class="pull-left">
						<small class="block">Copyright &copy; Bureau de Centralisation Géomatique</small> 
						<small class="block">Designed by IGUGU ETIENNE Tshisekedi</small>
					</p>
					
				</div>
			</div>

		</div>
	</footer>

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

	</body>
</html>