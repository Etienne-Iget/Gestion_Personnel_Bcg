<?php 
session_start();

$id=$_POST['id'];

$bdd = new PDO('mysql:host=localhost;dbname=bcg', 'root','Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));


$select = $bdd->query('SELECT * FROM messagerie WHERE id_messagerie LIKE "%'.$id.'%" ');

			if ($select->rowCount() > 0) {

			$message = $select->fetch();
			
			$voir='';
			$voir.='
													<form action="#" method="POST"  id="form_message">
					<table style="border:0;" id="customer_data" class="table table-bordered ">
												<tr style="border:0;">
													<th >Expediteur</th>
													<th ><input type="text"  name="email_source" id="email_source" class="form-control" value="'.$message['email_destination'].'"></th>
												</tr>
												<tr style="border:0;">
													<th >Email destination</th>
													<th ><input type="text"  name="email_destination" id="email_destination" class="form-control" value="'.$message['email_source'].'"></th>
												</tr>
					</table>
					<table style="text-center;" id="customer_data" class="table table-bordered ">
												<tr style="border:0;">
													<th >Message</th>
												
													<th style="color:black; " id="salaire"><textarea disabled>'.$message['message'].'</textarea></th>
												</tr>
					</table>

					<table style="border:0;" id="customer_data" class="table table-bordered ">
												<tr style="border:0;">
													<th>Reponse : </th>
													<th><textarea style="color:black; " name="message_reponse" id="message_reponse"></textarea></th>
												</tr>
					</table>
					<input type="submit" class="btn btn-primary" id="envoyer" name="submit" value="Envoyer" />
													</form>

										
										
												

			';

			echo $voir;
			
			}

 ?>