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

<?php

try
		{

	$bdd = new PDO('mysql:host=localhost;dbname=administration','root','Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

			if (isset($_POST['Enregistrer'])) {


				$nom = htmlspecialchars($_POST['nom']);
				$postnom = htmlspecialchars($_POST['postnom']);
				$prenom = htmlspecialchars($_POST['prenom']);			
				$genre = htmlspecialchars($_POST['genre']);
				$fonction = htmlspecialchars($_POST['fonction']);
				$adress = htmlspecialchars($_POST['adress']);
				$email = htmlspecialchars($_POST['email']);

				$password =sha1('admin1234');
				$confirmation =$password;
				
				if (!empty($nom) AND !empty($postnom)AND !empty($prenom)AND !empty($genre) AND !empty($fonction) AND !empty($adress)AND !empty($email)AND !empty($password)){

					if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

						if ($password==$confirmation) {

						$testemail = $bdd -> prepare("SELECT id FROM administrateur WHERE email= ? ");
						$testemail -> execute(array($email));

							if ($testemail -> rowCount() < 1) {

							$insert = $bdd->prepare("INSERT INTO administrateur (nom, postnom, prenom, genre, fonction, adress, email, password,photo) VALUES(:nom, :postnom, :prenom, :genre, :fonction, :adress, :email, :password,:photo)");
							$insert->execute(array(
							'nom'=>$nom,
							'postnom'=>$postnom, 
							'prenom'=>$prenom, 
							'genre'=>$genre, 
							'fonction'=>$fonction, 
							'adress'=>$adress, 
							'email'=>$email, 
							'password'=>$password,
							'photo'=>"no-avatar.jpg"));

							header("location:accueil.php");

								$return = "Administrateur créé avec succès";

							}else $return = "le compte existe déjà";
							
						}else $return = "Mots de passe ne sont pas identiques";

					}else $return = "Email incorrect";

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
	
	<title>Direction &mdash; Inscription </title>
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
			<h2 style="color: green;">REPUBLIQUE DU BURUNDI</h2>
			<div class="row">
				<div class="col-sm-4 col-xs-12">
					<div id="gtco-logo"><a href="index.php"><h4 style="color: red;">BUREAU DE CENTRALISATION GEOMATIQUE &copy;</h4></a></div>
				</div>
				<div class="col-xs-8 text-right menu-1">
					<ul>
						<li><a href="accueil.php">Accueil</a></li>
						<li class="has-dropdown">
							<a href="#">Administration</a>
							<ul class="dropdown">
								<li><a href="logout.php" class="btn btn-danger">Deconnexion</a></li>
							</ul>
						</li>
						<li class="has-dropdown">
							<a href="#">A propos</a>
							<ul class="dropdown">
								<li><a href="historique.php">Historique</a></li>
								<li><a href="mission.php">Mission</a></li>
								<li><a href="organisation.php">Organisation</a></li>
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
							<img src="bu.png" alt="Logo" id="logo" />
							<h1>Administrateurs</h1>
							<h2>GESTION DU PERSONNEL</h2>
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
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
					<h2>INSCRIPTION</h2>
					<p>Administrateur</p>
					<p style="color: red;"><?php if(isset ($_POST['Enregistrer']) AND isset($return)) echo $return; ?></p>
				</div>
			</div>
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2">
					<form style="color: black;" class="form-inline" action="" method="POST" enctype="multipart/form-data" >

						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="name">Nom :</label>
								<input type="text"  name="nom" id="name" class="form-control" placeholder="Nom" value="<?php if(isset($nom)) { echo $nom;} ?>">
							</div>
						</div>

							<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="name">Post-nom :</label>
								<input type="text"  name="postnom" id="name" class="form-control" placeholder="Post-nom" value="<?php if(isset($postnom)) { echo $postnom;} ?>">
							</div>
							</div>
							<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="name">Prénom :</label>
								<input type="text"  name="prenom" id="name" class="form-control" placeholder="Prénom" value="<?php if(isset($prenom)) { echo $prenom;} ?>">
							</div>
							</div>
							
						<div class="row form-group">
								<label>Genre</label>
							<div class="col-md-12">
								<label class="sr-only" for="name">Genre</label>
								<select class="form-control" name="genre" value="<?php if(isset($genre)) { echo $genre;} ?>"  >
										<option disabled selected>Genre</option>
                                    	<option value="Homme" style="color: black;"> Homme </option>
                                    	<option value="Femme" style="color: black;"> Femme </option>
                                 </select>
							</div>
							
						</div>

						<div class="row form-group">

							<div class="col-md-12">
								<label class="sr-only" for="name">Fonction :</label>
								<input type="text" name="fonction" id="name" class="form-control" placeholder="Fonction" value="<?php if(isset($fonction)) { echo $fonction;} ?>">
							</div>
                        
						</div>

						<div class="row form-group">

							<div class="col-md-12">
								<label class="sr-only" for="name">Adresse :</label>
								<input type="text" name="adress" id="name" class="form-control" placeholder="Adresse" value="<?php if(isset($adress)) { echo $adress;} ?>">
							</div>
                        
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="name">Email :</label>
								<input type="email"  name="email" id="name" class="form-control" placeholder="Email" value="<?php if(isset($email)) { echo $email;} ?>">
							</div>
                        
						</div>

						<div class="form-group">
							<input type="submit" id="Enregistrer" name="Enregistrer" value="Enregistrer" class="btn btn-primary">
						</div>
					</form>
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

	</body>
</html>
<script type="text/javascript">
		
	$("#Enregistrer").click(function(){

		Swal.fire(
			  'Enregistrement!',
			  'Réussi!',
			  'success'
			)

	})

	</script>
