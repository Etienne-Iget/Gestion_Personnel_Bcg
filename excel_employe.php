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
			$sql="SELECT * FROM employe ORDER BY id DESC";
			$resultat=mysqli_query($connect, $sql);
			if (mysqli_num_rows($resultat)>0) {
				
				$output .=' 
				<table>
				<tr> <strong>'.$date.'  </strong></tr>
				<tr>  <strong>liste des Employers </strong></tr>
				</table>
				';

				$output .='

		<table  class="table" style="color: black;" bordered="1">
			
				<tr>
					<th>Id</th>
					<th>Matricule</th>
					<th>Nom</th>
					<th>Genre</th>
					<th>Adresse</th>
					<th>Téléphone</th>
					<th>Email</th>
					<th>Département</th>
					<th>Fonction</th>
					<th>Etat de Service</th>
					<th>Date_Enregistrement</th>

				</tr>

				';

				$id=1;

				while($row =mysqli_fetch_array($resultat)) {


					$output .='

				<tr>
					<td> ' .$id++. ' </td>
					<td> ' .$row['matricule']. ' </td>
					<td> ' .$row['nomEmploye']. ' </td>
					<td> ' .$row['genre']. ' </td>
					<td> ' .$row['adresse']. ' </td>
					<td> ' .$row['tel']. ' </td>
					<td> ' .$row['email']. ' </td>
					<td> ' .$row['departement']. ' </td>
					<td> ' .$row['fonction']. ' </td>
					<td> ' .$row['etatService']. ' </td>
					<td> ' .$row['dateEnregistrement']. ' </td>

				</tr>

					';
				}

				$output .='</table>'; 
				header("Content-Type: application/csv");
				header("Content-Disposition: attachment; filename=Employés ".$date.".xls ");

				echo $output;
			}
		}




 ?>


		