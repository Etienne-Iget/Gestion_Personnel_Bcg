<?php 
session_start();

// var_dump($_POST);
// exit();

$bdd = new PDO('mysql:host=localhost;dbname=bcg', 'root','Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

if (trim($_POST['email_verif'])==='') {

	$data['err'] ='<i style="color: red;">Entrez l\'email</i>';
} else{

$email_verif =$_POST['email_verif'];

$verifAdmin = $bdd->prepare('SELECT * FROM employe WHERE email = ? ');
$verifAdmin->execute(array($email_verif));

$userinfo = $verifAdmin -> fetch();

if($verifAdmin -> rowcount() == 1){

	// var_dump($verifAdmin -> rowcount());
	// exit();


			$voir='';
			$voir.='
					<form action="#" method="POST"  id="form_message">
					<table style="border:0;" id="customer_data" class="table table-responsive-lg table-bordered ">
												<tr style="border:0;">
													<th >Email</th>
													<th ><input type="text" id="email_verif" name="email_verif" class="form-control" value="'.$email_verif.'"></th>
												</tr>
												<tr style="border:0;">
													<th >Mot de Passe par Defaut</th>
													<th ><input type="text"  id="password_defaut" name="password_defaut" class="form-control" ></th>
												</tr>
												<tr style="border:0;">
													<th >Nouveau Mot de Passe</th>
													<th ><input type="password"  id="password_New" name="password_New" class="form-control" ></th>
												</tr>
												<tr style="border:0;">
													<th >Confirmation</th>
													<th ><input type="password"  id="Confirmation" name="Confirmation" class="form-control" ></th>
												</tr>
					</table>
					
					<button type="submit" class="btn btn-primary" id="envoyer" name="submit" >Envoyer<span hidden><i class=" fa fa-spin fa-spinner"></i></span></button>
					</form>
					';

			$data['view'] = $voir;

			} else {
				$data['err'] = '<i style="color: red;">L\'utilisateur n\'existe pas</i>';
				
			}
}
echo json_encode($data);
 ?>
