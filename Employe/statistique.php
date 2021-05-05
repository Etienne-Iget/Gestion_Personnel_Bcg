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


	if (!isset($_SESSION['id'], $_SESSION['nomEmploye'], $_SESSION['etatService'], $_SESSION['password'], $_SESSION['etatService'], $_SESSION['photoEmploye'], $_SESSION['email']))  {
	
		header('location:../index.php');
	
}	
?>

<?php  
$bdd = new PDO('mysql:host=localhost;dbname=bcg', 'root', 'Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));


	if (isset($_SESSION['id']) AND $_SESSION['id']>0) {
		
	$getid=intval($_SESSION['id']);

	

	$requser = $bdd->prepare('SELECT * FROM employe WHERE  id =?');
	$requser->execute(array($getid));

	$userinfo = $requser->fetch();
	$_SESSION['photoEmploye']=$userinfo['photoEmploye'];
	}
		

?>

<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	
	<title>Rapport &mdash; Employé </title>
	<meta http-equiv="refresh" content="900;url=logout.php" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/animate.css">

	<link rel="stylesheet" href="css/icomoon.css">

	<link rel="stylesheet" href="css/themify-icons.css">

	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css">

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
			
		
	<nav style=" background-color: #708090; "style=" background-color: #708090; " class="gtco-nav" role="navigation">

		<div style=" background-color: #708090; " class="gtco-container">
			<h2 style="color: black;">REPUBLIQUE DU BURUNDI</h2>
			<div style=" background-color: #708090; " class="row">
				
				<div style=" background-color: #708090; " class="col-xs-8 text-right menu-1">
					<ul>

						<li><a href="#">Employe</a></li>
						
						

							 	<?php 
											if (file_exists($_SESSION['photoEmploye']) && isset($_SESSION['photoEmploye'])) {
												?>

													<img src="<?=$_SESSION['photoEmploye']?> "width="100" class="d-block ml-5" /> 
												<?php
											}else {
												?>

													<img src="Employe/Photo/no-avatar.jpg" width="100" class=sz-image/> 
										 	<?php  
											}

										 	?>
							 <li><a href="#"> <?= $userinfo['nomEmploye']?> </a><br></li>
					
						

					
					</ul>

				</div>
			</div>
			
		</div>
	</nav>

	<br><br><br>

	
<div class="tab-content-inner active" data-content="signup">
<div class="modal fade" id="communique">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
					<h2  class="modal-title text-warning text-center"> Communiqué</h2>
			</div>
			<div class="modal-body" >
				
				<div id="info"></div>
			</div>
		</div>
	</div>
</div>
</div>
	
	<nav class="gtco-nav" role="navigation">
		
		<br><br><br>
		<div class="gtco-container">
			
			<div class="row">
				<div class="col-sm-4 col-xs-12"><br><br><br>
					<div id="gtco-logo"><a href="index.php"><h4 style="color: yellow;">BUREAU DE CENTRALISATION GEOMATIQUE &copy;</h4></a></div>
				</div>
				<br>
				<div class="col-xs-8 text-right menu-1">
					<br><br><br><ul>

						<li><a href="information.php">Accueil</a></li>
						
						<li class="has-dropdown">
							<a href="#">Comptes</a>
							<ul class="dropdown">
								<?php if (isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
									?>
									
								<li><a href="logout.php" class="btn btn-danger">Deconnexion</a></li>
									<?php
								} ?>
							</ul>
						</li>

					</ul>	
				</div>
			</div>
			
		</div>
	</nav>


	<!-- Modal -->
<div class="modal fade" id="presence" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title text-center" id="exampleModalLabel">Préstations</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div id="message"></div>
      </div>
      <div class="modal-body" id="presence_view">
      	<i style="color: red;">Chergement....</i>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
      </div>
    </div>
  </div>
</div>
				
	
	<header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" style="background-image: url(images/img_bg_2.jpg)">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-left">
					

					
					<div class="row row-mt-15em">
						<div class="col-md-7 mt-text animate-box" data-animate-effect="fadeInUp">
							<blockquote><img src="bu.png" alt="Logo" id="logo" /></blockquote>
						<h2>GESTION DU PRESENCE</h2>	
						</div>
									
						<div class="col-md-4 col-md-push-1 animate-box" data-animate-effect="fadeInRight">
							<div class="form-wrap">
								<div class="tab">


									<div class="tab-content">
										<div class="tab-content-inner active" data-content="signup">
											<h3>Rapport</h3>

												<ul class="dropdown">
													<?php echo '<li><a href="#" data-id="'.$_SESSION['id'].'" data-toggle="modal" data-target="#presence">Préstation</a></li>'; ?>
													
													
											
												</ul>
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
						<h3>Table de bord</h3>
						<ul class="dropdown">
							<li><a href=information.php>Accueil</a></li>													
							<li><a href=statistique.php>Statistique</a></li>														
							
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
	<!-- </div> -->

	</div>

		<div class="gototop js-top">
			<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
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
<script type="text/javascript">
	$("#presence").on("shown.bs.modal",function(event){
			var button = $(event.relatedTarget)
			var modal = $(this)

			var id = button.data("id")
			$.ajax({
				url:"presence.php",
				method:"POST",
				data:{id:id},
				dataType:"html",
				success: function(presence){
					$("#presence_view").html(presence)
					// console.log(presence)
						}
			})



		})
</script>
