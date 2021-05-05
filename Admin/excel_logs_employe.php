<?php

session_start();

if (!isset($_SESSION['idAdmin'], $_SESSION['nomAdmin'],$_SESSION['postnomAdmin'],$_SESSION['emailAdmin'] )) {
  header('location:accueil.php');
}

 $connect = mysqli_connect("localhost", "root", "Iget1209", "administration");  
 $query ="SELECT * FROM log_employe ORDER BY id desc";  
 $result = mysqli_query($connect, $query);  
 
  $voir='';

  $voir.='
     
                <h2 align="center">Les logs de connexion</h2>  
                <h3 align="center">Employé Data Connexion</h3>                 
                <br />  
                 
                <br />
              
                     <table border="1" align="center">  
                          <tr style="color:black; font-weight: bold;"> 
                              <th>N°</th>  
                               <th>Matricule</th>  
                               <th>Nom</th>  
                               <th>Email</th>  
                               <th>Temps de la connexion</th>  
                               <th>Temps de la deconnexion</th> 
                               
                          </tr> 
                          ';
         
                     $id=1; 
                     while($row = mysqli_fetch_array($result))
   
                     {
           $voir.='
                        
                          <tr align=center>  
                               <td>'.$id++.'</td> 
                               <td>'.$row["matricule"].'</td>  
                               <td>'.$row["nom"].'</td>
                               <td>'.$row["email"].'</td>  
                               <td>'.$row["heureConnexion"].'</td>  
                               <td>'.$row["heureDeconnexion"].'</td>    
                          </tr>
                          ';  
                       
                           
                     }  
        $voir.='
                     </table>  
                
                ';
        
  require_once "pdf.php";

        $pdf=new Pdf("P","mm","A4",true,'Utf-8',false);
 // set document information
            $pdf->SetCreator("BCG");
            $pdf->SetAuthor('BCG');
            $pdf->SetTitle('log admin');
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
            $pdf->Output("fiche", 'I');
 