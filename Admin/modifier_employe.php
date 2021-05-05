
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

$bdd = new PDO('mysql:host=localhost;dbname=bcg', 'root', 'Iget1209');

	if (isset($_GET['id'])) {

		$requser = $bdd->prepare('SELECT * FROM employe WHERE  id =?');
		$requser->execute(array($_GET['id']));

		$user = $requser->fetch();

		if (isset($_POST['nomNew']) AND !empty($_POST['nomNew']) And $_POST['nomNew']!=$user['nomEmploye']) {

			$nomNew=htmlspecialchars($_POST['nomNew']);
			$insertnom=$bdd->prepare("UPDATE employe SET nomEmploye = ? WHERE id = ?");
			$insertnom->execute(array($nomNew,$_GET['id']));

			header('location:afficherEmploye.php?id='.$_GET['id']);
		}

		if (isset($_POST['telNew']) AND !empty($_POST['telNew']) And $_POST['telNew']!=$user['tel']) {

			$telNew=htmlspecialchars($_POST['telNew']);
			$insertpostnom=$bdd->prepare("UPDATE employe SET tel = ? WHERE id = ?");
			$insertpostnom->execute(array($telNew,$_GET['id']));

			header('location:afficherEmploye.php?id='.$_GET['id']);;
		}

		if (isset($_POST['emailNew']) AND !empty($_POST['emailNew']) And $_POST['emailNew']!=$user['email']) {

			$emailNew=htmlspecialchars($_POST['emailNew']);
			$insertprenom=$bdd->prepare("UPDATE employe SET email = ? WHERE id = ?");
			$insertprenom->execute(array($emailNew,$_GET['id']));

			header('location:afficherEmploye.php?id='.$_GET['id']);
		}

		if (isset($_POST['adressNew']) AND !empty($_POST['adressNew']) And $_POST['adressNew']!=$user['adresse']) {

			$adressNew=htmlspecialchars($_POST['adressNew']);
			$insertfonction=$bdd->prepare("UPDATE employe SET adresse = ? WHERE id = ?");
			$insertfonction->execute(array($adressNew,$_GET['id']));

			header('location:afficherEmploye.php?id='.$_GET['id']);
		}

		if (isset($_POST['departementNew']) AND !empty($_POST['departementNew']) And $_POST['departementNew']!=$user['departement']) {

			$departementNew=htmlspecialchars($_POST['departementNew']);
			$insertadress=$bdd->prepare("UPDATE employe SET departement = ? WHERE id = ?");
			$insertadress->execute(array($departementNew,$_GET['id']));

			header('location:afficherEmploye.php?id='.$_GET['id']);
		}

		if (isset($_POST['fonctionNew']) AND !empty($_POST['fonctionNew']) And $_POST['fonctionNew']!=$user['fonction']) {


			$fonctionNew=htmlspecialchars($_POST['fonctionNew']);
			$insertemail=$bdd->prepare("UPDATE employe SET fonction = ? WHERE id = ?");
			$insertemail->execute(array($fonctionNew,$_GET['id']));

			header('location:afficherEmploye.php?id='.$_GET['id']);

		}
		if (isset($_POST['newEtat']) AND !empty($_POST['newEtat']) And $_POST['newEtat']!=$user['etatService']) {


			$newEtat=htmlspecialchars($_POST['newEtat']);

			// var_export($newEtat);
			// exit();
			
			$insertservice=$bdd->prepare("UPDATE employe SET etatService = ? WHERE id = ?");
			$insertservice->execute(array($newEtat,$_GET['id']));

			// $inservice=$bdd->prepare("UPDATE events SET etatService = ? WHERE id = ?");
			// $inservice->execute(array($newEtat,$_GET['id']));

			header('location:afficherEmploye.php?id='.$_GET['id']);

		}

		
	

	} else{
		header('location:connexion.php');
	}
?>

<!DOCTYPE HTML>

<html>
	<head>
	
	<title>Profil &mdash; Employé </title>
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
						
						<?php echo '<li><a href="affichage_employe.php?id='.$_GET['id'].'">Afficher</a></li>'; ?>
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
							<blockquote><img src="bu.png" alt="Logo" id="logo" /></blockquote>
							<h2>Modification</h2>	
						</div>
						<div class="col-md-4 col-md-push-1 animate-box" data-animate-effect="fadeInRight">
							<div class="form-wrap">
								<div class="tab">
									
									<div class="tab-content">
										<div class="tab-content-inner active" data-content="signup">
								<form style="color: black;" class="form-inline" action="" method="POST" enctype="multipart/form-data" >
									<legend>Nom,Adresse et Contact</legend>
									<div class="row form-group">
										<div class="col-md-12">
											<label class="sr-only" for="name">Nom/Post-nom/Prénom :</label>
											<input type="text"  name="nomNew" id="name" class="form-control" placeholder="Nom" value="<?php echo $user['nomEmploye']; ?>">
										</div>
									</div>


						<div class="row form-group">

							<div class="col-md-12">
								<label class="sr-only" for="name">Adresse :</label>
								<input type="text" name="adressNew" id="name" class="form-control" placeholder="Adresse" value="<?php echo $user['adresse']; ?>">
							</div>
                        
						</div>
							<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="name">Telephone :</label>
								<input type="text"  name="telNew" id="name" class="form-control" placeholder="Téléphone" value="<?php echo $user['tel']; ?>">
							</div>
							</div>

							<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="name">Email :</label>
								<input type="text"  name="emailNew" id="name" class="form-control" placeholder="Prénom" value="<?php echo $user['email']; ?>">
							</div>
							</div>

							<legend>Département et fonction</legend>
							
						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="name">Département :</label>
								<input type="text"  name="departementNew" id="name" class="form-control" placeholder="Département" value="<?php echo $user['departement']; ?>">
							</div>
                        
						</div>
							<div class="row form-group">

							<div class="col-md-12">
								<label class="sr-only" for="name">Fonction :</label>
								<input type="text" name="fonctionNew" id="name" class="form-control" placeholder="Fonction" value="<?php echo $user['fonction']; ?>">
							</div>
                        
						</div>
						
						
						<div class="row form-group">
							<div class="col-md-12">
								<legend >Etat de Service : <i style="color: red;"><?php echo $user['etatService'];?></i></legend>

								<select class="form-control" name="newEtat" >

										<option disabled selected >Etat de service</option>	 
                                    	<option value="En Service" style="color: black;"> En service </option>
                                    	<option value="En Conge" style="color: black;"> En congé </option>
                                    	<option value="En Vacances" style="color: black;">En vacances</option>
                                    	<option value="Suspendu" style="color: black;"> Suspendu </option>
                                    	<option value="Hors service" style="color: black;"> Hors service </option>
                                 </select>
								
							</div>
						</div>
						
						<div class="form-group">
							<input type="submit" id="modifier" name="modifier" value="Modifier" class="btn btn-primary">
						</div>
					</form>

					</div>
					<p style="color: red;"><em><?php if(isset ($_POST['Connexion']) AND isset($return)) echo $return; ?></em></p>
										
				</div>
			</div>
		</div>
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
		
	$("#modifier").click(function(){

		Swal.fire(
			  'Modification!',
			  'Réussi!',
			  'success'
			)

	})

	</script>