<?php
session_start();
if (!isset($_SESSION['idAdmin'], $_SESSION['nomAdmin'],$_SESSION['postnomAdmin'],$_SESSION['emailAdmin'] )) {
	header('location:index.php');
}


?>


<?php 
		$connect=mysqli_connect("localhost","root","Iget1209","administration");
		$output='';
		$date	=	date("d-m-Y	H:i:s");

		if (isset($_POST['export_excel'])) {
			$sql="SELECT * FROM administrateur ORDER BY id DESC";
			$resultat=mysqli_query($connect, $sql);
			if (mysqli_num_rows($resultat)>0) {
				
				$output .=' 
				<table>
				<tr> <strong>'.$date.'  </strong></tr>
				<tr>  <strong>liste des administrateurs </strong></tr>
				</table>
				';

				$output .='

		<table  class="table" style="color: black;" bordered="1">
			


				<tr>
					<th>Id</th>
					<th>Nom</th>
					<th>Post-nom</th>
					<th>Prenom</th>
					<th>Genre</th>
					<th>Fonction</th>
					<th>Adresse</th>
					<th>Email</th>
					

				</tr>

				';

				$id=1;

				while($row =mysqli_fetch_array($resultat)) {


					$output .='

				<tr>
					<td> ' .$id++. ' </td>
					<td> ' .$row['nom']. ' </td>
					<td> ' .$row['postnom']. ' </td>
					<td> ' .$row['prenom']. ' </td>
					<td> ' .$row['genre']. ' </td>
					<td> ' .$row['fonction']. ' </td>
					<td> ' .$row['adress']. ' </td>
					<td> ' .$row['email']. ' </td>
					

				</tr>

					';
				}

				$output .='</table>'; 
				header("Content-Type: application/xls");
				header("Content-Disposition: attachment; filename=Liste Administrateurs ".$date.".xls ");

				echo $output;
			}
		}




 ?>


		