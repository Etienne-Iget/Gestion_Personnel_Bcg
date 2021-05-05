<?php
session_start();
if (!isset($_SESSION['idAdmin'], $_SESSION['nomAdmin'],$_SESSION['postnomAdmin'])) {
	header('location:index.php');
}


?>
<?php
$bdd = new PDO('mysql:host=localhost;dbname=bcg', 'root', 'Iget1209');

if (isset($_GET['id'])) {
	
	$idAdmin=$_GET['id'];

	if (!empty($id) && is_numeric($id)) {

		include("accueil.php");

		$query="DELETE FROM stagiaire WHERE idStagiaire = :id";
		$conn=$bdd->prepare($query);
		$conn->execute(array('id'=>$id));
		header('location:stagiaire.php');

	}
}


 ?>
 