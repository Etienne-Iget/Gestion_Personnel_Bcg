
<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=administration', 'root', 'Iget1209');

if (isset($_GET['id'])) {
	
	$id=$_GET['id'];

	if (!empty($id) && is_numeric($id)) {
		// include("accueil.php");

		$query="DELETE FROM administrateur WHERE id = :id";
		$conn=$bdd->prepare($query);
		$conn->execute(array('id'=>$id));

		header('location:accueil.php');

	}
}




 ?>
 