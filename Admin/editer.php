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

$_SESSION['id']=$_GET['id'];

$bdd = new PDO('mysql:host=localhost;dbname=administration', 'root', 'Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

	if (isset($_SESSION['id'])) {

		$requser = $bdd->prepare('SELECT * FROM administrateur WHERE  id =?');
		$requser->execute(array($_SESSION['id']));

		$user = $requser->fetch();

		if (isset($_POST['nomNew']) AND !empty($_POST['nomNew']) And $_POST['nomNew']!=$user['nom']) {

			$nomNew=htmlspecialchars($_POST['nomNew']);
			$insertnom=$bdd->prepare("UPDATE administrateur SET nom = ? WHERE id = ?");
			$insertnom->execute(array($nomNew,$_SESSION['id']));

			header('location:../afficher.php?id='.$_SESSION['id']);
		}

		if (isset($_POST['postnomNew']) AND !empty($_POST['postnomNew']) And $_POST['postnomNew']!=$user['postnom']) {

			$postnomNew=htmlspecialchars($_POST['postnomNew']);
			$insertpostnom=$bdd->prepare("UPDATE administrateur SET postnom = ? WHERE id = ?");
			$insertpostnom->execute(array($postnomNew,$_SESSION['id']));

			header('location:../afficher.php?id='.$_SESSION['id']);
		}

		if (isset($_POST['prenomNew']) AND !empty($_POST['prenomNew']) And $_POST['prenomNew']!=$user['prenom']) {

			$prenomNew=htmlspecialchars($_POST['prenomNew']);
			$insertprenom=$bdd->prepare("UPDATE administrateur SET prenom = ? WHERE id = ?");
			$insertprenom->execute(array($prenomNew,$_SESSION['id']));

			header('location:../afficher.php?id='.$_SESSION['id']);
		}

		if (isset($_POST['fonctionNew']) AND !empty($_POST['fonctionNew']) And $_POST['fonctionNew']!=$user['fonction']) {

			$fonctionNew=htmlspecialchars($_POST['fonctionNew']);
			$insertfonction=$bdd->prepare("UPDATE administrateur SET fonction = ? WHERE id = ?");
			$insertfonction->execute(array($fonctionNew,$_SESSION['id']));

			header('location:../afficher.php?id='.$_SESSION['id']);
		}

		if (isset($_POST['adressNew']) AND !empty($_POST['adressNew']) And $_POST['adressNew']!=$user['adress']) {

			$adressNew=htmlspecialchars($_POST['adressNew']);
			$insertadress=$bdd->prepare("UPDATE administrateur SET adress = ? WHERE id = ?");
			$insertadress->execute(array($adressNew,$_SESSION['id']));

			header('location:../afficher.php?id='.$_SESSION['id']);
		}

		if (isset($_POST['emailNew']) AND !empty($_POST['emailNew']) And $_POST['emailNew']!=$user['email']) {

			$testemail = $bdd -> prepare("SELECT id FROM administrateur WHERE email= ? ");
			$testemail -> execute(array($email));

					if ($testemail -> rowCount() < 1) {

			$emailNew=htmlspecialchars($_POST['emailNew']);
			$insertemail=$bdd->prepare("UPDATE administrateur SET email = ? WHERE id = ?");
			$insertemail->execute(array($emailNew,$_SESSION['id']));

			header('location:../afficher.php?id='.$_SESSION['id']);

			} else $return = "Email existe déjà!";
		}

		if (isset($_POST['passwordNew']) AND !empty($_POST['passwordNew']) AND isset($_POST['confirmationNew']) AND !empty($_POST['confirmationNew']) And $_POST['passwordNew']!=$user['password']) {


			$passwordNew=sha1($_POST['passwordNew']);
			$confirmationNew=sha1($_POST['confirmationNew']);

			if ($passwordNew==$confirmationNew) {
				
			$insertpassword=$bdd->prepare("UPDATE administrateur SET password = ? WHERE id = ?");
			$insertpassword->execute(array($passwordNew,$_SESSION['id']));
			
			header('location:../logout.php');
			}
			else $return = "Mots de passe non identique";
		}

		if (isset($_FILES['photo']) And !empty($_FILES['photo'])) {

			$tailleMax=2097152;

			$extensionsValides =array('jpg','jpeg','gif','png');
						
						// var_dump($tailleMax);
						// var_dump($extensionsValides);
						// var_dump($_FILES['photo']['size']);
						// exit();
						
			if ($_FILES['photo']['size']<=$tailleMax) {

				$extensionUpload = strtolower(substr(strrchr($_FILES['photo']['name'], '.'), 1));

					if (in_array($extensionUpload, $extensionsValides)) {

						$chemin = "Photos/Profil/".$_SESSION['id'].".".$extensionUpload;
						$resultat = move_uploaded_file($_FILES['photo']['tmp_name'], $chemin);

						if ($resultat) {
							$insertphoto=$bdd->prepare('UPDATE administrateur SET photo = :photo WHERE id=:id');
							$insertphoto->execute(array( 
								'photo'=>$chemin,
								'id' => $_SESSION['id']
							));

							header('location:../personnel.php');

						}else $return = "Erreur de chargement de la photo";
						
					}else $return = "Format non pris en charge";
				
			} else $return = "Photo ne doit pas être > 2Mb";
		}
	// 		else{
	// 	header('location:../personnel.php');
	// }
}
?>
<DOCTYPE HTML>
<html>
	<head>
	
	<title>Administrateur &mdash; Modification </title>
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
	
	<div>

	
	<nav class="gtco-nav" role="navigation">
		<div class="gtco-container">
			<h2 style="color: green;">REPUBLIQUE DU BURUNDI</h2>
			<div class="row">
				<div class="col-sm-4 col-xs-12">
					<div id="gtco-logo"><a href="index.php"><h4 style="color: red;">BUREAU DE CENTRALISATION GEOMATIQUE &copy;</h4></a></div>
				</div>
				<div class="col-xs-8 text-right menu-1">
					<ul>
						<?php echo '<li><a href="../afficher.php?id='.$_SESSION['id'].'">Affichage du profil</a></li>'; ?>

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
							<h2>MODIFICATION DU PROFIL</h2>
						</div>
						
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
					<h2>MODIFICATION</h2>
					<p>Administrateur</p>
					<p style="color: red;"><?php if(isset ($_POST['modifier']) AND isset($return)) echo $return; ?></p>
				</div>
			</div>
			<div class="row animate-box">
				<div class="col-md-9 col-md-offset-2">
					<form style="color: black;" class="form-inline" action="" method="POST" enctype="multipart/form-data" >

						

						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="name">Nom :</label>
								<input type="text"  name="nomNew" id="name" class="form-control" placeholder="Nom" value="<?php echo $user['nom']; ?>">
							</div>
						</div>

							<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="name">Post-nom :</label>
								<input type="text"  name="postnomNew" id="name" class="form-control" placeholder="Post-nom" value="<?php echo $user['postnom']; ?>">
							</div>
							</div>
							<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="name">Prénom :</label>
								<input type="text"  name="prenomNew" id="name" class="form-control" placeholder="Prénom" value="<?php echo $user['prenom']; ?>">
							</div>
							</div>
							
							<div class="row form-group">

							<div class="col-md-12">
								<label class="sr-only" for="name">Fonction :</label>
								<input type="text" disabled name="fonctionNew" id="name" class="form-control" placeholder="Fonction" value="<?php echo $user['fonction']; ?>">
							</div>
                        
						</div>

						<div class="row form-group">

							<div class="col-md-12">
								<label class="sr-only" for="name">Adresse :</label>
								<input type="text" name="adressNew" id="name" class="form-control" placeholder="Adresse" value="<?php echo $user['adress']; ?>">
							</div>
                        
						</div>




						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="name">Email :</label>
								<input type="email"  name="emailNew" id="name" class="form-control" placeholder="Email" value="<?php echo $user['email']; ?>">
							</div>
                        
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="name">Mot de passe :</label>
								<input type="password"  name="passwordNew" id="name" class="form-control" placeholder="Mot de passe">
							</div>
                        
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="name">Confirmation :</label>
								<input type="password"  name="confirmationNew" id="name" class="form-control" placeholder="Confirmation">
							</div>
                        
						</div>

						<fieldset>
						<legend> Photo de profil</legend>
						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="name">Photo :</label>
								<input type="file"  name="photo" id="name" class="form-control" placeholder="Photo de profile">
							</div>
						</div>
					</fieldset>
						
						<div class="form-group">
							<input type="submit" name="modifier" value="Modifier" class="btn btn-primary">
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

