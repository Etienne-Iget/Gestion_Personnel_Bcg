
<div style=" background-color: #0f983d; " class="gtco-container">
			<h1 style="color: black; text-align: center;">GESTION DE SALAIRE</h1>
			<div style=" background-color: #0f983d; " class="row">
				
				
			</div>
			
		</div>
<?php 
	 require_once('includes/header.php');
 ?>
<div class="gtco-loader"></div>

	
	<div >

	
	<header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" style="background-image: url(images/img_bg_2.jpg)">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-left">
					

					<div class="row row-mt-15em">
						<div class="col-md-7 mt-text animate-box" data-animate-effect="fadeInUp">
							<blockquote><img src="bcglogo.png" alt="Logo" id="logo" /></blockquote>
							<h1>SALAIRE</h1>	
						</div>
						<div class="col-md-4 col-md-push-1 animate-box" data-animate-effect="fadeInRight">
							<div class="form-wrap">
								<div class="tab">
									
									<div class="tab-content">
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

	<!-- Button trigger modal -->


			
				<!-- <div class="col-md-8 col-md-offset-2 text-center gtco-heading"> -->
					
	
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
				<h2>Salariés</h2>
				<table id="customer_data" class="table table-bordered table-dark  table-striped">
			<thead>
			
				<tr>
					
					<th>Matricule</th>
					<th>Nom</th>
					<th>Département</th>
					<th>Fonction</th>
					<th>Etat de Service</th>

				</tr>
			</thead>
				<?php 
				
				while($row = $rech->fetch()) {  ?>
				<tr>
					
					<td><?php echo $row['matricule'];?></td>
					<td><?php echo $row['nomEmploye'];?></td>	
					<td><?php echo $row['departement'];?></td>
					<td><?php echo $row['fonction'];?></td>
					<td><?php echo $row['etatService'];?></td>
					<td><?php echo '<a  style="color:black;" data-id="'.$row['id'].'" class="btn btn-primary" data-toggle="modal" data-target="#prime">Payement</a>'; ?></td>
					
				</tr>
		<!-- 		<button type="button"  class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->


			<?php } ?>
		</table>

						

									<?php } else{ 
										if(isset($recherche)){
				 							echo "Aucun resulstat pour la recherche :	".$recherche;  }


				 							} ?>
				 			

	<?php } ?>

</div>
</div>
</div>
	<style>
		table,tr,th,td{
			border: 3px solid black;
		}
	</style>

	<?php 
