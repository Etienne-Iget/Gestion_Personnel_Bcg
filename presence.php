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
 			$presence = "Present";	
 			$jour_presence = date("j");	
 			$mois_presence = date("n");	
 			$annee_presence = date("Y");
 			$temps_arrive=date('H:i:s');


			$verif = $bdd->prepare('SELECT * FROM presence WHERE nomEmploye = ? AND jour_presence =? ');
			$verif->execute(array($nomEmploye,$jour_presence));

			$userinfo = $verif -> fetch();
				
			if($verif -> rowcount() < 1){

 			$insert=$bdd->prepare("INSERT INTO presence (matricule, nomEmploye, departement, presence, jour_presence, mois_presence, annee_presence,temps_arrive) VALUES (:matricule,:nomEmploye,:departement,:presence,:jour_presence,:mois_presence,:annee_presence,:temps_arrive)");
 			$insert->execute(array(
 				'matricule'=>$matricule,
 				'nomEmploye'=>$nomEmploye,
 				'departement'=>$departement,
 				'presence'=>$presence,
 				'jour_presence'=>$jour_presence,
 				'mois_presence'=>$mois_presence,
 				'annee_presence'=>$annee_presence,
 				'temps_arrive'=>$temps_arrive));

 			header('location:personnel.php');
			

} else{ 
		header("location:personnel.php?msg=Present"); 
 		}
  ?>
