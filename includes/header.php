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

if (!isset($_SESSION['id'], $_SESSION['password'],$_SESSION['photo'])) {

		header('location:connexion.php');
	}
 // var_export($_SESSION);
	// exit();
?>
		

<?php

$bdd = new PDO('mysql:host=localhost;dbname=administration', 'root', 'Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

if (isset($_SESSION['id'])) {

	if (isset($_SESSION['id']) AND $_SESSION['id']>0) {
		
		$getid=intval($_SESSION['id']);

		$requser = $bdd->prepare('SELECT * FROM administrateur WHERE  id =?');
		$requser->execute(array($getid));

		$userinfo = $requser->fetch();
		$_SESSION['photo']=$userinfo['photo'];
		$_SESSION['password']=$userinfo['password'];
		
	}
}


?>

<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	
	<title>BCG &mdash; Gestion du Personnel </title>
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
				    <form class="form-inline " action="" method="GET">
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

												<a href="#" data-id="<?=$_SESSION['id']?>" data-toggle="modal" data-target="#afficher"><img title="Profil Employe" src="<?='Admin/'.$_SESSION['photo']?>"width="70%" class="d-block img-thumbnail  rounded-circle" /></a>

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

	</body>
</html>

<script type="text/javascript">

		$("#afficher").on("shown.bs.modal",function(e){
			var button = $(e.relatedTarget)
			var modal = $(this)

			var id = button.data("id")
			$.ajax({
				url:"./afficher.php",
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