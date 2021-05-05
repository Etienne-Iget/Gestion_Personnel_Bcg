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
	
		header('location:index.php');
	
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
	$_SESSION['password']=$userinfo['password'];
	$_SESSION['etatService']=$userinfo['etatService'];
	$_SESSION['email']=$userinfo['email'];
	}
		
?>


<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	
	<title> Accueil &mdash; Employé </title>
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
	
	<div class="gtco-loader"></div>

	
	<div>
			
		
			<div style=" background-color: #708090; " class="gtco-container">
			<h2 style="color: black; text-align: center;">BUREAU DE CENTRALISATION GEOMATIQUE</h2>
			<div style=" background-color: #708090; " class="row">
				
				
			</div>
			
		</div>
<br>
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

			if ($_SESSION['password']=='9e5743b8410117fb1ada9497b3d9eaf73ee70cb9') {

				echo ' <p style="color: red;"><i> Veillez modidifier le mot de passe par defaut (bcg1234) pour plus de securité</i></p> </a><br>';?>
				<?php
							
			} 
			if ($_SESSION['photoEmploye']=='no-avatar.jpg') {
				
			echo ' <p style="color: red;"><i> Veillez modidifier la photo de profil </i></p> </a><br>';
			}
			if ($_SESSION['etatService']=='En Conge') {
				echo '<a href="#"> <p style="color: red;"><i> Vous etes en Congés</i></p> </a><br>';
			}

			if ($_SESSION['etatService']=='En Vacances') {
				echo '<a href="#"> <p style="color: red;"><i> Vous etes en Vacances </i></p> </a><br>';
			}
			
		?>	
      </div>
      <div class="modal-footer">
      	
<?php if ($_SESSION['password']=='9e5743b8410117fb1ada9497b3d9eaf73ee70cb9' OR $_SESSION['photoEmploye']=='no-avatar.jpg' ) {
	
 ?>

			<?php echo '<a class="btn btn-warning" href="modifier_employe.php?id='.$_SESSION['id'].'">Editer</a>'; ?>
<?php } ?>
		
        </div>
    </div>
  </div>
</div>
						<!-- l'en-tete fonctionne bien				 -->
	<!-- modal -->
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
</div>

<!-- ----------------------------------------------------------------------------------------	 -->
<div style=" background-color: #708090; " class="container-fluid">
	<div class="row">
<div  class="container">
	<div style=" background-color: #708090; " class="row align-items-center">
		<div class="col"><img src="bu.png" alt="Logo" width="100%" /></div>
			<nav class="navbar navbar-expand-lg  navbar-light bg-light col-md-7 col">
				  <button class="navbar-toggler  mx-auto" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
				    <span class="navbar-toggler-icon"></span>
				  </button>
				  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
				    <form class="form-inline" action="#" method="POST">
				      <!-- <input name="recherche" id="name" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
				      <button class="btn btn-sm btn-outline-success " type="submit" value="Rechercher">Rechercher</button> -->
				      <div class="input-group">
						  <input name="recherche" id="name" type="text" class="form-control" placeholder="Recherche" aria-label="Recipient's username" aria-describedby="basic-addon2">
						  <div class="input-group-append">
						    <button value="Rechercher" name="Rechercher" class="input-group-text btn-primary " id="basic-addon2"><i class="fa fa-search"></i></button> 
						  </div>
						</div>
				    </form>
				    
				    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
				      <li class="nav-item active mx-auto">
				        <a class="nav-link btn btn-primary text-light" href="information.php" >Accueil</a>
				      </li>
				      <li class="nav-item active mx-auto">
				        <a class="nav-link btn btn-success text-light" href="#" data-toggle="modal" data-target="#communique">Communiqué</a>
				      </li>
				      
				      <li class="nav-item ml-5 mx-auto">
				        <a class="nav-link  btn btn-danger text-light" href="logout.php" >Deconnexion</a>
				      </li>
				    </ul>
				  </div>
				</nav>
		<div class="col">
							
							<?php 
											if (file_exists($_SESSION['photoEmploye']) && isset($_SESSION['photoEmploye'])) {
												?>

												<a href="#" data-id="<?=$_SESSION['id']?>" data-toggle="modal" data-target="#afficher"><img data-toggle="tooltip" data-placement="top" title="Profil Employe" src="<?=$_SESSION['photoEmploye']?> "width="100%" class="d-block  rounded-circle" /></a>
												<?php
											}else {
												?>

													<a href="#" data-id="<?=$_SESSION['id']?>" data-toggle="modal" data-target="#afficher"><img data-toggle="tooltip" data-placement="top" title="Profil Employe" src="Employe/Photo/no-avatar.jpg" width="100%"  class="d-block  rounded-circle"/></a>
													
										 	<?php  
											}

										 	?>

					</div>
		
	</div>
	
