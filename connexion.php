<?php
session_start();

	
	try
{

$bdd = new PDO('mysql:host=localhost;dbname=administration', 'root', 'Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
	if (isset($_POST['Connexion'])) {

		$email = htmlspecialchars($_POST['email']);
		$password =sha1($_POST['password']);

		if (!empty($email) AND !empty($password)) {
			$verifAdmin = $bdd->prepare('SELECT * FROM administrateur WHERE email = ? AND password =?');
			$verifAdmin->execute(array($email,$password));
			$userinfo = $verifAdmin -> fetch();
				
			if($verifAdmin -> rowcount() == 1){

					$heureConnexion = date("d-m-Y H:i:s") ;

				$req= $bdd -> prepare(" INSERT INTO log_administrateur (email, password,heureConnexion) VALUES(:email, :password, :heureConnexion)");
				$req->execute(array('email'=>$email,'password'=>$password, 'heureConnexion'=>$heureConnexion));

				$_SESSION['id']=$userinfo['id'];
				$_SESSION['nom']=$userinfo['nom'];
				$_SESSION['postnom']=$userinfo['postnom'];
				$_SESSION['email']=$userinfo['email'];
				$_SESSION['password']=$userinfo['password'];
				$_SESSION['photo']=$userinfo['photo'];
				$_SESSION['logged']=time();

				header("location:personnel.php");

			}else {

				$return = "Identifiants incorects ";
				$oubli=' Mot de passe oublié cliquez<a href="#" data-toggle="modal" data-target="#email_oubli"> <i style="color: red;">Ici</i> </a>';
			?>
				
			<?php  

			}



		}else $return = " Champs manquants";
		
	}
}
catch(Exception $e){
die("erreur".$e->getMessage());

}

?>
<!DOCTYPE HTML>

<html>
	<head>
	
	<title>Connexion &mdash; Gestion du Personnel </title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/icomoon.css">
	<link rel="stylesheet" href="css/themify-icons.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/magnific-popup.css">
	<link rel="stylesheet" href="css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css">

	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="sweetalert2/dist/sweetalert2.all.js"></script>
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
						<li><a href="index.php">Accueil</a></li>
						<li class="has-dropdown">
							<a href="#">Connexion</a>
							<ul class="dropdown">
								
								<li><a style="color: black;" class="btn btn-warning" href="connexion.php">Admin</a></li>
								
								<li><a style="color: black;" class="btn btn-primary" href="Employe/index.php">Employer</a></li>
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
				<div class="col-md-12 col-md-offset-0 text-left">
					

					<div class="row row-mt-15em">
						<div class="col-md-7 mt-text animate-box" data-animate-effect="fadeInUp">
							<blockquote><img src="bcglogo.png" alt="Logo" id="logo" /></blockquote>
							<h1 >ADMINISTRATEUR</h1>	
						</div>
						<div class="col-md-4 col-md-push-1 animate-box" data-animate-effect="fadeInRight">
							<div class="form-wrap">
								<div class="tab">
									
									<div class="tab-content">
										<div class="tab-content-inner active" data-content="signup">
											<h3 id="connexion">Connexion</h3>
										<p style="color: red;"><em><?php if(isset ($_POST['Connexion']) AND isset($return)) echo $return; ?></em></p>
											<form action="#" method="POST">
												<div class="row form-group">
													<div class="col-md-12">
														<label for="fullname">Email:</label>
														<input type="email" name="email" id="fullname" class="form-control">
													</div>
												</div>
												<div class="row form-group">
													<div class="col-md-12">
														<label for="fullname">Mot de passe:</label>
														<input type="password" name="password" id="fullname" class="form-control">
													</div>
												</div>
												
												
												<div class="row form-group">
													<div class="col-md-12">
														<input type="submit" name="Connexion" class="btn btn-primary btn-block" value="Connexion"><br>
													</div>
										<p ><em><?php if(isset ($_POST['Connexion']) AND isset($oubli)) echo $oubli; ?></em></p>
												</div>
											</form>	
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

		<div  style=" background-color: #0f983d; ">
		<div class="gtco-container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
					<img src="bu.png" alt="Logo" id="logo" />
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
							<li><a href=# >Departements</a></li>													
							<li><a href="# ">Employée</a></li>														
							<li><a href="# ">Congés</a></li>
							<li><a href="# ">Salaires</a></li>
							<li><a href="# ">Statistiques</a></li>
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

<!-- modal email -->
<div class="modal fade" id="email_oubli" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Verification du Compte</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="alert">
       
          <i style="color: red;">Chergement	<i class=" fa fa-spin fa-spinner"></i></i>
      <div class="modal-footer">
         
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
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
<script type="text/javascript">
	$('#email_oubli').on('show.bs.modal',function(e){
		var button = e.relatedTarget;
		var modal = $(this);
		 $.ajax({
			    url : "email.php",
			   	method:"GET",
				dataType:"html",
		}).then(function(data){
			modal.find('#alert').html(data)

					
		})

	})

	$(document).on("click","#Vérifier",function(e){
			 e.preventDefault(); //empêcher une action par défaut
			 var button = $(this)
			 button.find("span").show();
			var email_verif =$("#email_verif").val().trim()

			  $.ajax({
			    url : "email_verif.php",
			   	method:"POST",
				data:{email_verif:email_verif},
				dataType:"json",
				success: function(datas){
					 
					 	if (datas.err) {
								Swal.fire(
								  datas.err,
								  'Echec!',
								  "error"
								)
								button.find("span").hide();
							}else{
							 $("#alert").html(datas.view);
						}



					 $("#form_message").submit(function(e){
						  e.preventDefault(); //empêcher une action par défaut
						  var form_data = $(this).serialize(); //Encoder les éléments du formulaire pour la soumission
						  var form_url = $(this).attr("action"); //récupérer l'URL du formulaire
						  var form_method = $(this).attr("method"); //récupérer la méthode GET/POST du formulaire

						  $("#envoyer").find("span").show();
						  
							console.log(form_data)
						  $.ajax({
						    url : "password_change.php",//récupérer l'URL où envoyer les données
						    type: form_method,
						    data : form_data,
						    dataType:'json',
						    success:function(datas){
						    	$("#envoyer").find("span").hide();
						    	if (datas.err) {
						    		Swal.fire(
									  datas.err,
									  'Echec!',
									  "error"
									)
						    		}else{
						    			Swal.fire(
										  datas.view,
										  'Success!',
										  "success"
										)
										$('.swal2-confirm').click(function(){
											$('#email_oubli').modal('hide')
										})
						    		}
						  
						    

						    }
						  })
						 
						});
					 
					}
			  })
		})


</script>
