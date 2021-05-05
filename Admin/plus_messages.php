<?php 
session_start();

$email = $_POST['email'];


$bdd = new PDO('mysql:host=localhost;dbname=bcg', 'root','Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

	$requser = $bdd->query('SELECT * FROM messagerie WHERE email_destination LIKE "%'.$email.'%"  ORDER BY id_messagerie DESC ');

	if ($requser->rowCount() > 0) {

	// $userinfo = $requser->fetch();


	// $_SESSION['id_messagerie']=$userinfo['id_messagerie'];
	// $_SESSION['email_source']=$userinfo['email_source'];
	// $_SESSION['email_destination']=$userinfo['email_destination'];
	// $_SESSION['message']=$userinfo['message'];
	// $_SESSION['time_envoi']=$userinfo['time_envoi'];

	$id=1;

	$voir='';

	$voir.='

				<table id="customer_data" class="table table-bordered  table-striped">
			<thead>
			
				<tr>
					<th>N°</th>
					<th>Expeditaire</th>
					<th>Message</th>
					<th>Date envoi</th>
								
				</tr>
			</thead>
			';

			while($row = $requser->fetch()) { 
	$voir.='
				<tr>
					<td >'.$id++.'<?php echo ;?></td>
					<td id="email_source">'.$row['email_source'].'</td>
					<td id="message">'.$row['message'].'</td>
					<td id="time_envoi">'.$row['time_envoi'].'</td>
					<td id="id_messagerie"><a href="#" data-id="'.$row['id_messagerie'].'" data-toggle="modal" data-target="#repondre" class="btn btn-primary">Repondre</a></td>

						
					
			';


			
		}
					
	$voir.='</table>';

	echo $voir;
} else{ 
					if(isset($email)){
				 	echo '<p style = "color:black;">Aucun resultat</p>'.$email.' '; }



				 	} ?>


