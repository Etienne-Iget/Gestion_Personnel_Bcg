<?php
session_start();

// var_dump($_POST);
// exit();

$bdd = new PDO('mysql:host=localhost;dbname=bcg', 'root', 'Iget1209');

if (isset($_POST)) {
	
				$matricule = htmlspecialchars($_POST['matricule']);
				$nom = htmlspecialchars($_POST['nom']);
				$genre = htmlspecialchars($_POST['genre']);
				$departement = htmlspecialchars($_POST['departement']);			
				$fonction = htmlspecialchars($_POST['fonction']);
				$salaire = htmlspecialchars($_POST['salaire']);
				$prime_employe = htmlspecialchars($_POST['prime_employe']);
				$total = htmlspecialchars($_POST['total']);
				$mois = htmlspecialchars($_POST['mois']);
				$annee = htmlspecialchars($_POST['annee']);
			
			$testsalaire = $bdd -> prepare("SELECT id_salaire FROM salaire WHERE nom= ? AND matricule =? AND mois =? AND annee =?");
			$testsalaire -> execute(array($nom,$matricule,$mois,$annee));
				// var_dump($testsalaire -> rowCount());
				// exit();
							if ($testsalaire -> rowCount() < 1) {

									$insert = $bdd->prepare("INSERT INTO salaire (matricule, nom, genre, departement, fonction, salaire, prime_employe,total, mois, annee) VALUES( :matricule, :nom, :genre, :departement, :fonction, :salaire, :prime_employe,:total, :mois, :annee)");
									$insert->execute(array(
									'matricule'=>$matricule,
									'nom'=>$nom, 
									'genre'=>$genre, 
									'departement'=>$departement, 
									'fonction'=>$fonction, 
									'salaire'=>$salaire, 
									'prime_employe'=>$prime_employe,
									'total'=>$total, 
									'mois'=>$mois,
									'annee'=>$annee));
									// $insert->fetch();
									// var_dump($insert);
									
										echo "Enregistrement réussi";
										

							}else{
								echo "cet Enregistrement exite déjà!";
							}

}
 ?>
