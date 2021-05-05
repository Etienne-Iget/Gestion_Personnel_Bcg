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


$bdd = new PDO('mysql:host=localhost;dbname=bcg', 'root','Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

	if (isset($_POST['id']) AND $_POST['id']>0) {
		
	
	$getid=intval($_POST['id']);


	$requser = $bdd->prepare('SELECT * FROM employe WHERE  id =?');

	$requser->execute(array($getid));

	$userinfo = $requser->fetch();
	// var_dump($userinfo);
	// exit();

	$_SESSION['photo']=$userinfo['photoEmploye'];
	$_SESSION['matricule']=$userinfo['matricule'];
 	$_SESSION['nom']=$userinfo['nomEmploye'];
	$_SESSION['genre']=$userinfo['genre'];
	$_SESSION['tel']=$userinfo['tel'];
	$_SESSION['email']=$userinfo['email'];
	$_SESSION['adresse']=$userinfo['adresse'];
	$_SESSION['departement']=$userinfo['departement'];
	$_SESSION['fonction']=$userinfo['fonction'];

	}

	$voir='';

				$voir.='
								<table style="border:0;" id="customer_data" class="table table-bordered  table-striped">

															<tr>
																<th><img src="bu.png" alt="Logo" id="logo" width="100" class=sz-image/>	REPUBLIQUE DU BURUNDI</th>
																<th id="image"><img style="align:right;" src="Employe/./'.$_SESSION['photo'].'" width="100" style class=sz-image rounded-circle/></th>
															</tr>
															<tr>
																<th text-center ">BUREAU DE CENTRALISATION GEOMATIQUE</th>
															</tr>
								</table>
					
					';

					$voir.='
								<table style="border:0;" id="customer_data" class="table table-bordered  table-striped">

												<tr style="border:0;">
													<th >'.$_SESSION['nom'].'</th>
													<th id="genre">'.$_SESSION['matricule'].'</th>
												</tr>
								</table>
												
								<table style="border:0;" id="customer_data" class="table table-bordered ">
												<tr style="border:0;">
													<th style="color:black;">Genre</th>
													<th id="salaire">'.$_SESSION['genre'].'</th>
												</tr>
												<tr style="border:0;">
													<th style="color:black;">Telephone</th>
													<th id="salaire">'.$_SESSION['tel'].'</th>
												</tr>
												<tr style="border:0;">
													<th style="color:black;">Email</th>
													<th id="salaire">'.$_SESSION['email'].'</th>
												</tr>
												<tr style="border:0;">
													<th style="color:black;">Adresse</th>
													<th id="departement" >'.$_SESSION['adresse'].'</th>
												</tr>
												<tr style="border:0;">
													<th style="color:black;">Departement</th>
													<th id="fonction">'.$_SESSION['departement'].'</th>
												</tr>
												<tr style="border:0;">
													<th style="color:black;">Fonction</th>
													<th id="fonction">'.$_SESSION['fonction'].'</th>
												</tr>
												
								</table>
										
											';


					echo $voir;
	
?>

							
