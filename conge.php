<?php

	function Securise($string){
		if (ctype_digit($string)) {
			$string=intval($string);
		}else{
			$string = strip_tags($string);
			$string = addcslashes($string, '%_');
		}
		return $string;
	}

	
			// On se connecte à MySQL
	try
		{
		$bdd = new PDO('mysql:host=localhost;dbname=bcg','root','Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
			// formulaire inscription

			if (isset($_POST['accepter'])) {

				$nom = Securise($_POST['nom']);			
				$type = Securise($_POST['type']);
				$motif = Securise($_POST['motif']);
				$dateDebut = Securise($_POST['dateDebut']);
				$dateFin =Securise($_POST['dateFin']);
				// var_export($_POST);

				if (!empty($nom) AND !empty($type) AND !empty($motif) AND !empty($dateDebut) AND !empty($dateFin) ){			



									$req= $bdd -> prepare(" INSERT INTO conge (nom, type, motif, dateDebut, dateFin) VALUES( :nom, :type, :motif, :dateDebut, :dateFin)");
									$req->execute(array(
										'nom'=>$nom,
										'type'=>$type,
										'motif'=>$motif,
										'dateDebut'=> $dateDebut,
										'dateFin'=>$dateFin));


									if ($type =='Conge Administratif' OR $type=='Conge de Circonstance' OR $type=='Repos Medical') {
										
										$newEtat="En Congé";
		
										$insertservice=$bdd->prepare("UPDATE employe SET etatService = ? WHERE nomEmploye = ?");
										$insertservice->execute(array($newEtat,$nom));
									}


									$return = "congé Enregistré ";
									
									// header('location:conge.php');
									
				}else $return = "champs manquant!";
			}


		}
		catch(Exception $e){
		die("erreur".$e->getMessage());
	}

?>

<div style=" background-color: #0f983d; " class="gtco-container">
			<h1 style="color: black; text-align: center;">Congé</h1>
			<div style=" background-color: #0f983d; " class="row">
				
				
			</div>
			
		</div>
<?php 
	 require_once('includes/header.php');
 ?>

<div class="gtco-loader"></div>

	<div>

		<header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" style="background-image: url(images/img_bg_2.jpg)">
		<div class="overlay"></div>
		<div class="gtco-container h-100">

							<div class="container-fluid h-100" >
								<div class="row h-50">
									<div class="container">
										<div class="row ">
											<div class="col text-center" data-animate-effect="fadeInUp">
												<img src="bcglogo.png" alt="Logo" id="logo" />
											</div>
										</div>
										<div class="row h-80 align-items-center">
											<div class="col">
												<div class="row ">
											<div class="col">

												<div class="form-wrap ">
													<div class="tab">
														
														<div class="tab-content" >
															<div class="tab-content-inner active" data-content="signup">
																<h3><i class=" fa fa-home"></i>	Tableau de Bord</h3>

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

											<div class="col ">
												
												<div class="form-wrap ">
													<div class="tab">
														
														<div class="tab-content">
															<div class="tab-content-inner active" data-content="signup">
																	<h3>Gestion de congés</h3>

																	<link rel="stylesheet" href="css/monthly.css">
																		<h4>Calendrier</h4>
																	
																			
																			<div style="width:100%; max-width:600px; display:inline-block;">
																				<div class="monthly" id="mycalendar"></div>
																			</div>
																			
																			<a href="?action=congé" class="button"> les Congés</a>
						
																	
																	<div>
																
															</div>
														</div>
																	
														</div>
																	
													</div>
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
			
	
	<?php 
$bdd = new PDO('mysql:host=localhost;dbname=bcg', 'root','Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

$rech = $bdd->query('SELECT * FROM employe ORDER BY dateEnregistrement DESC LIMIT 1');


if (isset($_GET['recherche']) AND !empty($_GET['recherche'])) {
	
		$recherche= htmlspecialchars($_GET['recherche']);

		$rech = $bdd->query('SELECT * FROM employe WHERE matricule LIKE "%'.$recherche.'%" ORDER BY id DESC ');

			if ($rech->rowCount()==0) {
				
				$rech = $bdd->query('SELECT * FROM employe WHERE nomEmploye LIKE "%'.$recherche.'%" ORDER BY id DESC ');

				if ($rech->rowCount()==0) {

					$rech = $bdd->query('SELECT * FROM employe WHERE matricule LIKE "%'.$recherche.'%" ORDER BY id DESC ');

				}
			}
?>


<?php if ($rech->rowCount() > 0) {


		while($row = $rech->fetch()) { 
	
?>


		<div style=" background-color: #0f983d; " id="gtco-subscribe">
		<div style=" background-color: #0f983d; " class="gtco-container">
			<div style=" background-color: #0f983d; " class="row animate-box">
				<div class="col-md-12 col-md-offset-2 text-center gtco-heading">
						<div style="display:inline-block; width:250px;">
							<!-- <input type="text" id="mytarget" value="Select Date">
							<div class="monthly" id="mycalendar2"></div> -->
		<p style="color: red;"><em><?php if(isset ($_POST['accepter']) AND isset($return)) echo $return; ?></em></p>
							<h3>Enregistrement du congé</h3>
							
						</div>
				</div>
			</div>
			<div class="row animate-box">
				<div class="col-md-12 col-md-offset-2">
					<form class="form-inline" action="#" method="POST">
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label for="date" class="sr-only">Date du debut</label>
								Date du debut
								<input type="Date" name="dateDebut" class="form-control" id="date" placeholder="Date du debut">
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label for="date" class="sr-only">Date de la fin</label>
								Date de la fin
								<input type="date" name="dateFin" class="form-control" id="date" placeholder="Date de la fin">
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label for="Nom" class="sr-only">Nom</label>
								<input type="text" name="nom" class="form-control" id="Nom" placeholder="Nom" value="<?php echo $row['nomEmploye'];?>">
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label class="sr-only" for="name">Congé</label>
								<select class="form-control" name=type  >
                                    	<option  disabled selected> Type de congé </option>
                                    	<option value="Conge Administratif" style="color: black;"> Congé Administratif </option>
                                    	<option value="Conge de Circonstance" style="color: black;"> Congé de Circonstance </option>
                                    	<option value="Repos Medical" style="color: black;"> Repos Médical </option>
                                 </select>
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label for="text" class="sr-only">Motif</label>
								<input type="text" name="motif" class="form-control" id="text" placeholder="Motif">
							</div>
						</div>
						
						<div class="col-md-6 col-sm-6">
							<button type="submit" id="accepter" name="accepter" class="btn btn-default btn-block">Accorder</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php } ?>
		
		<?php } else{ 

					if(isset($recherche)){
				 	echo '<p style = "color:red;">Aucun resultat</p>'.$recherche;  }


				 	} ?>

	<?php
}
 ?>	

 <?php 


				$bdd = new PDO('mysql:host=localhost;dbname=bcg', 'root', 'Iget1209');
			

		if (isset($_GET['action']) ) {
			
			if ($_GET['action']=='congé') {


											
				$af = $bdd->query ('SELECT * FROM conge  ORDER BY dateDebut DESC ');

				?>

				<?php if ($af->rowCount() > 0) {
 

				?>
					<div  class="container box">
				<div class="col-md-12 col-md-offset-3 text-center gtco-heading">
			
			<div class=" col-md-12 table-responsive">
				<h2>Liste de congés</h2>
				<table id="customer_data" class="table table-bordered table-dark  table-striped">
			<thead>

					<tr>
						
						<th>N°</th>
						<th>Nom</th>
						<th>Type de Coné</th>
						<th>Motif du Congé</th>
						<th>Debut Congé</th>
						<th>Fin Congé</th>
					</tr>
			</thead>

					<?php 
					$id=1;
					while($row = $af->fetch()) { ?>
					<tr>
						<td><?php echo $id++;?></td>
						<td><?php echo $row['nom'];?></td>
						<td><?php echo $row['type'];?></td>
						<td><?php echo $row['motif'];?></td>
						<td><?php echo $row['dateDebut'];?></td>
						<td><?php echo $row['dateFin'];?></td>
						
					</tr>
				<?php } ?>
				</table>
			</div>
		</div>

			</div>
			<?php }
}
}
			 ?>


 <?php 

	 require_once('includes/footer.php');

  ?>

 
	
	<script src="js/jquery.easing.1.3.js"></script>

	<script src="js/bootstrap.min.js"></script>

	<script src="js/jquery.waypoints.min.js"></script>

	<script src="js/owl.carousel.min.js"></script>

	<script src="js/jquery.countTo.js"></script>

	<script src="js/jquery.stellar.min.js"></script>

	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	
	<script src="js/bootstrap-datepicker.min.js"></script>

	<script src="sweetalert2/dist/sweetalert2.all.js"></script>

	<script src="sweetalert2/dist/sweetalert2.all.min.js"></script>

	<script src="js/main.js"></script>

	<script type="text/javascript">
		
	$("#accepter").click(function(){

		Swal.fire(
			  'Enregistrement!',
			  'Réussi!',
			  'success'
			)

	})

	</script>


<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, user-scalable=0">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta charset='utf-8'>
<head>
<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- META ===================================================== -->
    <meta name="description" content="A method for responsive tables">

<!-- Favicon  ========================================== -->


<!-- CSS ======================================================
	<link rel="stylesheet" href="css/responsivetables.css">-->
	<!-- Demo CSS (don't use) -->
	<link href="https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz" rel="stylesheet" type="text/css">
	<style type="text/css">
		body, html {
			padding:0px;
			margin:0px;
			background: url('images/bg.jpg') center;
			background-size:cover;
			background-attachment: fixed;
			text-align:center;
			color:black;
			line-height: 1.4em;
			font-family: "Trebuchet MS", Helvetica, sans-serif;
		}
		body {
			padding:10vh 0;
		}
		
		.monthly {
			box-shadow: 0 13px 40px rgba(0, 0, 0, 0.5);
			font-size: 0.8em;
		}

		input[type="text"] {
			padding: 15px;
			border-radius: 2px;
			font-size: 16px;
			outline: none;
			border: 2px solid rgba(255, 255, 255, 0.5);
			background: rgba(63, 78, 100, 0.27);
			color: #fff;
			width: 250px;
			box-sizing: border-box;
			font-family: "Trebuchet MS", Helvetica, sans-serif;
		}
		input[type="text"]:hover {
			border: 2px solid rgba(255, 255, 255, 0.7);
		}
		input[type="text"]:focus {
			border: 2px solid rgba(255, 255, 255, 1);
			background:#eee;
			color:#222;
		}

		.button {
			display: inline-block;
			padding: 15px 25px;
			margin: 25px 0 75px 0;
			border-radius: 3px;
			color: #fff;
			background: #000;
			letter-spacing: .4em;
			text-decoration: none;
			font-size: 13px;
		}
		.button:hover {
			background: #3b587a;
		}
		.desc {
			max-width: 250px;
			text-align: left;
			font-size:14px;
			padding-top:30px;
			line-height: 1.4em;
		}
		.resize {
			background: #222;
			display: inline-block;
			padding: 6px 15px;
			border-radius: 22px;
			font-size: 13px;
		}
		@media (max-height: 700px) {
			.sticky {
				position: relative;
			}
		}
		@media (max-width: 600px) {
			.resize {
				display: none;
			}
		}
	</style>
	<link rel="stylesheet" href="css/monthly.css">


<!-- JS ======================================================= -->
<!-- <script type="text/javascript" src="js/jquery.js"></script> -->
<script type="text/javascript" src="js/monthly.js"></script>
<script type="text/javascript">
	$(window).load( function() {

		$('#mycalendar').monthly({
			mode: 'event',
			//jsonUrl: 'events.json',
			//dataType: 'json'
			xmlUrl: 'events.xml'
		});

		$('#mycalendar2').monthly({
			mode: 'picker',
			target: '#mytarget',
			setWidth: '250px',
			startHidden: true,
			showTrigger: '#mytarget',
			stylePast: true,
			disablePast: true
		});

	switch(window.location.protocol) {
	case 'http:':
	case 'https:':
	// running on a server, should be good.
	break;
	case 'file:':
	alert('Just a heads-up, events will not work when run locally.');
	}

	});

	// $(functionDate()){
	// 	$(".datepicker").datepicker({
	// 		dateFormat:'yy-mm-dd',
	// 		changeMonth:true,
	// 		changeYear: true

	// 	});
	// }

</script>

