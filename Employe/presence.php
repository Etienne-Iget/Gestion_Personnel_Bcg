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
	$_SESSION['photoEmploye']=$userinfo['photoEmploye'];
	
	$nom=$_SESSION['nomEmploye'];
	$matricule=$_SESSION['matricule'];

	$mois = date("n");
	$annee=date("Y");
	

?>

<?php 
	
	$db  = new PDO('mysql:host=localhost;dbname=bcg', 'root', 'Iget1209') or die(mysql_errno());

$nbres = $db->prepare("SELECT count(*) AS nombres_activites FROM presence WHERE nomEmploye='".$nom."' AND mois_presence='".$mois."' ");
$nbres->execute();
$resultat = $nbres->fetch(PDO::FETCH_ASSOC);
$presence = $resultat['nombres_activites'];

 ?>
 <?php 
	
	$dbase  = new PDO('mysql:host=localhost;dbname=bcg', 'root', 'Iget1209') or die(mysql_errno());

$nbres = $dbase->prepare("SELECT count(*) AS nombres_activites FROM absence WHERE nomEmploye='".$nom."' AND mois_absence='".$mois."' ");
$nbres->execute();
$resultat = $nbres->fetch(PDO::FETCH_ASSOC);
$absence = $resultat['nombres_activites'];

	// var_export($presence);
	// var_export($absence);
	// var_dump($_SESSION);
	// exit();
	
		$voir='';
		$voir.='

				<table style="border:0;" id="customer_data" class="table table-bordered  table-striped">

						<tr>
							<th id="image"><img src="'.$_SESSION['photoEmploye'].'" width="100" class=sz-image/></th>
							<th><legend>Mois : '.$mois.'	Année : '.$annee.' </legend> <br><tr><th>Nom :	'.$nom.'</th><br> <th>Matricule : '.$matricule.'</th></tr></th>
						</tr>
				</table>
				<table style="border:0;" id="customer_data" class="table table-bordered ">
						<tr style="border:0;">
							<th style="color:black;">Présences	:</th>
							<th id="departement" >'.$presence.'</th>
						</tr>
						<tr style="border:0;">
							<th style="color:black;">Absences	:</th>
							<th id="fonction">'.$absence.'</th>
						</tr>
				</table>
		';

		echo $voir;
 ?>

<?php }
	}
 ?>