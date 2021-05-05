<?php 
session_start();
$voir='';
			$voir.='
					<form action="#" method="POST"  id="form_message">
						<table style="border:0;" id="customer_data" class="table table-responsive-lg table-bordered ">
							<tr style="border:0;">
								<th >Email</th>
								<th ><input type="text" id="email_verif" name="email_verif" class="form-control"> </th>
							</tr>
						</table>
						
					<button type="submit" class="btn btn-primary" id="Vérifier" name="submit" >Vérifier <span hidden><i class=" fa fa-spin fa-spinner"></i></span></button>
					</form>
					';
			echo $voir;		
 ?>