$bdd2 = new PDO('mysql:host=localhost;dbname=bcg', 'root', 'Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

$rech2 = $bdd2->query('SELECT * FROM departement ORDER BY dateAjout DESC LIMIT 5');


if (isset($_GET['recherche']) AND !empty($_GET['recherche'])) {
	
		$recherche= htmlspecialchars($_GET['recherche']);
		

		$rech2 = $bdd->query('SELECT * FROM departement WHERE nomEmploye LIKE "%'.$recherche.'%" ORDER BY id_departement DESC ');

			if ($rech2->rowCount()==0) {
				
				$rech2 = $bdd->query('SELECT * FROM departement WHERE departement LIKE "%'.$recherche.'%" ORDER BY id_departement DESC ');

				if ($rech2->rowCount()==0) {
					$rech2 = $bdd->query('SELECT * FROM departement WHERE fonction LIKE "'.$recherche.'%" ORDER BY id_departement DESC ');



				}
			}


 ?>


<?php if ($rech2->rowCount() > 0) {
	
?>
<div  class="container box">
				<div class="col-md-12 col-md-offset-3 text-center gtco-heading">
			
			<div class=" col-md-12 table-responsive">
			
				<table id="customer_data" class="table table-bordered table-dark  table-striped">
			<thead>
			
				<tr>
					<th>N°</th>
					<th>Nom</th>
					<th>Département</th>
					<th>Fonction</th>
					<th>Activité</th>
					<th>Observation</th>

				</tr>
			</thead>
				<?php 
				$id=1;
				while($row2 = $rech2->fetch()) {  ?>
				<tr>
					<td><?php echo $id++;?></td>
					<td><?php echo $row2['nomEmploye'];?></td>	
					<td><?php echo $row2['departement'];?></td>
					<td><?php echo $row2['fonction'];?></td>
					<td><?php echo $row2['activite'];?></td>
					<td><?php echo $row2['observation'];?></td>
					
		
					
				</tr>

			<?php } ?>
		</table>

						
</div>
</div>
</div>
									<?php } else{ 
										if(isset($recherche)){
				 							echo '<p style="color: #14d2e3; text-align:center;">Aucune activité réalisée par  '.$recherche.'; O Fbu comme Prime</p>';  }


				 							} ?>
				 			

	<?php } ?>
	<style>
		table,tr,th,td{
			border: 3px solid black;
		}
	</style>

	<div class="gtco-container">
		<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
			<div class="row row-p	b-md">


 <!-- Modal -->
<div class="modal fade" id="prime" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title text-center" id="exampleModalLabel">Fiche de paie</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div id="message"></div>
      </div>
      <div class="modal-body" id="prime_view">
      	....
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="button" id="enregister" class="btn btn-primary">Enregistrer</button>
      </div>
    </div>
  </div>
</div>


			</div>
		</div>
	</div>

					
					
								<?php 
$bdd = new PDO('mysql:host=localhost;dbname=bcg', 'root', 'Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

$rech = $bdd->query('SELECT * FROM salaire ORDER BY id_salaire ASC LIMIT 5');


if (isset($_GET['recherche']) AND !empty($_GET['recherche'])) {
	
		$recherche= htmlspecialchars($_GET['recherche']);

		$rech = $bdd->query('SELECT * FROM salaire WHERE nom LIKE "%'.$recherche.'%" ORDER BY id_salaire DESC ');

			if ($rech->rowCount()==0) {
				

		
			}

}
 ?>
  
<?php if ($rech->rowCount() > 0) {
	
?>
<div  class="container box">
				<div class="col-md-12 col-md-offset-3 text-center gtco-heading">
			
			<div class=" col-md-12 table-responsive">
				<h2>Paiements Effectués</h2>
				<table id="customer_data" class="table table-bordered table-dark  table-striped">
			<thead>
			
				<tr>
					<th>N°</th>
					<th>Matricule</th>
					<th>Nom</th>
					<th>Departement</th>
					<th>Salaire</th>
					<th>Prime</th>
					<th>Total</th>
					<th>Mois</th>
					

				</tr>
			</thead>
				<?php 
				$id=1;

				while($row = $rech->fetch()) { ?>
				<tr>
					<td><?php echo $id++;?></td>
					<td><?php echo $row['matricule'];?></td>
					<td><?php echo $row['nom'];?></td>
					<td><?php echo $row['departement'];?></td>
					<td><?php echo $row['salaire'];?></td>
					<td><?php echo $row['prime_employe'];?></td>
					<td><?php echo $row['total'];?></td>
					<td><?php echo $row['mois'];?></td>
					
				</tr>

			<?php } ?>
		</table>
<?php } else {
		if(isset($recherche)){

	 		echo '<p style = "color:black;">Aucun resultat</p>'.$recherche; 
		}
  } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

 <?php 

	 require_once('includes/footer.php');

  ?>
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

	<script type="text/javascript">
		// $("#prime_modal").modal("show")
		$("#prime").on("shown.bs.modal",function(e){
			var button = $(e.relatedTarget)
			var modal = $(this)

			var id = button.data("id")
			$.ajax({
				url:"prime.php",
				method:"POST",
				data:{id:id},
				dataType:"html",
				success: function(prime){
					$("#prime_view").html(prime)
						var matricule=$("#matricule").html()
						var nom=$("#nom").html()
						var genre=$("#genre").html()
						var mois=$("#mois").html()
						var annee=$("#annee").html()
						var departement=$("#departement").html()
						var fonction=$("#fonction").html()
						var salaire=$("#salaire").html()
						var prime_employe=$("#prime_employe").html()
						var total=$("#total").html()

								// console.log(photo)
							$(document).on("click","#enregister",function(e){
								$.ajax({
									url:"payement.php",
									method:"POST",
									data:{matricule:matricule,nom:nom,genre:genre,mois:mois,annee:annee,departement:departement,fonction:fonction,salaire:salaire,prime_employe:prime_employe,total:total},
									dataType:"html",
									success:function(paiement){
										$("#message").html(paiement)

										
									}
								})
							})
				}
			})



		})

	</script>