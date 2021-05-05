
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

$bdd = new PDO('mysql:host=localhost;dbname=bcg', 'root', 'Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

	if (isset($_GET['id'])) {

		$requser = $bdd->prepare('SELECT * FROM employe WHERE  id =?');
		$requser->execute(array($_GET['id']));

		$user = $requser->fetch();

		if (isset($_POST['nomNew']) AND !empty($_POST['nomNew']) And $_POST['nomNew']!=$user['nomEmploye']) {

			$nomNew=htmlspecialchars($_POST['nomNew']);
			$insertnom=$bdd->prepare("UPDATE employe SET nomEmploye = ? WHERE id = ?");
			$insertnom->execute(array($nomNew,$_GET['id']));

			header('location:modifier_employe.php?id='.$_GET['id']);
		}

		if (isset($_POST['telNew']) AND !empty($_POST['telNew']) And $_POST['telNew']!=$user['tel']) {

			$telNew=htmlspecialchars($_POST['telNew']);
			$insertpostnom=$bdd->prepare("UPDATE employe SET tel = ? WHERE id = ?");
			$insertpostnom->execute(array($telNew,$_GET['id']));

			header('location:information.php');
		}

		

		if (isset($_POST['adressNew']) AND !empty($_POST['adressNew']) And $_POST['adressNew']!=$user['adresse']) {

			$adressNew=htmlspecialchars($_POST['adressNew']);
			$insertfonction=$bdd->prepare("UPDATE employe SET adresse = ? WHERE id = ?");
			$insertfonction->execute(array($adressNew,$_GET['id']));

			header('location:modifier_employe.php?id='.$_GET['id']);
		}

if (isset($_POST['passwordNew']) AND !empty($_POST['passwordNew']) AND isset($_POST['confirmationNew']) AND !empty($_POST['confirmationNew']) And $_POST['passwordNew']!=$user['password']) {


			$passwordNew=sha1($_POST['passwordNew']);
			$confirmationNew=sha1($_POST['confirmationNew']);

			if ($passwordNew==$confirmationNew) {
				
			$insertpassword=$bdd->prepare("UPDATE employe SET password = ? WHERE id = ?");
			$insertpassword->execute(array($passwordNew,$_SESSION['id']));


			header('location:logout.php');

			}else $return = "Mots de passe non identique";

		}

	if (isset($_FILES['photoEmploye']) And !empty($_FILES['photoEmploye'])) {

			$tailleMax=2097152;
			$extensionsValides =array('jpg','jpeg','gif','png');
			
			if ($_FILES['photoEmploye']['size']<=$tailleMax) {

				$extensionUpload = strtolower(substr(strrchr($_FILES['photoEmploye']['name'], '.'), 1));

					if (in_array($extensionUpload, $extensionsValides)) {

							$chemin = "Employe/Photo/".$_GET['id'].".".$extensionUpload;
						$resultat = move_uploaded_file($_FILES['photoEmploye']['tmp_name'], $chemin);

						if ($resultat) {
							$insertphoto=$bdd->prepare('UPDATE employe SET photoEmploye = :photoEmploye WHERE id=:id');
							$insertphoto->execute(array( 
								'photoEmploye'=>$chemin,
								'id' => $_GET['id']
							));


							header('location:information.php');

						}else $return = "Erreur de chargement de la photo";
						
					}else $return = "Format non pris en charge";
				
			} else $return = "Photo ne doit pas être > 2Mb";
			
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
	<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css">
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
						<li><i class=" fa fa-home"></i><a href="information.php" >Accueil</a></li>
						<?php echo '<li><a href="#" data-id="'.$_SESSION['id'].'"  data-toggle="modal" data-target="#afficher">Profil</a></li>'; ?>
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
                        
						</div>
						
						<div class="row form-group">
							<div class="col-md-12">
								<label for="fullname">Photo :</label>
								<input type="file"  name="photoEmploye" id="name" class="form-control" placeholder="Photo de profile">
							</div>
						</div>
						
						<div class="form-group">
							<input type="submit" name="modifier" value="Modifier" class="btn btn-primary">
						</div>
					</form>	
										</div>
										<p style="color: red;"><em><?php if(isset ($_POST['modifier']) AND isset($return)) echo $return; ?></em></p>
										
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
      	....
      </div>
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