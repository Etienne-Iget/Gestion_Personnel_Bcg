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



$bdd = new PDO('mysql:host=localhost;dbname=administration', 'root', 'Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

	if (isset($_POST)) {

			$Dev_Produit_Cartographiques=$_POST['dpc'];
			$Systeme_Gestion_Donnees=$_POST['sgd'];
			$Suivievaluation_Controle_Qualite=$_POST['scq'];
			$Catalogage_Document=$_POST['cd'];
			$prime=$_POST['pa'];

	$id_gs='1';
		
	
		$requser = $bdd->prepare('SELECT * FROM gestion_salaire WHERE id_gs = ?');
		$requser->execute(array($id_gs));


		$user = $requser->fetch();

		if (isset($Dev_Produit_Cartographiques) AND !empty($Dev_Produit_Cartographiques) And $Dev_Produit_Cartographiques!=$user['Dev_Produit_Cartographiques']) {

			$insertsalaire=$bdd->prepare("UPDATE gestion_salaire SET Dev_Produit_Cartographiques = ? WHERE id_gs = ?");
			$insertsalaire->execute(array($Dev_Produit_Cartographiques,$id_gs));

			
		}
		if (isset($Systeme_Gestion_Donnees) AND !empty($Systeme_Gestion_Donnees) And $Systeme_Gestion_Donnees!=$user['Systeme_Gestion_Donnees']) {

			$insertsalaire=$bdd->prepare("UPDATE gestion_salaire SET Systeme_Gestion_Donnees = ? WHERE id_gs = ?");
			$insertsalaire->execute(array($Systeme_Gestion_Donnees,$id_gs));

			
		}


		if (isset($Suivievaluation_Controle_Qualite) AND !empty($Suivievaluation_Controle_Qualite) And $Suivievaluation_Controle_Qualite!=$user['Suivievaluation_Controle_Qualite']) {

			$insertsalaire=$bdd->prepare("UPDATE gestion_salaire SET Suivievaluation_Controle_Qualite = ? WHERE id_gs = ?");
			$insertsalaire->execute(array($Suivievaluation_Controle_Qualite,$id_gs));

			
		}


		if (isset($Catalogage_Document) AND !empty($Catalogage_Document) And $Catalogage_Document!=$user['Catalogage_Document']) {

			$insertsalaire=$bdd->prepare("UPDATE gestion_salaire SET Catalogage_Document = ? WHERE id_gs = ?");
			$insertsalaire->execute(array($Catalogage_Document,$id_gs));

			
		}
		if (isset($prime) AND !empty($prime) And $prime!=$user['prime']) {

			$insertsalaire=$bdd->prepare("UPDATE gestion_salaire SET prime = ? WHERE id_gs = ?");
			$insertsalaire->execute(array($prime,$id_gs));

			
		}

		echo "Enregistrement réussi";
	
	} else{
		
		echo "Aucune entrée";

		header('location:accueil.php');
	}
?>
