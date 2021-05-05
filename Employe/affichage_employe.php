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
	

if (!isset($_SESSION['id'])) {

	
		header('location:connexion.php');  
		
	}elseif ( !isset($_SESSION['idAdmin'])) {

		header('location:../Admin/index.php');
		
	}
?>


<?php

$bdd = new PDO('mysql:host=localhost;dbname=bcg', 'root', 'Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

	if (isset($_GET['id']) AND $_GET['id']>0) {
		
	
	$getid=intval($_GET['id']);

	$requser = $bdd->prepare('SELECT * FROM employe WHERE  id =?');
	$requser->execute(array($getid));

	$userinfo = $requser->fetch();
	$_SESSION['photoEmploye']=$userinfo['photoEmploye'];


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

						
						
												<?php 
													 if ($_SESSION['idAdmin']){
														?>
														<?php echo '<li><a href="../Admin/afficherEmploye.php" class="btn btn-primary">Employés</a></li>'; ?>
														<?php echo '<li><a href="../Admin/modifier_employe.php?id='.$_GET['id'].'" class="btn btn-warning">Modifier</a></li>'; ?>
														<li><a href="Admin/logout.php" class="btn btn-danger">Deconnexion</a></li>
														<?php
													
													
													}
												 ?>
						
			
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
					
					<br><br><br>

					<div class="row row-mt-15em">
						<div class="col-md-4 animate-box" data-animate-effect="fadeInUp">
							<blockquote><img src="bu.png" alt="Logo" id="logo" /></blockquote>
						</div>

						<div class="col-md-8 animate-box" data-animate-effect="fadeInRight">
							<div class="row justify-content-between">
								<div class="col-lg-7">
								<a href="#">Matricule  :<?php echo $userinfo['matricule']; ?> </a><br>

								 	
								<div class="form-wrap">
									<div class="tab">
										
						Nom/Post-nom/Prénom :	<?php echo $userinfo['nomEmploye']; ?><br>
						Genre :	<?php echo $userinfo['genre']; ?><br>
						Adresse :	<?php echo $userinfo['adresse']; ?><br>
						Téléphone :	<?php echo $userinfo['tel']; ?><br>
						Email :	<?php echo $userinfo['email']; ?><br>
						Département :	<?php echo $userinfo['departement']; ?><br>
						Fonction :	<?php echo $userinfo['fonction']; ?><br>
						Etat de Service :	<?php echo $userinfo['etatService']; ?><br>


										
									</div>
								</div>
									
								</div>
								<div  class="col-lg-5 ">
									<div class=" row justify-content-end">
											<?php 
											if (file_exists($_SESSION['photoEmploye']) && isset($_SESSION['photoEmploye'])) {
												?>

													<img src="<?=$_SESSION['photoEmploye']?> " height="250px" class="d-block ml-5" style="margin-left:80px;"> 
												<?php
											}else {
												?>

													<img src="Employe/Photo/no-avatar.jpg" height="250px" class=sz-image/> 
										 	<?php  
											}

										 	?>
											
										
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
