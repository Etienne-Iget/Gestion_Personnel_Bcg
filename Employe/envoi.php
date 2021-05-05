<?php 

session_start();

$email_source=$_POST['email_source'];
$email_destination=$_POST['email_destination'];
$message=$_POST['message_reponse'];

$bdd = new PDO('mysql:host=localhost;dbname=bcg', 'root', 'Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
if (trim($message)==='') {

	echo '<i style="color: red;">Entrez le message</i>';
} else{
	
	if ($email_source) {
		
	$insert = $bdd->prepare("INSERT INTO messagerie (email_source, email_destination, message ) VALUES(:email_source, :email_destination, :message)");

	$insert->execute(array(	'email_source'=>$email_source, 
							'email_destination'=>$email_destination, 
							'message'=>$message ));

		echo '<i style="color: red;">Message envoyé</i>';
		
	}
}

 ?>
