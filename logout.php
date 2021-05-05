
<?php
	session_start();

	if (!isset($_SESSION['id'], $_SESSION['nom'], $_SESSION['email'], $_SESSION['password'])) {

	header('location:index.php');
		
	}
?>

<?php


	$bdd = new PDO('mysql:host=localhost;dbname=administration', 'root', 'Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

			

				$email=$_SESSION['email'];
				$password=$_SESSION['password'];
				
				$NewheureDeconnexion = date("d-m-Y H:i:s");
				

			$verif  = $bdd->prepare('SELECT * FROM log_administrateur WHERE email = ? AND  password =? ORDER BY heureConnexion DESC LIMIT 1');

			$verif -> execute(array($email,$password));

			$userinfo = $verif  -> fetch();
				
			if($verif  -> rowcount() == 1){

				$temps = $userinfo['heureConnexion'];

						$verif2  = $bdd->prepare('SELECT * FROM log_administrateur WHERE email = ? AND  heureConnexion =?');

						$verif2 -> execute(array($email,$temps));

						$user = $verif2  -> fetch();
				
								if($verif2  -> rowcount() == 1){

									$heureConnexion = $userinfo['heureConnexion'];

						$insert = $bdd -> prepare("UPDATE log_administrateur SET heureDeconnexion = ? WHERE heureConnexion = ?");
						$insert -> execute(array($NewheureDeconnexion,$heureConnexion));



							
						}
					}
							$_SESSION = array();
							session_destroy();
							header('location:connexion.php');


?>