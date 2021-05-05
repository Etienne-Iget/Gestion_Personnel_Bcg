			
<?php

session_start();

try
{

$email = $_POST['email'];

$b = new PDO('mysql:host=localhost;dbname=bcg', 'root', 'Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

}
catch(Exception $e)
{
echo 'Erreur :' .$e->getMessage(); 
}
$reponse = $b->query('SELECT * FROM messagerie WHERE email_destination LIKE "%'.$email.'%"  ORDER BY time_envoi DESC LIMIT 1');

	if ($reponse->rowCount() > 0) {

	$response['a']="";
			
		while ($donnees = $reponse->fetch())
			{

					$response['a']='';

				$response['a'].='
								<table style="border:0;" id="customer_data" class="table table-bordered  table-striped">

															<tr>
																<td>de :</td>
																<th style="align:center;"><input disabled type="text" value="'.$donnees['email_source'].'" ></th>
																<td>Date</td>
																<th style="align:center;">'.$donnees['time_envoi'].'</th>
															</tr>
															<tr>
															<td>Message</td>
															<th><textarea disabled style="align:center;">'.$donnees['message'].'</textarea></th>
																
															</tr>
								</table>
					
					';

				echo json_encode($response);

			}
			$reponse->closeCursor(); // Termine le traitement de la requête
		}else{
			$response['a']='Aucun message';
			echo json_encode($response);
		}
		?>