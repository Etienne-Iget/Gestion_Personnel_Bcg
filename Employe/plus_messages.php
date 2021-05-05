<?php 
session_start();

$email = $_POST['email'];
 ?>


<?php

$bdd = new PDO('mysql:host=localhost;dbname=bcg', 'root','Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

	$sql = 'SELECT  DISTINCT(email_source) AS destination FROM messagerie WHERE (email_source=? AND  email_source<>?) OR (email_destination=? AND  email_source<>?) ' ;
	$requser = $bdd->prepare($sql);
	$requser->execute([$email,$email,$email,$email]);	
	
	if ($requser->rowCount() > 0) {

	$id=1;

	$voir='';

	$voir.='

				<table id="customer_data" class="table table-bordered table-responsive-lg table-striped">
			<thead>
			
				<tr>
					<th>N°</th>
					<th>Contacts</th>
					
				</tr>
			</thead>
	 		';

		while($row = $requser->fetch()) {

					$db  = new PDO('mysql:host=localhost;dbname=bcg', 'root', 'Iget1209') or die(mysql_errno());

					$nbres = $db->prepare("SELECT count(*) AS non_lu FROM messagerie WHERE etat='0' AND email_destination=? AND email_source=? ");
					$nbres->execute([$email,$row['destination']]);
					$resultat = $nbres->fetch(PDO::FETCH_ASSOC);
					$non_lu = $resultat['non_lu'];

					if ($non_lu==0) {

						$non_lu=' ';
					}

				$voir.='
					<tr>
						<td >'.$id++.'</td>
						<td id="email_source">'.$row['destination'].'</td>
						
						<td id="id_messagerie"><a href="#" data-destination="'.$row['destination'].'" data-source="'.$email.'" data-toggle="modal" data-target="#repondre" class="btn btn-primary"><span class="badge badge-dark badge-pill">'.$non_lu.'</span></a></td>
					</tr>
		
					
			';
			
		}
					
	$voir.='</table>';

	echo $voir;
} else{ 
					if(isset($email)){
				 	echo '<h3 style = "color:black; text-align:center;">Aucun Messge</h3>'; 
					echo '<a href="?action=msg" class=" btn btn-success" >Nouveau message</a>';}

}
				 
?>


