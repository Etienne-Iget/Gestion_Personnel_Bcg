<?php  
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
$bdd = new PDO('mysql:host=localhost;dbname=administration','root','Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));


	if (isset($_SESSION['id']) AND $_SESSION['id']>0) {
		
	$getid=intval($_SESSION['id']);

	

	$requser = $bdd->prepare('SELECT * FROM administrateur WHERE  id =?');
	$requser->execute(array($getid));

	$userinfo = $requser->fetch();
	$_SESSION['photo']=$userinfo['photo'];
	}
		

 



?>
<div style=" background-color: #0f983d; " class="gtco-container">
			<h1 style="color: black; text-align: center;">LISTE DES EMPLOYES</h1>
			<div style=" background-color: #0f983d; " class="row">
				
				
			</div>
			
		</div>

<?php 
	 require_once('includes/header.php');
 ?>

	<header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" style="background-image: url(images/img_bg_2.jpg)">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-left">
					

					<div class="row row-mt-15em">
						<div class="col-md-7 mt-text animate-box" data-animate-effect="fadeInUp">
										<div class="row ">
											<div class="col text-center" data-animate-effect="fadeInUp">
												<img src="bcglogo.png" alt="Logo" id="logo" />
											</div>
										</div>
						</div>
						<div class="col-md-4 col-md-push-1 animate-box" data-animate-effect="fadeInRight">
							<div class="form-wrap">
								<div class="tab">
									
									<div class="tab-content">
										<div class="tab-content-inner active" data-content="signup">
											
											<h3><i class=" fa fa-home"></i>	Tableau de Bord</h3>

																	<ul class="dropdown">
																		<?php echo '<li><a href="departement.php">Departements</a></li>'; ?>
																		<?php echo '<li><a href="employe.php">Personnel</a></li>'; ?>
																		<?php echo '<li><a href="conge.php">Congés</a></li>'; ?>
																		<?php echo '<li><a href="salaire.php">Salaires</a></li>'; ?>
																		<?php echo '<li><a href="statistique.php">Statistique</a></li>'; ?>
																
																	</ul>
											<a href="agent.php">Ajouter un employé</a>
											
										</div>
										
									</div>
								</div>
							</div>
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


	
		
<?php 
$bdd = new PDO('mysql:host=localhost;dbname=bcg','root','Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

$rech = $bdd->query('SELECT * FROM employe ORDER BY dateEnregistrement DESC LIMIT 5');


if (isset($_GET['recherche']) AND !empty($_GET['recherche'])) {
	
		$recherche= htmlspecialchars($_GET['recherche']);

		$rech = $bdd->query('SELECT * FROM employe WHERE matricule LIKE "'.$recherche.'%" ORDER BY id DESC ');

			if ($rech->rowCount()==0) {
				
				$rech = $bdd->query('SELECT * FROM employe WHERE nomEmploye LIKE "'.$recherche.'%" ORDER BY id DESC ');

				if ($rech->rowCount()==0) {
					$rech = $bdd->query('SELECT * FROM employe WHERE departement LIKE "'.$recherche.'%" ORDER BY id DESC ');


					if ($rech->rowCount()==0) {
						$rech = $bdd->query('SELECT * FROM employe WHERE fonction LIKE "'.$recherche.'%" ORDER BY id DESC ');

						if ($rech->rowCount()==0) {
							$rech = $bdd->query('SELECT * FROM employe WHERE etatService LIKE "'.$recherche.'%" ORDER BY id DESC ');

						}

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
				<h2>Les Employés</h2>
				<table id="customer_data" class="table table-bordered table-dark table-striped">
			<thead>
			
				<tr>
					<th>Id</th>
					<th>Matricule</th>
					<th>Nom</th>
					<th>Genre</th>
					<th>Adresse</th>
					<th>Téléphone</th>
					<th>Email</th>
					<th>Département</th>
					<th>Fonction</th>
					<th>Etat de Service</th>
					<th>Date d'Enregistrement</th>

				</tr>
			</thead>

				<?php 
				$id=1;
				while($row = $rech->fetch()) {  ?>
				<tr>
					<td><?php echo $id++;?></td>
					<td><?php echo $row['matricule'];?></td>
					<td><?php echo $row['nomEmploye'];?></td>
					<td><?php echo $row['genre'];?></td>
					<td><?php echo $row['adresse'];?></td>
					<td><?php echo $row['tel'];?></td>
					<td><?php echo $row['email'];?></td>
					<td><?php echo $row['departement'];?></td>
					<td><?php echo $row['fonction'];?></td>
					<td><?php echo $row['etatService'];?></td>
					<td><?php echo $row['dateEnregistrement'];?></td>
					<td><?php echo '<a style="color:black;" href="#" data-id='.$row['id'].' data-toggle="modal" data-target="#affiche" class="btn btn-primary">Afficher</a>'; ?></td>
					<td ><?php echo '<a href="modifier_employe.php?id='.$row['id'].'" class="btn btn-warning">Modifier</a>'; ?></td>
					
					
					
				</tr>

			<?php } ?>
		</table>

	</div>
		<div  class="container-fluid">
		<div class=" col-md-12 gtco-container">
			<div class="row animate-box">
				<div class="col-md-12 col-md-offset-2 text-center gtco-heading">
						
<?php } else{ 

					if(isset($recherche)){
				 	echo '<p style = "color:black;">Aucun resultat pour </p>'.$recherche;  }



				 	} ?>
				</div>
			</div>
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2">
					
				</div>
			</div>
		</div>

	</div>
			<br><br>
			<div class="row animate-box">
				<!-- <div class="col-md-2 col-md-offset-2"> -->
					<form method="POST" action="excel_employe.php">
						<input type="submit" name="export_excel" class="btn btn-succes" value="Exporter en Excel">
					</form>
				<!-- </div> -->
			</div>
</div>

		
		
	<style>
		table,tr,th,td{
			border: 3px solid white;
		}
	</style>


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

	<!-- Modal Profil-->
<div class="modal fade" id="affiche" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title text-center" id="exampleModalLabel">Profil Employé</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div id="message"></div>
      </div>
      <div class="modal-body" id="affiche_view">
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

		$("#affiche").on("shown.bs.modal",function(e){
			var button = $(e.relatedTarget)
			var modal = $(this)

			var id = button.data("id")
			$.ajax({
				url:"affiche.php",
				method:"POST",
				data:{id:id},
				dataType:"html",
				success: function(affiche){
					$("#affiche_view").html(affiche)
				}

			})



		})

	</script>