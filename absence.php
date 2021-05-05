<?php 
session_start();
if (!isset($_SESSION['id'] , $_SESSION['nom'])) {

	header('location:index.php');
}
 ?>

 <?php 
 		$bdd = new PDO('mysql:host=localhost;dbname=bcg', 'root', 'Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

 		if (isset($_GET['id']) AND $_GET['id']>0) {
		
	
	$getid=intval($_GET['id']);

	$requser = $bdd->prepare('SELECT * FROM employe WHERE  id =?');
	$requser->execute(array($getid));

	$userinfo = $requser->fetch();
	$_SESSION['matricule']=$userinfo['matricule'];
	$_SESSION['nomEmploye']=$userinfo['nomEmploye'];
	$_SESSION['departement']=$userinfo['departement'];


	}
 
 			$matricule = $userinfo['matricule']; 
 			$nomEmploye = $userinfo['nomEmploye']; 
 			$departement = $userinfo['departement'];	
 			$absence = "absent";	
 			$jour_absence = date("d");	
 			$mois_absence = date("m");	
 			$annee_absence = date("Y");

 			// var_export($matricule);
 			// var_export($nomEmploye);
 			// var_export($absence);
 			// var_export($departement);
 			// var_export($jour_absence);
 			// var_export($mois_absence);
 			// var_export($annee_absence);

 			// exit();

 			$verif = $bdd->prepare('SELECT * FROM presence WHERE nomEmploye = ? AND $jour_absence =? AND $mois_absence =? AND $annee_absence =?');
			$verif->execute(array($nomEmploye,$$jour_absence,$mois_absence,$annee_absence));
			$userinfo = $verif -> fetch();
				
			if($verif -> rowcount() < 1){

 			$insert=$bdd->prepare("INSERT INTO absence (matricule, nomEmploye, departement, absence, jour_absence, mois_absence, annee_absence) VALUES (:matricule,:nomEmploye,:departement,:absence,:jour_absence,:mois_absence,:annee_absence)");
 			$insert->execute(array(
 				'matricule'=>$matricule,
 				'nomEmploye'=>$nomEmploye,
 				'departement'=>$departement,
 				'absence'=>$absence,
 				'jour_absence'=>$jour_absence,
 				'mois_absence'=>$mois_absence,
 				'annee_absence'=>$annee_absence));

 			header('location:personnel.php');

 			} else{ 
		header('location:personnel.php?msg='.$row['nomEmploye'].' est absence'); 
 		}

  ?>
