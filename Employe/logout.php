<?php

	session_start();

		if (!isset($_SESSION['id'], $_SESSION['nomEmploye'], $_SESSION['matricule'],  $_SESSION['email'], $_SESSION['heureConnexion']))  {
	
		header('location:../index.php');
	
}	


$bdd = new PDO('mysql:host=localhost;dbname=administration', 'root', 'Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

				$matricule = $_SESSION['matricule'];
				$nom = $_SESSION['nomEmploye'];
				
				$NewheureDeconnexion = date("d-m-Y H:i:s");
				

			$verif  = $bdd->prepare('SELECT * FROM log_employe WHERE nom = ? AND  matricule =? ORDER BY heureConnexion DESC LIMIT 1');

			$verif -> execute(array($nom,$matricule));

			$userinfo = $verif  -> fetch();
				
			if($verif  -> rowcount() == 1){

				$temps = $userinfo['heureConnexion'];

						$verif2  = $bdd->prepare('SELECT * FROM log_employe WHERE nom = ? AND  heureConnexion =?');

						$verif2 -> execute(array($nom,$temps));

						$user = $verif2  -> fetch();
				
								if($verif2  -> rowcount() == 1){

									$heureConnexion = $userinfo['heureConnexion'];

						$insert = $bdd -> prepare("UPDATE log_employe SET heureDeconnexion = ? WHERE heureConnexion = ?");
						$insert -> execute(array($NewheureDeconnexion,$heureConnexion));



							
						}
					}
							$_SESSION = array();
					
							session_destroy();
							header('location:index.php');


						
			
?>

