
<div style=" background-color: #0f983d; " class="gtco-container">
			<h1 style="color: black; text-align: center;">PERSONNEL</h1>
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
		<div class="gtco-container h-100">

							<div class="container-fluid h-100" >
								<div class="row h-50">
									<div class="container">
										<div class="row ">
											<div class="col text-center" data-animate-effect="fadeInUp">
												<img src="bcglogo.png" alt="Logo" id="logo" />
											</div>
										</div>
										<div class="row h-100 align-items-center">
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
																	<h3>Enregistrement</h3>

																		<?php echo '<li><a href="agent.php">Employés</a></li>'; ?>
																		<form method="POST" action="excel_employe.php">
																			<input type="submit" name="export_excel" class="btn btn-succes" value="Exporter en Excel">
																		</form>
																		<?php echo '<li><a href="stagiaire.php">Stagiaires</a></li>'; ?>

																		<form method="POST" action="excel_stagiaire.php">
																			<input type="submit" name="export_excel" class="btn btn-succes" value="Exporter en Excel">
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
								</div>
							</div>
							</div>
						</header>


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