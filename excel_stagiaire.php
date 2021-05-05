<meta charset="utf-8">
<?php
session_start();

	if (!isset($_SESSION['id'], $_SESSION['nom'])) {

	header('location:index.php');
		
	}
?>

<?php 
		$connect=mysqli_connect("localhost","root","Iget1209","bcg");
		$output='';
		$date	=	date("d-m-Y	H:i:s");

		if (isset($_POST['export_excel'])) {
			$sql="SELECT * FROM stagiaire ORDER BY idStagiaire DESC";
			$resultat=mysqli_query($connect, $sql);

			if (mysqli_num_rows($resultat)>0) {
				
			$output .=' 
				<table>
				<tr> <strong>'.$date.'  </strong></tr>
				<tr>  <strong>liste des Stagiaires </strong></tr>
				</table>
				';

				$output .='

		<table class="table" style="color: black;" bordered="1" >
			
				<tr>
					<th>Id</th>
					<th>Nom</th>
					<th>Post-nom</th>
					<th>Prenom</th>
					<th>Genre</th>
					<th>Université</th>
					<th>Sujet_Rapport_Stage</th>
					<th>Encadreur</th>
					<th>Supérviseur</th>
					<th>Editeur</th>
					<th>Promotion</th>
					<th>Durée</th>
					<th>Du</th>
					<th>Au</th>


				</tr>

				';

				$id=1;

				while($row =mysqli_fetch_array($resultat)) {


					$output .='

				<tr>
					<td> ' .$id++. ' </td>
					<td> ' .$row['nomStagiaire']. ' </td>
					<td> ' .$row['postnomStagiaire']. ' </td>
					<td> ' .$row['prenomStagiaire']. ' </td>
					<td> ' .$row['genre']. ' </td>
					<td> ' .$row['institutionSc']. ' </td>
					<td> ' .$row['sujet']. ' </td>
					<td> ' .$row['encadreur']. ' </td>
					<td> ' .$row['superviseur']. ' </td>
					<td> ' .$row['editeur']. ' </td>
					<td> ' .$row['promotion']. ' </td>
					<td> ' .$row['duree']. ' </td>
					<td> ' .$row['debutStage']. ' </td>
					<td> ' .$row['finStage']. ' </td>

				</tr>

					';
				}

				$output .='</table>'; 
				header("Content-Type: application/xls");
				header("Content-Disposition: attachment; filename=Stagiaires ".$date.".xls");

				echo $output;
			}
		}




 ?>

		