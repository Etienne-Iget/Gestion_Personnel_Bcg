<?php
session_start();

	if (!isset($_SESSION['id'], $_SESSION['nomEmploye'], $_SESSION['etatService'], $_SESSION['password'], $_SESSION['etatService'], $_SESSION['photoEmploye'], $_SESSION['email']))  {
	
		header('location:../index.php');
	
}	
?>
<?php 
		$connect=mysqli_connect("localhost","root","Iget1209","bcg");

		$output='';
		$date	=	date("d-m-Y	H:i:s");
		$nomEmploye = $_SESSION['nomEmploye'];

		if (isset($_POST['export_excel'])) {
			
			$sql='SELECT * FROM departement WHERE nomEmploye LIKE "%'.$nomEmploye.'%" ORDER BY dateAjout DESC';
			$resultat=mysqli_query($connect, $sql);

			if (mysqli_num_rows($resultat)>0) {
				
				$output .=' 
				<table>

				<th><strong>'.$nomEmploye.'</strong></th>
				<th> <strong> '.$date.'  </strong></th>
				<tr>  <strong>liste des activites </strong></tr>
				</table>
				';

				$output .='

		<table class="table" style="color: black;" bordered="1" >
			
				<tr>
					<th>N°</th>
					<th>Departemeent</th>
					<th>Fonction</th>
					<th>Activite</th>
					<th>observation</th>
					<th>Date</th>

				</tr>

				';

				$id=1;

				while($row =mysqli_fetch_array($resultat)) {


					$output .='

				<tr>
					<td> ' .$id++. ' </td>
					<td> ' .$row['departement']. ' </td>
					<td> ' .$row['fonction']. ' </td>
					<td> ' .$row['activite']. ' </td>
					<td> ' .$row['observation']. ' </td>
					<td> ' .$row['dateAjout']. ' </td>
					

				</tr>

					';
				}

				$output .='</table>'; 
				header("Content-Type: application/xls");
				header("Content-Disposition: attachment; filename=Activités ".$nomEmploye." ".$date.".xls");

				echo $output;
			}
		}




 ?>


