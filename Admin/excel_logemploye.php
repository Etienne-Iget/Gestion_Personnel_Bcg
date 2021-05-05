<?php
session_start();
if (!isset($_SESSION['idAdmin'], $_SESSION['nomAdmin'],$_SESSION['postnomAdmin'],$_SESSION['emailAdmin'] )) {
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

	$bd = new PDO('mysql:host=localhost;dbname=administration', 'root', 'Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

	$nomE=$userinfo['nomEmploye'];
	$matriculeE=$userinfo['matricule'];



	$verif  = $bd->prepare('SELECT * FROM log_employe WHERE  matricule = ? AND nom = ?');

			$verif -> execute(array($matriculeE, $nomE));

			if ($user = $verif -> fetch()) {
	


			// echo "<pre>";
			// 	print_r($verif);


		// var_export($nom);
		// var_export($matricule);
		// exit();

?>


<?php 
		$connect=mysqli_connect("localhost","root","Iget1209","administration");
		$output='';
		$date	=	date("d-m-Y	H:i:s");

		$nom=$user['nom'];
		$matricule=$user['matricule'];

		if (isset($_POST['export_excel'])) {

			$sql="SELECT * FROM log_employe WHERE matricule = '".$matricule."' ";

			$resultat=mysqli_query($connect, $sql);

			if (mysqli_num_rows($resultat)>0) {
				
				$output .=' 
				<table>
				<tr> <strong>'.$date.'  </strong></tr>
				<tr>  <strong>les logs de '.$nom.' </strong></tr>
				</table>
				';

				$output .='

		<table  class="table" style="color: black;" bordered="1">
			


				<tr>
					<th>Id</th>
					<th>Matricule</th>
					<th>Nom</th>
					<th>Email</th>
					<th>Temps de la connexion</th>
					<th>Temps de la deconnexion</th>

				</tr>

				';

				$id=1;

				while($row =mysqli_fetch_array($resultat)) {


					$output .='

				<tr>
					<td> ' .$id++. ' </td>
					<td> ' .$row['matricule']. ' </td>
					<td> ' .$row['nom']. ' </td>
					<td> ' .$row['email']. ' </td>
					<td> ' .$row['heureConnexion']. ' </td>
					<td> ' .$row['heureDeconnexion']. ' </td>


				</tr>

					';
				}

				$output .='</table>'; 
				header("Content-Type: application/xls");
				header("Content-Disposition: attachment; filename=Logs de ".$nom." ".$date.".xls ");

				echo $output;
			}
		}





 ?>

<?php 
		}
	}
 ?>
		