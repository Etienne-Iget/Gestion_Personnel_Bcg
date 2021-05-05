<?php
session_start(); 

if (isset($_POST['id']) ) {

	$getid=$_POST['id'];
	// var_export($getid);
	// exit();
			
		if ($_POST['id']==$getid){

			?>
<?php


$bdd = new PDO('mysql:host=localhost;dbname=bcg', 'root','Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

	$requser = $bdd->prepare('SELECT * FROM employe WHERE  id =?');

	$requser->execute(array($getid));

	$userinfo = $requser->fetch();

	$_SESSION['matricule']=$userinfo['matricule'];
	$_SESSION['nomEmploye']=$userinfo['nomEmploye'];
	$_SESSION['genre']=$userinfo['genre'];
	$_SESSION['fonction']=$userinfo['fonction'];
	$_SESSION['departement']=$userinfo['departement'];
	$_SESSION['photoEmploye']=$userinfo['photoEmploye'];

	$nom=$_SESSION['nomEmploye'];
	// var_export($_SESSION);

?>

<?php


$bdd = new PDO('mysql:host=localhost;dbname=administration', 'root','Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
	
	$id_gs='1';

	$requser = $bdd->prepare('SELECT * FROM gestion_salaire WHERE  id_gs =?');

	$requser->execute(array($id_gs));

	$info = $requser->fetch();

	$_SESSION['Dev_Produit_Cartographiques']=$info['Dev_Produit_Cartographiques'];
	$_SESSION['Systeme_Gestion_Donnees']=$info['Systeme_Gestion_Donnees'];
	$_SESSION['Suivievaluation_Controle_Qualite']=$info['Suivievaluation_Controle_Qualite'];
	$_SESSION['Catalogage_Document']=$info['Catalogage_Document'];
	$_SESSION['prime']=$info['prime'];

	$dpv=$_SESSION['Dev_Produit_Cartographiques'];
	$sgd=$_SESSION['Systeme_Gestion_Donnees'];
	$scq=$_SESSION['Suivievaluation_Controle_Qualite'];
	$cd=$_SESSION['Catalogage_Document'];
	$pa=$_SESSION['prime'];

	if ($_SESSION['departement']=='Dev_Produit_Cartographiques') {
		$sal=$dpv;
	}
	if ($_SESSION['departement']=='Systeme_Gestion_Donnees') {
		$sal=$sgd;
	}
	if ($_SESSION['departement']=='Suivievaluation_Controle_Qualite') {
		$sal=$scq;
	}
	if ($_SESSION['departement']=='Catalogage_Document') {
		$sal=$cd;
	}

?>

       <?php

	$db  = new PDO('mysql:host=localhost;dbname=bcg', 'root', 'Iget1209') or die(mysql_errno());

$nbres = $db->prepare("SELECT count(*) AS nombres_activites FROM departement WHERE nomEmploye='".$nom."'");
$nbres->execute();
$resultat = $nbres->fetch(PDO::FETCH_ASSOC);
$activites = $resultat['nombres_activites'];

// var_export($activites);

// 	exit();
	
		if ($activites > 0) {

			$mois=date("n");
			$annee=date("Y");
			$salaire=$sal;
			$prime = $activites*$pa;
			$matriculeE = $_SESSION['matricule'];
			$nomE = $_SESSION['nomEmploye'];
			$genreE = $_SESSION['genre'];
			$fonctionE = $_SESSION['fonction'];
			$departementE = $_SESSION['departement'];
			$total=$salaire+$prime;

				$voir='';

				$voir.='
								<table style="border:0;" id="customer_data" class="table table-bordered table-responsive-lg table-striped">

															<tr>
																<th id="image"><img src="'.$_SESSION['photoEmploye'].'" width="100" class="sz-image" /></th>
																<th><legend>Mois : '.$mois.'	Année : '.$annee.' </legend> <br><br> Matricule : '.$matriculeE.'</th>
															</tr>
								</table>
					
					';

					$voir.='
								<table style="border:0;" id="customer_data" class="table table-bordered table-responsive-lg table-striped">

												<tr style="border:0;">
													<th id="nom">'.$nomE.'</th>
													<th id="genre">'.$genreE.'</th>
												</tr>
								</table>
												
								<table style="border:0;" id="customer_data" class="table table-bordered table-responsive-lg">
												<tr style="border:0;">
													<th style="color:black;">Departement</th>
													<th id="departement" >'.$departementE.'</th>
												</tr>
												<tr style="border:0;">
													<th style="color:black;">Fonction</th>
													<th id="fonction">'.$fonctionE.'</th>
												</tr>
												<tr style="border:0;">
													<th style="color:black;">Salaire</th>
													<th id="salaire">'.$salaire.'	Fbu</th>
												</tr>
												<tr style="border:0;">
													<th style="color:black;">Prime</th>
													<th id="prime_employe">'.$prime.'	Fbu</th>
												</tr>
												<tr style="border:0;">
													<th style="color:red; font-weight: bold;">TOTAL</th>
													<th style="color:red; font-weight: bold;" id="total">'.$total.'	Fbu</th>
												</tr>
								</table>
										<p hidden id="mois">'.$mois.'<p/>
										<p hidden id="annee">'.$annee.'<p/>
										<p hidden id="matricule">'.$matriculeE.'<p/>
											';


					echo $voir;

		}elseif ($activites <= 0) {

					$mois=date("n");
					$annee=date("Y");
					$salaire=$sal;
					$prime = 0*$pa;
					$matriculeE = $_SESSION['matricule'];
					$nomE = $_SESSION['nomEmploye'];
					$genreE = $_SESSION['genre'];
					$fonctionE = $_SESSION['fonction'];
					$departementE = $_SESSION['departement'];
					$total=$salaire+$prime;

					$voir='';
					$voir.='
								<table style="border:0;" id="customer_data" class="table table-bordered  table-striped">

															<tr>
																<th id="image"><img src="'.$_SESSION['photoEmploye'].'" width="150" class=sz-image/></th>
																<th><legend>Mois : '.$mois.'	Année : '.$annee.' </legend> <br><br> Matricule : '.$matriculeE.'</th>
															</tr>
								</table>
					
					';

					$voir.='
								<table style="border:0;" id="customer_data" class="table table-bordered  table-striped">

												<tr style="border:0;">
													<th id="nom">'.$nomE.'</th>
													<th id="genre">'.$genreE.'</th>
												</tr>
								</table>
												
								<table style="border:0;" id="customer_data" class="table table-bordered ">
												<tr style="border:0;">
													<th style="color:black;">Departement</th>
													<th id="departement" >'.$departementE.'</th>
												</tr>
												<tr style="border:0;">
													<th style="color:black;">Fonction</th>
													<th id="fonction">'.$fonctionE.'</th>
												</tr>
												<tr style="border:0;">
													<th style="color:black;">Salaire</th>
													<th id="salaire">'.$salaire.'	Fbu</th>
												</tr>
												<tr style="border:0;">
													<th style="color:black;">Prime</th>
													<th id="prime_employe">'.$prime.'	Fbu</th>
												</tr>
												<tr style="border:0;">
													<th style="color:red; font-weight: bold;">TOTAL</th>
													<th style="color:red; font-weight: bold;" id="total">'.$total.'	Fbu</th>
												</tr>
								</table>
										<p hidden id="mois">'.$mois.'<p/>
										<p hidden id="annee">'.$annee.'<p/>
										<p hidden id="matricule">'.$matriculeE.'<p/>
											';

					echo $voir;
			
			}
	

 ?>
 	<?php

		}

 }
?>
<form action="impression_pdf.php" method="POST">
	<input type="hidden" name="photo" value="<?=$_SESSION['photoEmploye']?>">
	<input type="hidden" name="mois" value="<?=$mois?>">
	<input type="hidden" name="annee" value="<?=$annee?>">
	<input type="hidden" name="matricule" value="<?=$matriculeE?>">
	<input type="hidden" name="nom" value="<?=$nomE?>">
	<input type="hidden" name="genre" value="<?=$genreE?>">
	<input type="hidden" name="departement" value="<?=$departementE?>">
	<input type="hidden" name="fonction" value="<?=$fonctionE?>">
	<input type="hidden" name="salaire" value="<?=$salaire?>">
	<input type="hidden" name="prime" value="<?=$prime?>">
	<input type="hidden" name="total" value="<?=$total?>">

	<button type="submit" class="btn btn-primary">Imprimer</button>
</form>
