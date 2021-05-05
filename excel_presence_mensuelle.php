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

		$mois = date("n");
		// var_export($mois);
		// exit();

		if (isset($_POST['export_excel'])) {
			$sql='SELECT * FROM presence WHERE mois_presence LIKE "%'.$mois.'%" ORDER BY time_observation DESC';
			$resultat=mysqli_query($connect, $sql);

			if (mysqli_num_rows($resultat)>0) {
				
			$output .=' 
				<table>
				<tr> <strong>'.$date.'  </strong></tr>
				<tr>  <strong>Presences du '.$mois.'  </strong></tr>
				</table>
				';

				$output .='

		<table class="table" style="color: black;" bordered="1" >
			
				<tr>
					<th  ">Id</th>
					<th  ">Matricule</th>
					<th  ">Nom </th>
					<th  ">Département </th>
					<th  ">Observation </th>
					<th  ">Jour </th>
					<th  ">Arrivé à </th>


				</tr>

				';

				$id=1;

				while($row =mysqli_fetch_array($resultat)) {


					$output .='

				<tr>
					<td>' .$id++. '</td>
					<td>' .$row['matricule']. '</td>
					<td>' .$row['nomEmploye']. '<br></td>	
					<td>' .$row['departement']. '<br></td>
					<td>' .$row['presence']. '<br></td>
					<td>' .$row['jour_presence'].'/'.$row['mois_presence'].'/'.$row['annee_presence'].'<br></td>
					<td>' .$row['temps_arrive']. '<br></td>
				</tr>

					';
				}

				$output .='</table>'; 
				header("Content-Type: application/xls");
				header("Content-Disposition: attachment; filename=Présence du mois ".$mois.".xls");

				echo $output;
			}else{

			header('location:personnel.php');
			}
		}




 ?>

		