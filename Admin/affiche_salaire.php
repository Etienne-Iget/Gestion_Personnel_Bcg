<?php 
	session_start();

	$bdd = new PDO('mysql:host=localhost;dbname=administration', 'root','Iget1209',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

	$id_gs='1';

	$requser = $bdd->prepare('SELECT * FROM gestion_salaire WHERE  id_gs =?');

	$requser->execute(array($id_gs));

	$userinfo = $requser->fetch();

	$_SESSION['Dev_Produit_Cartographiques']=$userinfo['Dev_Produit_Cartographiques'];
	$_SESSION['Systeme_Gestion_Donnees']=$userinfo['Systeme_Gestion_Donnees'];
	$_SESSION['Suivievaluation_Controle_Qualite']=$userinfo['Suivievaluation_Controle_Qualite'];
	$_SESSION['Catalogage_Document']=$userinfo['Catalogage_Document'];
	$_SESSION['prime']=$userinfo['prime'];

	$dpv=$_SESSION['Dev_Produit_Cartographiques'];
	$sgd=$_SESSION['Systeme_Gestion_Donnees'];
	$scq=$_SESSION['Suivievaluation_Controle_Qualite'];
	$cd=$_SESSION['Catalogage_Document'];
	$pa=$_SESSION['prime'];
	
	$voir='';
	$voir.='
		<table id="customer_data" class="table table-bordered table-dark table-striped">
					<thead>
					
						<tr>
							<th class="text-center">Dev_Produit_Cartographiques</th>
							<th class="text-center">Systeme_Gestion_Donnees</th>
							<th class="text-center">Suivievaluation_Controle_Qualite</th>
							<th class="text-center">Catalogage_Document</th>
							<th class="text-center">Prime_Activité</th>							
						</tr>
						<tr>
							<th>'.$dpv.'	Fbu</th>
							<th>'.$sgd.'	Fbu</th>
							<th>'.$scq.'	Fbu</th>
							<th>'.$cd.'	Fbu</th>
							<th>'.$pa.'	Fbu</th>
						</tr>
					</thead>
				</table>
				';

		echo $voir;


 ?>