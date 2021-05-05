
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

if (!isset($_SESSION['idAdmin'], $_SESSION['nomAdmin'],$_SESSION['postnomAdmin'],$_SESSION['emailAdmin'] )) {
	header('location:index.php');
}


?>


<!DOCTYPE HTML>

<html>
	<head>
	
	<title>Accueil &mdash; DIRECTION </title>
	<meta http-equiv="refresh" content="900;url=logout.php" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/animate.css">

	<link rel="stylesheet" href="css/icomoon.css">

	<link rel="stylesheet" href="css/themify-icons.css">

	<link rel="stylesheet" href="fonts/bootstrap/dist/css/bootstrap.css">

	<link rel="stylesheet" href="css/magnific-popup.css">

	<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/bootstrap-datepicker.min.css">


	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">

	<link rel="stylesheet" href="css/style.css">

	<script src="sweetalert2/dist/sweetalert2.all.js"></script>

	<script src="js/modernizr-2.6.2.min.js"></script>

	</head>
		
	<body>

		<!-- Modal -->
<div class="modal fade" id="msg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title text-center" id="exampleModalLabel">Messages</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div id="message"></div>
      </div>
      <div class="modal-body" id="message_view">
      	<i style="color: red;">Chergement....</i>
      </div>
      <div class="modal-footer">
      	<?php echo '<a class="btn btn-primary" href="#" data-email="'.$_SESSION['emailAdmin'].'" data-toggle="modal" data-target="#plus_msg">Plus de messages </a>'?>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        
      </div>
    </div>
  </div>
