<?php 

$connect = new PDO('mysql:host=localhost;dbname=administration', 'root', 'Iget1209');

$column= array('id','email','password','heureConnexion','heureDeconnexion');

$query="SELECT * FROM log_administrateur";

if (isset($_POST['search']['value'])) {
	
	$query.='WHERE email LIKE "%'.$_POST['search']['value'].'%" OR heureConnexion LIKE "%'.$_POST['search']['value'].'%" OR heureDeconnexion"%'.$_POST['search']['value'].'%" ';
}

// if (isset($_POST['order'])) {
	
// 	 $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
// }
// else{

// 	$query .='ORDER BY id DESC';
// }
$query1 ='';

if($_POST['length'] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connect->prepare($query);

$statement->execute();

$number_filter_row = $statement->rowCount();

$statement = $connect->prepare($query . $query1);

$statement->execute();

$result = $statement->fetchAll();

$data = array();

foreach($result as $row) {

	$sub_array = array();
	$sub_array[] = $row['email'];
	$sub_array[] = $row['password'];
	$sub_array[] = $row['heureConnexion'];
	$sub_array[] = $row['heureDeconnexion'];
	$data[] = $sub_array;
}

function count_all_data($connect)
{
 $query = "SELECT * FROM log_administrateur";
 $statement = $connect->prepare($query);
 $statement->execute();
 return $statement->rowCount();
}

$output = array(
 'draw'    => intval($_POST['draw']),
 'recordsTotal'  => count_all_data($connect),
 'recordsFiltered' => $number_filter_row,
 'data'    => $data
);

echo json_encode($output);

 ?>