</div>
		
	</div>
</div>

	


	<!-- Modal -->
<div class="modal fade" id="fiche_paie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title text-center" id="exampleModalLabel">Fiche de paie</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div id="message"></div>
      </div>
      <div class="modal-body" id="fiche_view">
      	<i style="color: red;">Chergement....</i>
      </div>
     
    </div>
  </div>
</div>
<?php 
	
	$db  = new PDO('mysql:host=localhost;dbname=bcg', 'root', 'Iget1209') or die(mysql_errno());

	$nbres = $db->prepare("SELECT count(*) AS non_lu FROM messagerie WHERE etat='0' AND email_destination='".$_SESSION['email']."' ");
	$nbres->execute();
	$resultat = $nbres->fetch(PDO::FETCH_ASSOC);
	$non_lu = $resultat['non_lu'];

	$voir='';


	if ($non_lu==0) {

		$non_lu=' ';
		$voir.='<span class="badge badge-primary badge-pill">'.$non_lu.'</span>';
	}else{$voir.='<span class="badge badge-danger badge-pill">'.$non_lu.'</span>';}

 ?>
		
		<div class="container-fluid" id="gtco-header" >
			<div class="row">
				<div class="container" height=100px>
					<div class="row py-5" height=100px >
						<div class="col-12 col-md-6 mb-4">

							<div class="form-wrap " height=100px >
									<div class="tab " height=100px>
										<div class="tab-content " height=100px>
											<div class="tab-content-inner active " height=100px data-content="signup">
											 	<h3><i class=" fa fa-home "></i>	Tableau de Bord</h3>

											 	<ul class="list-group">
												  <li class="list-group-item d-flex justify-content-between align-items-center">
												   <a href="?action=Activités"><i class=" fa fa-edit fa-lg"></i></a><a href="?action=Activités">Activités</a>
												    <span class="badge badge-primary badge-pill">	</span>
												  </li>
												  <li class="list-group-item d-flex justify-content-between align-items-center">
												   <a href="#"data-id="<?=$_SESSION['id']?>" data-toggle="modal" data-target="#fiche_paie"><i class="fa fa-file-pdf-o fa-lg"></i></a><a href="#" data-id="<?=$_SESSION['id']?>" data-toggle="modal" data-target="#fiche_paie">Fiche de Paie</a>
												    <span class="badge badge-primary badge-pill">	</span>
												  </li>
												  <li class="list-group-item d-flex justify-content-between align-items-center">
												   <a href="statistique.php"><i class=" fa fa-history fa-lg"></i></a><a href="statistique.php">Rapports</a>
												    <span class="badge badge-primary badge-pill">	</span>
												  </li>
												  <li class="list-group-item d-flex justify-content-between align-items-center">
												  	<a href="#"  data-email="<?=$_SESSION['email']?>" data-toggle="modal" data-target="#plus_msg"><i class=" fa fa-envelope-o fa-lg"></i></a><a href="#" data-email="<?=$_SESSION['email']?>" data-toggle="modal" data-target="#plus_msg">Messages</a>
												    <a href="#" data-email="<?=$_SESSION['email']?>" data-toggle="modal" data-target="#plus_msg"><?php echo $voir;?></a>
												  </li>
												</ul>
																								

											</div>
										</div>
									</div>
								</div>
							
						</div>
						<div class="col-12 col-md-6">
							
							<?php

										try
										{

										$base = new PDO('mysql:host=localhost;dbname=bcg', 'root', 'Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

											$email = $_SESSION['email'];
										}
										catch(Exception $e)
										{
										echo 'Erreur :' .$e->getMessage(); 

										}
												
											
												$reponse = $base->query('SELECT * FROM messagerie WHERE email_destination LIKE "%'.$email.'%"  ORDER BY time_envoi DESC LIMIT 1');
												
												?>

								<div class="form-wrap" >
									<div class="tab">
										<div class="tab-content">
											<div class="tab-content-inner active" data-content="signup" style="overflow: auto;">

									
										
												<?php
												$id=1;
												while ($donnees = $reponse->fetch())
										{
										?>
										
								 				<table style="border:0;" id="customer_data" class="table-striped">

															<tr>
																<td>Date de reception : </td>
																<th style="align:center;"><?php echo $donnees['time_envoi'];?></th>
															</tr>
															<tr>
																<td>Expediteur : </td>
																<th style="align:center;"><?php echo $donnees['email_source'];?></th>
															</tr>
															<tr>
															<td>Message : </td>
															<th disabled><textarea disabled style="align:center;"><?php echo $donnees['message'];?></textarea></th>
																
															</tr>
															<tr>
																<td><a href="?action=msg" class=" btn btn-success" >Repondre</a></td>
																
															</tr>
												</table>

														<?php
															
														}
															$reponse->closeCursor(); // Termine le traitement de la requête

																	
														?>
										

											</div>
										</div>
									</div>
										
									</div>

						</div>
					</div>
					
				</div>
			</div>
		</div>
	
	<header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" style="background-image: url(images/img_bg_2.jpg)">
		<div class="overlay"></div>
		<div class="gtco-container">

	<?php 

			if (isset($_GET['action']) ) {
			
					if ($_GET['action']=='msg'){

						?>

								<?php

 
	try
		{
		$mess = new PDO('mysql:host=localhost;dbname=bcg','root','Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
			// formulaire inscription

			if (isset($_POST['envoyer'])) {
				$email_source = $_SESSION['email'];

				$email_destination = htmlspecialchars($_POST['email_destination']);
		
				$message = htmlspecialchars($_POST['message']);
				$date	=	date("H:i:s");

				// var_export($_POST);


				if (!empty($email_destination)) { 

				if  (!empty($message)){	


					$send = $mess -> prepare(" INSERT INTO  messagerie (email_source, email_destination, message) VALUES(:email_source, :email_destination, :message)");
					$send -> execute(array('email_source'=>$email_source,'email_destination'=>$email_destination, 'message'=>$message));

									$return = "Message envoyé avec succès à ".$date."  ";

							}else $return = "Veillez écrire le message  ";



						}else $return = "Veillez écrire le destinateur  ";
			}
				

		}
		catch(Exception $e){
		die("erreur".$e->getMessage());
	}

?>
	<form action="#" method="POST">
				
		<div class="container-fluid py-5">
			<div class="row">
    			<div style="text-align: center;" class="col align-self-center">
					<h2>Contacter</h2>
					<p>Message</p>
					<p style="color: red;"><em><?php if(isset ($_POST['envoyer']) AND isset($return)) echo $return; ?></em></p>
      
       			</div>
       		</div>
			<div class="row">
				<div class="container">
					<div class="row">
						<div class="col">
							<label class="sr-only" for="name">Email :</label>
							<input type="email"  name="email_destination" id="name" class="form-control border border-primary" placeholder="Email" value="<?php echo $donnees['email_source'];?>">
						</div>
					</div>
					<div class="row p-5">
						<div class="col">
							<div class="form-group">
								<label for="message" class="sr-only">Message</label>
								<textarea style="color: black;" class="form-control border border-primary" name="message" cols="80" rows="6" maxlength="65525" placeholder="Message"></textarea>
							</div>
						</div>
						<div class="col">
							<button type="submit" name="envoyer" class="btn btn-primary btn-block">Envoyer</button>
						</div>
					</div>
				</div>
				
			</div>
			
		</div>
	</form>

						<?php

					}elseif ($_GET['action']=='Activités') {

						?>


						<?php


$bdd2 = new PDO('mysql:host=localhost;dbname=bcg', 'root', 'Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
$nomEmploye = $_SESSION['nomEmploye'];

	if (isset($nomEmploye)) {

		$requser = $bdd2->prepare('SELECT * FROM departement WHERE nomEmploye = ? ORDER BY dateAjout DESC LIMIT 1');
		$requser->execute(array($nomEmploye));

		$user = $requser->fetch();

		if (isset($_POST['observationNew']) AND !empty($_POST['observationNew']) And $_POST['observationNew']!=$user['observation']) {

			$observationNew=htmlspecialchars($_POST['observationNew']);
			$insertnom=$bdd->prepare("UPDATE departement SET observation = ? WHERE nomEmploye = ?  ORDER BY dateAjout DESC LIMIT 1");
			$insertnom->execute(array($observationNew,$nomEmploye));

			$return= " l'observation est ajoutée ";
		}

		

		if (isset($_POST['documentNew']) AND !empty($_POST['documentNew']) And $_POST['documentNew']!=$user['documents']) {

			$documentNew=htmlspecialchars($_POST['documentNew']);
			$insertnom=$bdd->prepare("UPDATE departement SET documents = ? WHERE nomEmploye = ? ORDER BY dateAjout DESC LIMIT 1");
			$insertnom->execute(array($documentNew,$nomEmploye));

			header('location:information.php');
		}

	} else{
		header('location:connexion.php');
	}
?>

<form action="#" method="POST">
			
		<div class="container-fluid py-5">
			<div class="row">
    			<div style="text-align: center;" class="col align-self-center">
					<h2>Activités</h2>
					<p style="color: red;"><em><?php if(isset ($_POST['envoi_obs']) AND isset($return)) echo $return; ?></em></p>
      
       			</div>
       		</div>
			<div class="row col align-self-center">
				<div class="container">
					<div class="row p-5">
						<div class="col px-5">
							<textarea style="color: black;" class='form-control bg-light' disabled  name="activite" cols="77" rows="4" maxlength="65525" ><?php echo $user['activite']; ?></textarea>
						</div>
					</div>
					<div class="row p-5">
						<div class="col px-5">
							<div class="form-group">
								<textarea style="color: black;" class='form-control bg-light' name="observationNew" cols="77" rows="6" maxlength="65525" placeholder="Observation"><?php if(isset($observationNew)) { echo $observationNew;} ?></textarea>
							</div>
						</div>
					</div>
					<div class="row  px-5">
					    <div class="col-2  px-5">
					      <label for="name">Annexe</label>
					    </div>
					    <div class="col-6 ">
					     <input type="file"  name="documentNew" id="name" class="form-control" placeholder="Annexe">
					    </div>
					    <div class="col px-5 ">
					     <button type="submit" name="envoi_obs" class="btn btn-success btn-block">Envoyer l'Observation</button>
					    </div>
					</div>
					
					
				</div>
				
			</div>
			
		</div>
	</form>

						<?php
					}


													

	?>
<?php  

			}else{
?>
	<!-- <div  style=" background-color:#708090; "> -->
		<div class="gtco-container" >
			<div class="row animate-box justify-content-center py-5">
									<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
								<label class="form-control"  style="color: black;" ><h3>Activités</h3></label>
									</div>
									<br>
				<div class="col-m-auto" style="overflow: auto;">

								<div  class="container box " >
									
									<div class="table-responsive" >
										<table id="customer_data" class="table table-dark" >
									<thead>
									
											<tr>
												<th style=" text-align: center; ">N°</th>
												<th style=" text-align: center; ">Département</th>
												<th style=" text-align: center; ">Fonction</th>
												<th style=" text-align: center; ">Activité </th>
												<th style=" text-align: center; ">Observation </th>
											
											</tr>
									</thead>


<?php

try
{

$bdd1 = new PDO('mysql:host=localhost;dbname=bcg', 'root', 'Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

	$nomEmploye = $_SESSION['nomEmploye'];
}
catch(Exception $e)
{
echo 'Erreur :' .$e->getMessage(); 

}
	
		$reponse = $bdd1->query('SELECT * FROM departement WHERE nomEmploye LIKE "%'.$nomEmploye.'%"  ORDER BY dateAjout DESC LIMIT 5');
		 $id=1;
		while ($donnees = $reponse->fetch())


{
?>

															 <tr>
																<td><?php echo $id++;?></td>
																<td><?php echo $donnees['departement'];?></td>
																<td><?php echo $donnees['fonction'];?><br></td>	
																<td><?php echo $donnees['activite'];?><br></td>
																<td><?php echo $donnees['observation'];?><br></td>
															</tr>
											
															
															<?php
									
															}
																$reponse->closeCursor(); // Termine le traitement de la requête

											?>
															</table> 
														</div>
													</div>
												<form method="POST" action="excel_activite.php">
													<input type="submit" name="export_excel" class="btn btn-secondary" value="Exporter en Excel">
												</form>

				</div>
			</div>
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2">
					
				</div>
			</div>
		</div>

	</div>


		</div>

		<?php } ?>
		
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
						<h3>Bureaux</h3>
						<ul class="dropdown">
							<li><a href=#>Departements</a></li>													
							<li><a href=#>Employée</a></li>														
							<li><a href=#>Congés</a></li>
							<li><a href=#>Salaires</a></li>
							<li><a href=#>Statistiques</a></li>
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

					<!-- Modal Plus de message -->
			<div class="modal fade " id="plus_msg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg modal-dialog-scrollable " role="document">
			    <div class="modal-content bg bg-info">
			      <div class="modal-header">
			        <h2 class="modal-title text-center" id="exampleModalLabel">Messages</h2>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			        <div id="message"></div>
			      </div>
			      <div class="modal-body" id="plus_view">
			      	<i style="color: red;">Chergement	<i class=" fa fa-spin fa-spinner"></i></i>
			      </div>
			      <div class="modal-footer">
			       
			      </div>
			    </div>
			  </div>
			</div>

					<!-- Modal message -->
					<div class="modal reponse fade" id="repondre" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
					    <div class="modal-content">
					      <div class="modal-header bg bg-secondary">
					        <h2 class="modal-title text-center" id="exampleModalLabel">Message</h2>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					        <div id="msg"></div>
					      </div>
					       <div class="modal-body bg bg-dark" id="repondre_view">

					      	<i style="color: red;">Chergement	<i class=" fa fa-spin fa-spinner"></i></i>
					     

					      </div>
					      
					      <div class="modal-footer border border-primary bg-info">
					      	<div class="input-group mb-3  " >
							  <input type="text" class="form-control border border-primary bg-light "  aria-describedby="button-addon2">
							  <div class="input-group-append">
							    <button class="btn btn-outline-primary" type="button" id="button-addon2">Envoyer</button>
							  </div>
							</div>
					        
					      </div>
					    </div>
					  </div>
					</div>


<!-- Modal Profil-->
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
      	<i class=" fa fa-spin fa-spinner"></i>
      </div>
      <div class="modal-footer">
      	
      	<?php echo '<a class="btn btn-warning" href="modifier_employe.php?id='.$_SESSION['id'].'">Editer</a>'; ?>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
      	<a href="logout.php" class="btn btn-danger">Deconnexion</a>

      </div>
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

			if ($_SESSION['password']=='9e5743b8410117fb1ada9497b3d9eaf73ee70cb9' OR $_SESSION['photoEmploye']=='no-avatar.jpg' OR $_SESSION['etatService']=='En Vacances' OR $_SESSION['etatService']=='En Conge') {
	
	?>
	<script type="text/javascript">
		$(function () {
		  $('[data-toggle="tooltip"]').tooltip()
		})
	</script>
	<script type="text/javascript">
		$("#remarque").modal("show")
	</script>

	<?php

			}
	 ?>

	</body>

<script type="text/javascript">
	
$(function(){

	display()
});

function display(){
	// var b ='bjr';
	$.ajax({
		url:"requete.php",
		method:"POST",
		dataType:"json",
		// data:{a:b}
		success:function(dt){ 
			console.log(dt)
			$('#info').html(dt.a) 

			// alert(dt.a)
		}
	});
}

</script>
</html>
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
				}

			})



		})

	</script>
