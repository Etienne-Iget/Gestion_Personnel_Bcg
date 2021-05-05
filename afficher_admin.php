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

if (isset($_SESSION['id'],$_SESSION['photo'])) {
	

$bdd = new PDO('mysql:host=localhost;dbname=administration', 'root','Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

	if (isset($_GET['id']) AND $_GET['id']>0) {
		
	
	$getid=intval($_GET['id']);

	$requser = $bdd->prepare('SELECT * FROM administrateur WHERE  id =?');

	$requser->execute(array($getid));

	$userinfo = $requser->fetch();
	$_SESSION['photo']=$userinfo['photo'];

	}

	
?>

<!DOCTYPE HTML>

<html>
	<head>
	
	<title>Profil &mdash; Administrateur </title>
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
						<?php echo '<li><a href="personnel.php#tabord">Tableau de bord</a></li>'; ?>
						<?php echo '<li><a href="Admin/editer.php?id='.$_SESSION['id'].'" class="btn btn-warning">Modifier</a></li>'; ?>
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
						<div class="col-md-4 animate-box" data-animate-effect="fadeInUp">
							<blockquote><img src="bu.png" alt="Logo" id="logo" /></blockquote>
						</div>

						<div class="col-md-8 animate-box" data-animate-effect="fadeInRight">
							<div class="row justify-content-between">
								<div class="col-lg-7">
								 <a href="#"><?= $userinfo['nom']?> <?=$userinfo['postnom']?></a><br>
								 	<?php  
									}

								 	?>
								<div class="form-wrap">
									<div class="tab">
										
							Nom :	<?php echo $userinfo['nom']; ?><br>
							Post-Nom :	<?php echo $userinfo['postnom']; ?><br>
							Prénom :	<?php echo $userinfo['prenom']; ?><br>
							Genre :	<?php echo $userinfo['genre']; ?><br>
							Adresse :	<?php echo $userinfo['adress']; ?><br>
							Fonction :	<?php echo $userinfo['fonction']; ?><br>
							Email :	<?php echo $userinfo['email']; ?><br>

										
									</div>
								</div>
									
								</div>
								<div  class="col-lg-5 ">
									<div class=" row justify-content-end">
											<?php 
											if (file_exists("Admin/".$_SESSION['photo']) && isset($_SESSION['photo'])) {
												?>

													<img src="<?='Admin/'.$_SESSION['photo']?> " height="250px" class="d-block ml-5" style="margin-left:80px;"> 
												<?php
											}else {
												?>

													<img src="Admin/Photos/Profil/no-avatar.jpg" height="250px" class=sz-image/> 
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
