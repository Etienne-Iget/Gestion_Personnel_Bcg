<?php

try
{

$b = new PDO('mysql:host=localhost;dbname=administration', 'root', 'Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

	// $email = $_SESSION['email'];
}
catch(Exception $e)
{
echo 'Erreur :' .$e->getMessage(); 

}
	
		$reponse = $b->query('SELECT * FROM communique ORDER BY date_envoi DESC LIMIT 5 ');
		
			$response['a']="";
			
		while ($donnees = $reponse->fetch())
			{

					$response['a']='';

				$response['a'].='
								<table style="border:0;" id="customer_data" class="table table-bordered  table-striped">

															<tr>
																<td>Date d\'envoi</td>
																<th style="align:center;">'.$donnees['date_envoi'].'</th>
															</tr>
															<tr>
															<td>Communiqué</td>
															<th disabled><textarea disabled style="align:center;">'.$donnees['information'].'</textarea></th>
																
															</tr>
								</table>
					
					';
					
					}
					echo json_encode($response); 

					$reponse->closeCursor(); // Termine le traitement de la requête
?>