</div>

		
<div class="gtco-loader"></div>
	
	<div id="page" >


	
	<nav class="gtco-nav" role="navigation">
		<div class="gtco-container">
			
			<div class="row">
				<div class="col-sm-4 col-xs-12">
					
					<div id="gtco-logo"><a href="index.php"><img src="bu.png" alt="Logo" id="logo" width="100px" /></a></div>
				</div>
				<br>
				<div class="col-xs-8 text-right menu-1">
					<ul>
						<li><a href="accueil.php" >Communiqué</a></li>
							<li class="has-dropdown">
							<a href="#">Messages</a>
							<ul class="dropdown">
								<?php echo '<li><a href="#" data-email="'.$_SESSION['emailAdmin'].'" data-toggle="modal" data-target="#msg">Voir</a></li>'; ?>
								
							</ul>
						</li>

							<li class="has-dropdown">
							<a href="#">Administrateur</a>
							<ul class="dropdown">
								<li><a href="inscription.php">Inscription</a></li>
								
							</ul>
						</li>

						<li class="has-dropdown">
							<a href="#">Les logs</a>
							<ul class="dropdown">
								<li><a href="excel_logs_admin.php"> Admins</a></li>
								<li><a href="excel_logs_employe.php"> Employé</a></li>
							</ul>
						</li>
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
							<blockquote><img src="bcglogo.png" alt="Logo" id="logo" /></blockquote>
							
							<h1>DIRECTION</h1>	
						</div>

						<div class="col-md-4 col-md-push-1 animate-box" data-animate-effect="fadeInRight">
							<div class="form-wrap">
								<div class="tab">
									
									<div class="tab-content">
										<div class="tab-content-inner active" data-content="signup">
											<h3><a style="color: black;" href="accueil.php"><i class=" fa fa-home">	Services</i></a></h3>
											<ul>
												<li><a href="afficherEmploye.php">Employés</a></li>
							
												<li><a href="stagiaire.php">Stagiaire</a></li>
												<li><a href="?option=Salaire">Salaire</a></li>
											</ul>
											
											
										</div>
									<!-- <p style="color: red;"><em><?php if(isset ($_POST['communiquer']) AND isset($return)) echo $return; ?></em></p> -->
									
										
									</div>
								</div>
							</div>
					
				<?php

			try
					{

						$bb = new PDO('mysql:host=localhost;dbname=administration','root','Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

						if (isset($_POST['communiquer'])) {

								$information = htmlspecialchars($_POST['information']);
									// var_export($_POST);
									
								if (!empty($information)) {

									$Com = $bb->prepare("INSERT INTO communique (information) VALUES (:information)");
									$Com->execute(array('information'=>$information));
						
										$return = "Publication réussi";
									
								}else $return = "Pas de communique à Envoyer";

						}

				}
				catch(Exception $e){
				die("erreur".$e->getMessage());
				}
?>

					<form action="#" method="POST">
						<p style="color: red;"><em><?php if(isset ($_POST['communiquer']) AND isset($return)) echo $return; ?></em></p>

						<legend style="color: yellow;"> Communiqué Pour les employés</legend>
						<textarea id="comment" name="information" cols="45" rows="8" maxlength="65525" required="required" placeholder="Communiqué"></textarea>

						<input type="submit" name="communiquer" value="Envoyer" class="btn btn-primary">

					</form>
					

					</div>

						

					</div>
							
					
				</div>
			</div>
		</div>

			</form>	
			</div>
		</div>
	</div>

		</div>
</header>

	<br>
		<div class="gtco-container">
			<div class="row animate-box">
				<div class="col-md-12 text-center gtco-heading">
					<form action="#" method="GET">
							<div class="row form-group">
								<div class="col-md-12 py-2">
									<label class="sr-only" for="name">Recherche :</label>
									<input type="text"  name="recherche" id="name" class="form-control" placeholder="Recherche">
								</div>
									<br><br>		
								<div class="col-md-12 ">
									<input type="submit" value="rechercher" class="btn btn-primary">
								</div>
							</div>					
					</form>
				</div>
			</div>
		</div>
<?php 
		
if (isset($_GET['option']) ) {
			
			if ($_GET['option']=='Salaire'){
?>

		
			
		

	<div  class="container box">
			<div class="col-md-12 col-md-offset-2 text-center ">
					<h2>SALAIRES</h2>
					<p>Département</p>
			</div>
		</div>
		<div  class="container box">
			<div class="col-md-12 col-md-offset-0 text-center ">
			<div class="table-responsive">
				<div id="affiche_salaire" style="font-size: 15px;"></div>
			</div>
		</div>

		<div  class="container box">
				<div class="col-md-12 col-md-offset-3 text-center gtco-heading">
			
			<div class=" col-md-12 table-responsive">
			
				<form action="#" method="POST"  id="form_salaire">
				<table id="customer_data" class="table table-bordered table-dark  table-striped">
				
					<thead>

								
						<tr style="border:0;">
							<th>Développement de produits cartographiques</th>
							<th id="salaire"><input type="text"  name="dpc" id="dpc" class="form-control" placeholder="Salaire en Fbu"></th>
						</tr>
						<tr style="border:0;">
							<th >Système et Gestion des Données</th>
							<th id="salaire"><input type="text"  name="sgd" id="sgd" class="form-control" placeholder="Salaire en Fbu"></th>
						</tr>
						<tr style="border:0;">
							<th >Suiviévaluation contrôle qualité</th>
							<th id="salaire"><input type="text"  name="scq" id="scq" class="form-control" placeholder="Salaire en Fbu"></th>
						</tr>
						<tr style="border:0;">
							<th >Catalogage-Document</th>
							<th id="salaire"><input type="text"  name="cd" id="cd" class="form-control" placeholder="Salaire en Fbu"></th>
						</tr>
						<tr style="border:0;">
							<th >Prime par Activité</th>
							<th id="prim"><input type="text"  name="pa" id="pa" class="form-control" placeholder="Prime en Fbu"></th>
						</tr>
					</thead>
    										
				</table>
							<input type="submit" class="btn btn-secondary" id="enregister" name="submit" value="Enregistrer Salaire" />
							<div id="res"></div>
			</form>

			</div>
		</div>
	</div>
<?php
					
			}
}else{		
?>

	
		
<?php 
$bdd = new PDO('mysql:host=localhost;dbname=administration', 'root', 'Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

$rech = $bdd->query('SELECT * FROM administrateur ORDER BY id ASC LIMIT 3');


if (isset($_GET['recherche']) AND !empty($_GET['recherche'])) {
	
		$recherche= htmlspecialchars($_GET['recherche']);

		$rech = $bdd->query('SELECT * FROM administrateur WHERE nom LIKE "'.$recherche.'%" ORDER BY id DESC ');

			if ($rech->rowCount()==0) {
				

		$rech = $bdd->query('SELECT * FROM administrateur WHERE postnom LIKE "'.$recherche.'%" ORDER BY id DESC ');

		if ($rech->rowCount()==0) {
			$rech = $bdd->query('SELECT * FROM administrateur WHERE genre LIKE "'.$recherche.'%" ORDER BY id DESC ');
		}
			}

}
 ?>
<?php if ($rech->rowCount() > 0) {
	
?>
 	<div  class="container box">
				<div class="col-md-12 col-md-offset-3 text-center gtco-heading">
			
			<div class=" col-md-12 table-responsive">
				<h2>Les administrateurs</h2>
				<table id="customer_data" class="table table-bordered table-dark  table-striped">
			<thead>
			
				<tr>
					<th>Id</th>
					<th>Nom</th>
					<th>Post-nom</th>
					<th>Prénom</th>
					<th>Genre</th>
					<th>Email</th>
					

				</tr>
			</thead>
				<?php 
				$id=1;

				while($row = $rech->fetch()) { ?>
				<tr>
					<td><?php echo $id++;?></td>
					<td><?php echo $row['nom'];?></td>
					<td><?php echo $row['postnom'];?></td>
					<td><?php echo $row['prenom'];?></td>
					<td><?php echo $row['genre'];?></td>
					<td><?php echo $row['email'];?></td>
					<td><?php echo '<a style="color:black;" id="supprimer" href="supprimer.php?id='.$row['id'].'" onclick="return confirm(\'voulez-vous supprimer '.$row['nom'].' '.$row['postnom'].' ?\');" class="btn btn-warning">Supprimer</a>'; ?></td>
					
				</tr>

			<?php } ?>
		</table>
<?php } else {
		if(isset($recherche)){

	 		echo '<p style = "color:red; text-align:center;">Aucun resultat "'.$recherche.'" </p>';
		}
  } ?>
	</div>

		</div>
			</div>
				<div class="row animate-box">
				<div class="col-md-12 text-center col-md-offset-2">
					<form class="col-md-12" method="POST" action="excel_administrateur.php">
						<input type="submit" name="export_excel" class="btn btn-succes" value="Exporter en Excel">
					</form>
					
				</div>
			</div>
		</div>
	</div>
	<style>
		table,tr,th,td{
			border: 3px solid white;
		}
	</style>
<?php
			
		}
 ?>
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

	<!-- Modal -->
<div class="modal fade" id="plus_msg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title text-center" id="exampleModalLabel">Messages</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div id="message"></div>
      </div>
      <div class="modal-body" id="plus_view">
      	<i style="color: red;">Chergement....</i>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        
      </div>
    </div>
  </div>
</div>

					<!-- Modal -->
					<div class="modal reponse fade" id="repondre" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog modal-dialog-scrollable" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h2 class="modal-title text-center" id="exampleModalLabel">Message</h2>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					        <div id="msg"></div>
					      </div>
					       <div class="modal-body" id="repondre_view">

					      	<i style="color: red;">Chergement....</i>
					     

					      </div>
					      
					      <div class="modal-footer">
					      	
					        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
					        
					      </div>
					    </div>
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

	</body>
</html>

<script type="text/javascript">
		
	$("#supprimer").click(function(){

		Swal.fire(
			  'Suppression!',
			  'Réussie!',
			  'success'
			)

	})

	</script>

<script type="text/javascript">

	//envoi du formulaire

$("#form_salaire").submit(function(e){
  e.preventDefault(); //empêcher une action par défaut
  var form_data = $(this).serialize(); //Encoder les éléments du formulaire pour la soumission
  var form_url = $(this).attr("action"); //récupérer l'URL du formulaire
  var form_method = $(this).attr("method"); //récupérer la méthode GET/POST du formulaire
  
	// console.log(form_data)
  $.ajax({
    url : "gestion_salaire.php",//récupérer l'URL où envoyer les données
    type: form_method,
    data : form_data
  }).done(function(response){ 
    $("#res").html(response);
  });
});

		
</script>

<script type="text/javascript">
// affichage
	$(document).ready(function() {
  
  $.ajax({
     url : 'affiche_salaire.php',
     type : 'POST',
     dataType : 'html',
     success : function(affichage){
         $("#affiche_salaire").html(affichage)
         // console.log(affichage) 
     }
  }); 
});
	
</script>
<script type="text/javascript">
	$("#msg").on("shown.bs.modal",function(event){
			var button = $(event.relatedTarget)
			var modal = $(this)

			var email = button.data("email")
			$.ajax({
				url:"message.php",
				method:"POST",
				data:{email:email},
				dataType:"json",
			success:function(dt){ 
			$('#message_view').html(dt.a) 
				
						}
			})



		})
</script>

<script type="text/javascript">
	$("#plus_msg").on("shown.bs.modal",function(event){
			var button = $(event.relatedTarget)
			var modal = $(this)

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
				console.log(id) 
				$.ajax({
						url:"repondre.php",
						method:"POST",
						data:{id:id},
						dataType:"html",
					success:function(repondre_view){
						$('#repondre_view').html(repondre_view)

						

						$("#form_message").submit(function(e){
						  e.preventDefault(); //empêcher une action par défaut
						  var form_data = $(this).serialize(); //Encoder les éléments du formulaire pour la soumission
						  var form_url = $(this).attr("action"); //récupérer l'URL du formulaire
						  var form_method = $(this).attr("method"); //récupérer la méthode GET/POST du formulaire
						  
							console.log(form_data)
						  $.ajax({
						    url : "envoi.php",//récupérer l'URL où envoyer les données
						    type: form_method,
						    data : form_data,
						    success:function(reception){

						    $("#msg").html(reception);
						    }
						  })
						  // .done(function(response){ 
						  // });
						});
					}
							
				})
		})
</script>
	
	