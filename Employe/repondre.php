<?php 
session_start();

$source=$_POST['source'];
$destination=$_POST['destination'];

$bdd = new PDO('mysql:host=localhost;dbname=bcg', 'root','Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

if (isset($source) AND isset($destination)) {

		$requser = $bdd->prepare('SELECT * FROM messagerie WHERE (email_source =? AND email_destination =?) OR (email_source =? AND email_destination =?)');
		$requser->execute([$source,$destination,$destination,$source]);

		$user = $requser->fetch();

			$etatNew=1;

if (isset($etatNew) AND !empty($etatNew) And $etatNew!=$user['etat']) {

			$insertEtat=$bdd->prepare("UPDATE messagerie SET etat = ? WHERE email_source =? AND email_destination =?");
			$insertEtat->execute([$etatNew,$destination,$source]);

			
		}
	}



		$select = $bdd->prepare("SELECT * FROM messagerie WHERE (email_source =? AND email_destination =?) OR (email_source =? AND email_destination =?) ORDER BY time_envoi ASC ");
		$select->execute([$source,$destination,$destination,$source]);

			if ($select->rowCount() > 0) {

			$voir='';
			$voir.='<ul class="list-group">';
					
				while ($row = $select->fetch()) {

				if ($row['email_source']===$source ) {
					
					$voir.='
					  <div class=" py-0  mt-2 text-right text-primary">'.$source.'</div>
					  <li class="list-group-item text-right list-group-item-primary  ml-5 mb-2 mt-0">'.$row['message'].'</li>

			';	
					}else {
			$voir.='
					  <div class=" py-0  mt-2 text-success">'.$destination.'</div>
					  <li class="list-group-item list-group-item-success mr-5 mb-2 mt-0">'.$row['message'].'</li>
					  
					 
					';
							}	
						
				}
			
		$voir.='</ul>';
			$voir.='<div class="input-group mb-3" id="ancre">
							<input type="text" class="form-control border border-primary bg-light "  aria-describedby="button-addon2">
							<div class="input-group-append">
								 <button class="btn btn-outline-primary" type="button" id="button-addon2">Envoyer</button>
							</div>
					</div>';
			echo $voir;
			}

 ?>