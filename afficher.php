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


$bdd = new PDO('mysql:host=localhost;dbname=administration', 'root','Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

	if (isset($_POST['id']) AND $_POST['id']>0) {
		
	
	$getid=intval($_POST['id']);

	$requser = $bdd->prepare('SELECT * FROM administrateur WHERE  id =?');

	$requser->execute(array($getid));

	$userinfo = $requser->fetch();
	$_SESSION['photo']=$userinfo['photo'];
 	$_SESSION['nom']=$userinfo['nom'];
	$_SESSION['postnom']=$userinfo['postnom'];
	$_SESSION['prenom']=$userinfo['prenom'];
	$_SESSION['genre']=$userinfo['genre'];
	$_SESSION['adress']=$userinfo['adress'];
	$_SESSION['fonction']=$userinfo['fonction'];
	$_SESSION['email']=$userinfo['email'];

	}

	$voir='';

				$voir.='
								<table style="border:0;" id="customer_data" class="table table-bordered  table-striped">

															<tr>
																<th><img src="bu.png" alt="Logo" id="logo" width="100" class=sz-image/>	REPUBLIQUE DU BURUNDI</th>
																<th id="image"><img style="align:right;" src="./Admin/'.$_SESSION['photo'].'" width="100" style class=sz-image/></th>
															</tr>
															<tr>
																<th text-center ">BUREAU DE CENTRALISATION GEOMATIQUE</th>
															</tr>
								</table>
					
					';

					$voir.='
								<table style="border:0;" id="customer_data" class="table table-bordered  table-striped">

												<tr style="border:0;">
													<th >'.$_SESSION['nom'].'	'.$_SESSION['postnom'].'	'.$_SESSION['prenom'].'</th>
													<th id="genre">'.$_SESSION['genre'].'</th>
												</tr>
								</table>
												
								<table style="border:0;" id="customer_data" class="table table-bordered ">
												<tr style="border:0;">
													<th style="color:black;">Email</th>
													<th id="salaire">'.$_SESSION['email'].'</th>
												</tr>
												<tr style="border:0;">
													<th style="color:black;">Adresse</th>
													<th id="departement" >'.$_SESSION['adress'].'</th>
												</tr>
												<tr style="border:0;">
													<th style="color:black;">Fonction</th>
													<th id="fonction">'.$_SESSION['fonction'].'</th>
												</tr>
												
								</table>
										
											';


					echo $voir;
	
?>

							

								
											
						
