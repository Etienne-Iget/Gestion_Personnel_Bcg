

 <?php 
	session_start();

// var_dump($_POST);
// exit();


$bdd = new PDO('mysql:host=localhost;dbname=administration', 'root','Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

if (trim($_POST['email_verif'])==='' OR trim($_POST['password_defaut'])==='' OR trim($_POST['password_New'])==='' OR trim($_POST['Confirmation'])==='') {

	$data['err']='<i style="color: red;">Entre toutes les Informations</i>';

} else{

	
	$email_verif=$_POST['email_verif']; 
	$password_defaut=$_POST['password_defaut'];
	$password_New=$_POST['password_New']; 
	$Confirmation=$_POST['Confirmation'];

	if ($password_defaut == 'admin1234') {
	 	
	 	$requser = $bdd->prepare('SELECT * FROM administrateur WHERE  email =?');
		$requser->execute(array($email_verif));

		$user = $requser->fetch();

		if (isset($password_New) AND !empty($password_New) AND isset($Confirmation) AND !empty($Confirmation) And $password_New!=$user['password']) {

			$passwordNew=sha1($password_New);
			$Confirmation=sha1($Confirmation);

			if ($passwordNew==$Confirmation) {
				
			$insertpassword=$bdd->prepare("UPDATE super_admin SET password = ? WHERE email = ?");
			$insertpassword->execute(array($passwordNew,$email_verif));

			$data['view']='<i style="color: blue;"> Modification du mot de passe réussie! Allez vous connecter </i>';
			
			
			}
			else{$data['err']= '<i style="color: red;">Mots de passe non identiques </i>';} 
		}

	 }else{$data['err']= '<i style="color: red;">Mot de passe par defaut incorrect </i>';} 

}

echo json_encode($data);
 ?>