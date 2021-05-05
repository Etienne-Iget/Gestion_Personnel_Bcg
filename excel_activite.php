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
			$sql="SELECT * FROM departement ORDER BY id_departement DESC";
			$resultat=mysqli_query($connect, $sql);

			if (mysqli_num_rows($resultat)>0) {
				
				$output .=' 
				<table>
				<tr> <strong>'.$date.'  </strong></tr>
				<tr>  <strong>liste des activités </strong></tr>
				</table>
				';

				$output .='

		<table class="table" style="color: black;" bordered="1" >
			
				<tr>
					<th>Id</th>
					<th>Employer</th>
					<th>Départemeent</th>
					<th>Fonction</th>
					<th>Activité</th>
					<th>obsérvation</th>

				</tr>

				';

				$id=1;

				while($row =mysqli_fetch_array($resultat)) {


					$output .='

				<tr>
					<td> ' .$id++. ' </td>
					<td> ' .$row['nomEmploye']. ' </td>
					<td> ' .$row['departement']. ' </td>
					<td> ' .$row['fonction']. ' </td>
					<td> ' .$row['activite']. ' </td>
					<td> ' .$row['observation']. ' </td>
					

				</tr>

					';
				}

				$output .='</table>'; 
				header("Content-Type: application/xls");
				header("Content-Disposition: attachment; filename=Activités".$date.".xls");

				echo $output;
			}
		}




 ?>


