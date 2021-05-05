<?php
session_start();
if (!isset($_SESSION['idAdmin'], $_SESSION['nomAdmin'],$_SESSION['postnomAdmin'],$_SESSION['emailAdmin'] )) {
	header('location:index.php');
}


?>


<?php 
		$connect=mysqli_connect("localhost","root","Iget1209","bcg");
		$output='';
		$date	=	date("d-m-Y	H:i:s");

		if (isset($_POST['export_excel'])) {
			$sql="SELECT * FROM stagiaire ORDER BY 	dateEnregistrement DESC";
			$resultat=mysqli_query($connect, $sql);
			if (mysqli_num_rows($resultat)>0) {
				
				$output .=' 
				<table>
				<tr><strong>Direction</strong></tr>
				<th>  <strong>liste des Stagiaires </strong></th>
				<th> <strong>'.$date.'  </strong></th>
				</table><br>
				';

				$output .='

		<table  class="table" style="color: black;" bordered="1">
			


				<tr>
					<th>Id</th>
					<th>Nom</th>
					<th>Post-nom</th>
					<th>Prenom</th>
					<th>Genre</th>
					<th>Universite</th>
					<th>Sujet</th>
					<th>Encadreur</th>
					<th>Superviseur</th>
					<th>Editeur</th>
					<th>PromotionStage</th>
					<th>Debut Stage</th>
					<th>Fin Stage</th>
					<th>Duree</th>

				</tr>

				';

				$id=1;

				while($row =mysqli_fetch_array($resultat)) {


					$output .='

				<tr>
					
					<td> ' .$id++. '</td>
					<td> ' .$row['nomStagiaire']. '</td>
					<td> ' .$row['postnomStagiaire']. '</td>
					<td> ' .$row['prenomStagiaire']. '</td>
					<td> ' .$row['genre']. '</td>
					<td> ' .$row['institutionSc']. '</td>
					<td> ' .$row['sujet']. '</td>
					<td> ' .$row['encadreur']. '</td>
					<td> ' .$row['superviseur']. '</td>
					<td> ' .$row['editeur']. '</td>
					<td> ' .$row['promotion']. '</td>
					<td> ' .$row['debutStage']. '</td>
					<td> ' .$row['finStage']. '</td>
					<td> ' .$row['duree']. '</td>
					

				</tr>

					';
				}

				$output .='</table>'; 
				header("Content-Type: application/xls");
				header("Content-Disposition: attachment; filename=Liste Stagiaires ".$date.".xls ");

				echo $output;
			}
		}




 ?>


		