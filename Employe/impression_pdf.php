<?php 
session_start();
// var_dump($_POST);
if ($_POST) {
	

	$photo = $_POST['photo'];
	$mois = $_POST['mois'];
	$annee = $_POST['annee'];
	$matricule = $_POST['matricule'];
	$nom = $_POST['nom'];
	$genre = $_POST['genre'];
	$departement = $_POST['departement'];
	$fonction = $_POST['fonction'];
	$salaire = $_POST['salaire'];
	$prime = $_POST['prime'];
	$total = $_POST['total'];

$voir='';

$voir.='

	
								<table cellspacing ="5"  style=" background-color: #708090; " >

												<tr style="border:0;">
													<th align="left" ><img src="bu.png" alt="Logo" id="logo" width="50" /><br></th>
													<th align="right"><br>REPUBLIQUE DU BURUNDI</th>
												</tr>
												<tr>
													<td colspan="2"  align="center">BUREAU DE CENTRALISATION GEOMATIQUE &copy;</td>
												</tr>
								</table>
								
								<h2 style="text-align:center;">Fiche de Paie</h2>
								<br><br><br>
								<table style="border:0;" id="customer_data" class="table table-bordered  table-striped">

															<tr>
																<td align="center" colspan="2"><img src="'.$photo.'" width="100" class=sz-image/></td>
															</tr>
															<tr>
																<th align="left">Matricule : '.$matricule.'</th>
																<th align="right"><legend>Mois : '.$mois.'	Année : '.$annee.' </legend></th>
															</tr>
								</table>
								<br>
								<br>

								<table cellspacing ="5" >

												<tr style="border:0;">
													<th align="left" >NOM :	'.$nom.'</th>
													<th align="right">GENRE :	'.$genre.'</th>
												</tr>
								</table>

								<br><br>
												
								<table border="1" >
												<tr style="border:0;">
													<th align="left" style="color:black;">Departement	:	</th>
													<th align="center" id="departement" >'.$departement.'</th>
												</tr>
												<tr style="border:0;">
													<th align="left" style="color:black;">Fonction	:	</th>
													<th align="center" id="fonction">'.$fonction.'</th>
												</tr>
								</table>
								<br><br><br>
								<h3 style="text-align:center;">Salaires</h3>
								<br>
								<table border="1" >
												<tr style="border:0;">
													<th align="left" style="color:black;">Salaire	:	</th>
													<th align="right" id="salaire">'.$salaire.'	Fbu</th>
												</tr>
												<tr style="border:0;">
													<th align="left" style="color:black;">Prime	:	</th>
													<th align="right" id="prime_employe">'.$prime.'	Fbu</th>
												</tr>
												<tr style="border:0;">
													<th align="left" style="color:red; font-weight: bold;">TOTAL	:	</th>
													<th align="right" style="color:red; font-weight: bold;" id="total">'.$total.'	Fbu</th>
												</tr>
								</table>

					';

					
		require_once "pdf.php";


$pdf=new Pdf("P","mm","A4",true,'Utf-8',false);
 // set document information
            $pdf->SetCreator("BCG");
            $pdf->SetAuthor('BCG');
            $pdf->SetTitle('fiche de paie');
            $pdf->SetSubject('Rapport apporte');
            $pdf->SetKeywords('RAPPORT, PDF, example, test, guide');

            // set default header data
            $pdf->setFooterData(array(0,64,0), array(0,64,128));

            // set header and footer fonts
            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

            // $pdf->setPrintHeader(false);
            // set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // set margins
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP-15, PDF_MARGIN_RIGHT);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
            // set auto page breaks
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM-15);

            // set image scale factor
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

            // set default font subsetting mode
            $pdf->setFontSubsetting(true);
            // Add a page
            // This method has several options, check the source code documentation for more information.
            $pdf->AddPage();

            // set text shadow effect
            $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

            // Set some content to print

            $pdf->writeHTMLCell(0, 0, '', '', $voir, 0, 1, 0, true, '', true);

            // $pdf->Write(5, '<h1>Some sample text</h1>');
            $pdf->Output("fiche de paie", 'I');
  }else {
  	header("location:information.php");
  	
  }
 ?>