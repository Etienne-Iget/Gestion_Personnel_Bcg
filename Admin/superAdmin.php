<?php
session_start();

try
		{

	$bdd = new PDO('mysql:host=localhost;dbname=administration','root','Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

			if (isset($_POST['Enregistrer'])) {				

				$nomAdmin = htmlspecialchars($_POST['nomAdmin']);
				$postnomAdmin = htmlspecialchars($_POST['postnomAdmin']);
				$emailAdmin = htmlspecialchars($_POST['emailAdmin']);
				$passwordAdmin =sha1($_POST['passwordAdmin']);
				$confirmationAdmin = sha1($_POST['confirmationAdmin']);
				// var_export($_POST);
				if (!empty($nomAdmin) AND !empty($postnomAdmin)AND !empty($emailAdmin)AND !empty($passwordAdmin) AND !empty($confirmationAdmin)){

					if (filter_var($emailAdmin, FILTER_VALIDATE_EMAIL)) {

						if ($passwordAdmin==$confirmationAdmin) {

						$testemail = $bdd -> prepare("SELECT idAdmin FROM super_admin WHERE emailAdmin= ? ");
						$testemail -> execute(array($emailAdmin));

							if ($testemail -> rowCount() < 1) {

								$insert = $bdd->prepare("INSERT INTO super_admin (nomAdmin, postnomAdmin, emailAdmin, passwordAdmin) VALUES(:nomAdmin, :postnomAdmin, :emailAdmin, :passwordAdmin)");

							$insert->execute(array(
							'nomAdmin'=>$nomAdmin,
							'postnomAdmin'=>$postnomAdmin, 
							'emailAdmin'=>$emailAdmin,  
							'passwordAdmin'=>$passwordAdmin));

							header('location:index.php');

							}else $return = 'Super_Admin existe déja! <a href="index.php" style="color: black;"> Connectez-vous </a></p>';
						}else $return = "Les mots de passe ne sont pas identiques!";
					}else $return = "Emai incorrect!";

				}else $return = "Champs manquant!";
			}

}
	catch(Exception $e){
	die("erreur".$e->getMessage());
	}
?>

<!DOCTYPE HTML>

<html>
	<head>
	
	<title>Inscription &mdash; DIRECTION</title>
	<meta http-equiv="refresh" content="900;url=index.php" />
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
			<h2 style="color: green;">REPUBLIQUE DU BURUNDI</h2>
			<div class="row">
				<div class="col-sm-4 col-xs-12">
					<div id="gtco-logo"><a href="index.php"><h4 style="color: red;">BUREAU DE CENTRALISATION GEOMATIQUE &copy;</h4></a></div>
				</div>
				<div class="col-xs-8 text-right menu-1">
					<ul>
						<li><a href="index.php">Connectez-vous!</a></li>
			
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
							<blockquote><img src="bu.png" alt="Logo" id="logo" /></blockquote>
							<h1>DIRECTION</h1>	
						</div>
						<div class="col-md-4 col-md-push-1 animate-box" data-animate-effect="fadeInRight">
							<div class="form-wrap">
								<div class="tab">
									
									<div class="tab-content">
										<div class="tab-content-inner active" data-content="signup">
											<h3>Inscriprtion</h3>
											<form action="#" method="POST">
												<div class="row form-group">
													<div class="col-md-12">
														<label for="fullname">Nom:</label>
														<input type="text" name="nomAdmin" id="fullname" class="form-control">
													</div>
													<div class="col-md-12">
														<label for="fullname">Post-nom:</label>
														<input type="text" name="postnomAdmin" id="fullname" class="form-control">
													</div>
												</div>
												<div class="row form-group">
													<div class="col-md-12">
														<label for="fullname">Email:</label>
														<input type="email" name="emailAdmin" id="fullname" class="form-control">
													</div>
												</div>
												<div class="row form-group">
													<div class="col-md-12">
														<label for="fullname">Mot de passe:</label>
														<input type="password" name="passwordAdmin" id="fullname" class="form-control">
													</div>
													<div class="col-md-12">
														<label for="fullname">Confirmation:</label>
														<input type="password" name="confirmationAdmin" id="fullname" class="form-control">
													</div>
												</div>
												
												
												<div class="row form-group">
													<div class="col-md-12">
														<input type="submit" name="Enregistrer" class="btn btn-primary btn-block" value="Enregistrer">
													</div>
												</div>
											</form>	
										</div>
										<p style="color: red;"><em><?php if(isset ($_POST['Enregistrer']) AND isset($return)) echo $return; ?></em></p>
										
									</div>
								</div>
							</div>
						</div>
					</div>
							
					
				</div>
			</div>
		</div>
	</header>
	
	<div  style=" background-color: #0f983d; ">
		<div class="gtco-container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
					<h2 style="color: white;">REPUBLIQUE DU BURUNDI</h2>
					<p style="color: red;">Ubumwe Ibikorwa amajambere</p>
				</div>
			</div>
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2">
					
				</div>
			</div>
		</div>

	</div>

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

