<?php
session_start();
?>
<!DOCTYPE HTML>

<html>
	<head>
	
	<title>Accueil &mdash;Gestion du Personnel </title>
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

	
	<!-- <div class="page-inner"> -->
	<nav class="gtco-nav" role="navigation">
		<div class="gtco-container">
			<h2 style="color: green;">REPUBLIQUE DU BURUNDI</h2>
			<div class="row">
				<div class="col-sm-4 col-xs-12">
					<div id="gtco-logo"><a href="index.php"><h4 align="center" style="color: red;">BUREAU DE CENTRALISATION GEOMATIQUE &copy;</h4></a></div>
				</div>
				<div class="col-xs-8 text-right menu-1">
					<ul>
						<li><a href="index.php">Accueil</a></li>
						<li class="has-dropdown">
							<a href="#">Connexion</a>
							<ul class="dropdown">

								<li><a style="color: black;" class="btn btn-danger" href="admin/index.php#connexion">DIRECTION</a></li>
								
								<li><a style="color: black;" class="btn btn-warning" href="connexion.php#connexion">Admin</a></li>
								
								
								<li><a style="color: black;" class="btn btn-primary" href="Employe/index.php#connexion">Employer</a></li>
							</ul>
						</li>
						<li class="has-dropdown">
							<a href="#">A propos</a>
							<ul class="dropdown">
								<li><a href="http://sp-bcg.gov.bi/index.php/a-propos-du-bcg/historique">Historique</a></li>
								<li><a href="http://sp-bcg.gov.bi/index.php/a-propos-du-bcg/mission">Mission</a></li>
								<li><a href="http://sp-bcg.gov.bi/index.php/a-propos-du-bcg/organisation">Organisation</a></li>
							</ul>
						</li>
					</ul>	
			  </div>
			</div>
			
	  </div>
	</nav>
	
		<header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" style="background-image: url(images/img_bg_2.jpg)">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-center">
				  <div class="row row-mt-15em">

						<div class="col-md-12 mt-text animate-box" data-animate-effect="fadeInUp">
						  <img src="bcglogo.png" alt="Logo" id="logo" />
							<h1>GESTION DU PERSONNEL</h1>
					  </div>
						
					</div>
					
				</div>
			</div>
		</div>
	</header>

	<div  style=" background-color: #0f983d ">
		<div class="gtco-container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
							<img src="bu.png" alt="Logo" id="logo" />
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


	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
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