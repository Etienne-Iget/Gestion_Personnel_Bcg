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

	if (!isset($_SESSION['id'], $_SESSION['nom'])) {

	header('location:connexion.php');
		
	}
?>

<?php  
$bdd = new PDO('mysql:host=localhost;dbname=administration', 'root', 'Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));


	if (isset($_SESSION['id']) AND $_SESSION['id']>0) {
		
	$getid=intval($_SESSION['id']);

	

	$requser = $bdd->prepare('SELECT * FROM administrateur WHERE  id =?');
	$requser->execute(array($getid));

	$userinfo = $requser->fetch();
	$_SESSION['photo']=$userinfo['photo'];
	}
		

?>

<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	
	<title>Personnel &mdash; Gestion du Personnel </title>
	<meta http-equiv="refresh" content="900;url=logout.php" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/animate.css">

	<link rel="stylesheet" href="css/icomoon.css">

	<link rel="stylesheet" href="css/themify-icons.css">

	<link rel="stylesheet" href="fonts/bootstrap/dist/css/bootstrap.css">

	<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css">

	<link rel="stylesheet" href="css/magnific-popup.css">

	<link rel="stylesheet" href="css/bootstrap-datepicker.min.css">

	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">

	<link rel="stylesheet" href="css/style.css">

	<script src="js/modernizr-2.6.2.min.js"></script>

	</head>
	<body>
	
	<!-- <div class="gtco-loader"></div> -->

	<div>
	<div id="page">
			
		<div style=" background-color: #0f983d; " class="gtco-container">
			<h1 style="color: black; text-align: center;">GESTION DU PERSONNEL</h1>
			<div style=" background-color: #0f983d; " class="row">
				
				
			</div>
			
		</div>
		<!-- Button trigger modal -->
<br>
		<div style=" background-color: #0f983d; " class="container-fluid">
	<div class="row">
<div  class="container">
	<div style=" background-color: #0f983d; " class="row align-items-center">
		<div class="col"><img src="bu.png" alt="Logo" width="100%" /></div>
			<nav class="navbar navbar-expand-lg  navbar-light bg-light col-md-7 col">
				  <button class="navbar-toggler  mx-auto" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
				    <span class="navbar-toggler-icon"></span>
				  </button>
				  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
				    <form class="form-inline " action="#" method="GET">
				      <!-- <input name="recherche" id="name" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
				      <button class="btn btn-sm btn-outline-success " type="submit" value="Rechercher">Rechercher</button> -->
				      <div class="input-group mx-auto">
						  <input value="<?php if(isset($_GET['recherche'])) { echo $_GET['recherche'];} ?>" name="recherche" id="name" type="text" class="form-control" placeholder="Recherche" aria-label="Recipient's username" aria-describedby="basic-addon2">
						  <div class="input-group-append ">
						    <button value="Rechercher" name="Rechercher" class="input-group-text btn-primary " id="basic-addon2"><i class="fa fa-search"></i></button> 
						  </div>
						</div>
				    </form>
				    
				    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
				      <li class="nav-item active mx-auto">
				        <a class="nav-link btn btn-success text-light" href="personnel.php"><i class=" fa fa-home"></i>	Accueil</a>
				      </li>
				      
				      <li class="nav-item ml-5 mx-auto">
				        <a class="nav-link  btn btn-danger text-light" href="logout.php" >Deconnexion</a>
				      </li>
				    </ul>
				  </div>
				</nav>
		<div class="col">
							
							<?php 
											if (file_exists("Admin/".$_SESSION['photo']) && isset($_SESSION['photo'])) {
												?>

												<a href="#" data-id="<?=$_SESSION['id']?>" data-toggle="modal" data-target="#afficher"><img title="Profil Employe" src="<?='Admin/'.$_SESSION['photo']?>"width="80%" class="d-block img-thumbnail  rounded-circle" /></a>

												<?php
											}else {
												?>

													<a href="#" data-id="<?=$_SESSION['id']?>" data-toggle="modal" data-target="#afficher"><img data-toggle="tooltip" data-placement="top" title="Profil Employe" src="Admin/Photos/Profil/no-avatar.jpg" width="100%"  class="d-block img-thumbnail rounded-circle"/></a>
													
										 	<?php  
											}

										 	?>

					</div>
		
	</div>
	
</div>
		
	</div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="remarque" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title text-warning text-center" id="exampleModalLabel"><i class="fa fa-exclamation-triangle"></i>	Alerte</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <?php 

			if ($_SESSION['password']=='7b902e6ff1db9f560443f2048974fd7d386975b0') {

				echo ' <p style="color: red;"><i> Veillez modidifier le mot de passe (admin1234) pour plus de securité</i></p> </a><br>';?>
				<?php
							
			} 
			if ($_SESSION['photo']=='no-avatar.jpg') {
				
			echo ' <p style="color: red;"><i> Veillez modidifier la photo de profil </i></p> </a><br>';
			}
			
		?>	
      </div>
      <div class="modal-footer">
      	

			<a class="btn btn-warning" href="Admin/editer.php?id=<?=$_SESSION['id']?>">Editer</a> 
		
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>
<br>
	<header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" style="background-image: url(images/img_bg_2.jpg)">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-left">
					

					
					<div class="row row-mt-15em">
						<div class="col-md-7 mt-text animate-box" data-animate-effect="fadeInUp">
							<blockquote><img src="bcglogo.png" alt="Logo" id="logo" /></blockquote>
							
						</div>
						<div class="col-md-4 col-md-push-1 animate-box" data-animate-effect="fadeInRight">
							<div class="form-wrap">
								<div class="tab">
									
									<div class="tab-content" >
										<div class="tab-content-inner active" data-content="signup">
											<h3><i class=" fa fa-home"></i>Tableau de Bord</h3>

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
						
					</div>

				</div>
			</div>
		</div>
	</header>

	<div class="gtco-section">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-2 text-center gtco-heading">
					<h2>Gestion de Préstations</h2>
					<p>Les Présences</p>
				</div>
			</div>
		</div>

			
			<?php 
$bdd = new PDO('mysql:host=localhost;dbname=bcg', 'root', 'Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

$rech = $bdd->query('SELECT * FROM employe ORDER BY dateEnregistrement DESC LIMIT 5');


if (isset($_GET['recherche']) AND !empty($_GET['recherche'])) {
	
		$recherche= htmlspecialchars($_GET['recherche']);
		

		$rech = $bdd->query('SELECT * FROM employe WHERE matricule LIKE "%'.$recherche.'%" ORDER BY id DESC ');

			if ($rech->rowCount()==0) {
				
				$rech = $bdd->query('SELECT * FROM employe WHERE nomEmploye LIKE "%'.$recherche.'%" ORDER BY id DESC ');
					

				if ($rech->rowCount()==0) {
					$rech = $bdd->query('SELECT * FROM employe WHERE departement LIKE "'.$recherche.'%" ORDER BY id DESC ');


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
				
				<table id="customer_data" class="table table-bordered table-dark  table-striped">
			<thead>
				<tr>
					<th>Id</th>
					<th>Matricule</th>
					<th>Nom</th>
					<th>Département</th>
					<th>Fonction</th>
					<th>Etat de Service</th>

				</tr>
			</thead>

				<?php 
				$id=1;
				while($row = $rech->fetch()) {  ?>
				<tr>
					<td><?php echo $id++;?></td>
					<td><?php echo $row['matricule'];?></td>
					<td><?php echo $row['nomEmploye'];?></td>	
					<td><?php echo $row['departement'];?></td>
					<td><?php echo $row['fonction'];?></td>
					<td><?php echo $row['etatService'];?></td>
					<td><?php echo '<a style="color:black;" href="presence.php?id='.$row['id'].'" onclick="return confirm(\'Présence de  '.$row['nomEmploye'].' matriculé '.$row['matricule'].' ?\');" class="btn btn-primary">Présence</a>'; ?></td>
					<td><?php echo '<a style="color:black;" href="absence.php?id='.$row['id'].'" onclick="return confirm(\'Etes-vous sûr que  '.$row['nomEmploye'].' matriculé '.$row['matricule'].' est asbsent(e) ?\');" class="btn btn-danger">Absence</a>'; ?></td>
					
					
					
				</tr>

			<?php } ?>
		</table>
	</div>
</div>


						<div class="gtco-container">
							<div class="row">
								<div class="col-md-8 col-md-offset-2 text-center gtco-heading">

									<?php } else{ 
										if(isset($recherche)){
				 							echo '<p style = "color:black;">Aucun resultat</p>'.$recherche;  }


				 							} ?>
				 				</div>
				 			</div>
				 		</div>

	<?php } ?>
	<style>
		table,tr,th,td{
			border: 3px solid black;
		}
	</style>

<?php 

if (isset($_GET['msg']) ) {
			
		if ($_GET['msg']=='Present'){

			echo '<p style="color: #14d2e3;"> la presence est déjà observé</p>';
		}elseif ($_GET['msg']=='Absent') {
			echo '<p style="color: red;"> l\'absence est déjà observé</p>';
		}

?>
	
	
<?php } ?>

	<div  class="container box">
				<div class="col-md-12 col-md-offset-3 text-center gtco-heading">
			
			<div class=" col-md-12 table-responsive">
				
				<table id="customer_data" class="table table-bordered table-dark  table-striped">
			<thead>
			
					<tr>
						<th style=" text-align: center; ">N°</th>
						<th style=" text-align: center; ">Matricule</th>
						<th style=" text-align: center; ">Nom </th>
						<th style=" text-align: center; ">Departement </th>
						<th style=" text-align: center; ">Observation </th>
						<th style=" text-align: center; ">Jour </th>
						<th style=" text-align: center; ">Arrivé à </th>
																
					</tr>
			</thead>

				<?php

try
{

$b = new PDO('mysql:host=localhost;dbname=bcg', 'root', 'Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
$jour_presence=date('d');

}
catch(Exception $e)
{
echo 'Erreur :' .$e->getMessage(); 

}
	
		$reponse = $b->query('SELECT * FROM presence WHERE jour_presence LIKE "%'.$jour_presence.'%" ORDER BY time_observation DESC ');
			$id=1;
		while ($donnees = $reponse->fetch())
{
?>

							 <tr>
								<td><?php echo $id++;?></td>
								<td><?php echo $donnees['matricule'];?></td>
								<td><?php echo $donnees['nomEmploye'];?><br></td>	
								<td><?php echo $donnees['departement'];?><br></td>
								<td><?php echo $donnees['presence'];?><br></td>
								<td><?php echo $donnees['jour_presence'];?>/<?php echo $donnees['mois_presence'];?>/<?php echo $donnees['annee_presence'];?><br></td>
								<td><?php echo $donnees['temps_arrive'];?><br></td>
							</tr>
											
															
															<?php
									
															}
																$reponse->closeCursor(); // Termine le traitement de la requête

											?>
															</table> 
															</div>

	<div class="container-fluid">
		<div class="row">
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<legend  for="name"> Exporter en Excel :</legend>
						<form method="POST" action="excel_presence_mensuelle.php">
							<input type="submit" name="export_excel" class="btn btn-succes" value="Présences mensuelles">
						</form>
					</div>
					<div class="col-sm-6">
						<legend  for="name"> Exporter en Excel :</legend>
						<form method="POST" action="excel_absence_mensuelle.php">
							<input type="submit" name="export_excel" class="btn btn-succes" value="Absences mensuelles">
						</form>
					</div>
				</div>
			</div>
			
		</div>
	</div>
		</div>
	</div>

	<!-- Modal profil -->
<div class="modal fade" id="afficher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title text-center" id="exampleModalLabel">Profil</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div id="message"></div>
      </div>
      <div class="modal-body" id="afficher_view">
      	....
      </div>
      <div class="modal-footer">
      	
      	<?php echo '<a href="Admin/editer.php?id='.$_SESSION['id'].'" class="btn btn-warning">Editer</a>'; ?>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
      	<a href="logout.php" class="btn btn-danger">Deconnexion</a>

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
						<h3>Table de bord</h3>
						<ul class="dropdown">
							<li><a href=departement.php>Departements</a></li>													
							<li><a href="employe.php">Employée</a></li>														
							<li><a href="conge.php">Congés</a></li>
							<li><a href="salaire.php">Salaires</a></li>
							<li><a href="statistique.php">Statistiques</a></li>
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
		<script src="jquery/dist/jquery.js"></script>
	<!-- jquery 1.3 -->
	<script src="js/jquery.min.js"></script>
	
	<script src="js/jquery.easing.1.3.js"></script>

	<script src="fonts/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="fonts/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	<script src="js/jquery.waypoints.min.js"></script>

	<script src="js/owl.carousel.min.js"></script>

	<script src="js/jquery.countTo.js"></script>

	<script src="js/jquery.stellar.min.js"></script>

	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	
	<script src="js/bootstrap-datepicker.min.js"></script>

	<script src="js/main.js"></script>
	<?php

			if ($_SESSION['password']=='7b902e6ff1db9f560443f2048974fd7d386975b0' OR $_SESSION['photo']=='no-avatar.jpg') {
	
	?>
	<script type="text/javascript">
		$("#remarque").modal("show")
	</script>

	<?php

			}
	 ?>
	</body>
	<script type="text/javascript">

		$("#afficher").on("shown.bs.modal",function(e){
			var button = $(e.relatedTarget)
			var modal = $(this)

			var id = button.data("id")
			$.ajax({
				url:"afficher.php",
				method:"POST",
				data:{id:id},
				dataType:"html",
				success: function(afficher){
					$("#afficher_view").html(afficher)
					console.log(afficher)
				}

			})



		})

	</script>
</html>