<script type="text/javascript">
	$("#fiche_paie").on("shown.bs.modal",function(event){
			var button = $(event.relatedTarget)
			var modal = $(this)

			var id = button.data("id")
			$.ajax({
				url:"prime.php",
				method:"POST",
				data:{id:id},
				dataType:"html",
				success: function(fiche_paie){
					$("#fiche_view").html(fiche_paie)
					// console.log(fiche_paie)
						}
			})



		})
</script>



<script type="text/javascript">
	$("#plus_msg").on("shown.bs.modal",function(event){
			var button = $(event.relatedTarget)
			var modal = $(this)
		// console.log(button)
			var email = button.data("email")
			$.ajax({
				url:"plus_messages.php",
				method:"POST",
				data:{email:email},
				dataType:"html",
			success:function(plus_msg){ 
			// console.log(plus_msg)
			$('#plus_view').html(plus_msg)


					


				}
			})



		})
		
		$("#repondre").on("shown.bs.modal",function(ev){
				var boutton = $(ev.relatedTarget);
				id = boutton.data('id');
				console.log(boutton)
				var destination = boutton.data('destination')
				var source = boutton.data('source')

				$.ajax({
						url:"repondre.php",
						method:"POST",
						data:{source:source,destination:destination},
						dataType:"html",
						success:function(repondre_view){
						$('#repondre_view').html(repondre_view)
							 
							  // boutton.find("#ancre").show();
						$('#ancre').scrollTop = $('#ancre').scrollHeight

						$("#form_message").submit(function(e){

						  e.preventDefault(); //empêcher une action par défaut
						  var form_data = $(this).serialize(); //Encoder les éléments du formulaire pour la soumission
						  var form_url = $(this).attr("action"); //récupérer l'URL du formulaire
						  var form_method = $(this).attr("method"); //récupérer la méthode GET/POST du formulaire
						  
							// console.log(form_data)
						  $.ajax({
						    url : "envoi.php",//récupérer l'URL où envoyer les données
						    type: form_method,
						    data : form_data,
						    success:function(reception){

						    $("#msg").html(reception);
						    }

						  })
						 
						});
					}
							
				})
		})
</script>
