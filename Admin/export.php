<?php  
      // export.php  
 if(isset($_POST["export"]))  
 {  
      $date =     date("d-m-Y H:i:s");
      $connect = mysqli_connect("localhost", "root", "Iget1209", "administration");  
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=Logs employer '.$date.'.csv' );  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('matricule', 'nom', 'email', 'heureConnexion', 'heureDeconnexion'));  
      $query = "SELECT * from log_employe ORDER BY id DESC";  
      $result = mysqli_query($connect, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 }  
 ?>  

 <?php 

  // <td> ' .$id++. ' </td>
            //                   <td> ' .$row['matricule']. ' </td>
            //                   <td> ' .$row['nom']. ' </td>
            //                   <td> ' .$row['email']. ' </td>
            //                   <td> ' .$row['heureConnexion']. ' </td>
            //                   <td> ' .$row['heureDeconnexion']. ' </td>
            // $connect=mysqli_connect("localhost","root","Iget1209","administration");
            // $output='';
            // $date =     date("d-m-Y H:i:s");

            // if (isset($_POST['export_excel'])) {
            //       $sql="SELECT * FROM log_employe ORDER BY id DESC";
                  
            //       $resultat=mysqli_query($connect, $sql);
            //       if (mysqli_num_rows($resultat)>0) {
                        
            //             $output .=' 
            //             <table>
            //             <tr> <strong>'.$date.'  </strong></tr>
            //             <tr>  <strong>logs Employers </strong></tr>
            //             </table>
            //             ';

            //             $output .='

            // <table  class="table" style="color: black;" bordered="1">
                  


            //             <tr>
            //                   <th>Id</th>
            //                   <th>Matricule</th>
            //                   <th>Nom</th>
            //                   <th>Email</th>
            //                   <th>Temps de la connexion</th>
            //                   <th>Temps de la deconnexion</th>

            //             </tr>

            //             ';

            //             $id=1;

            //             while($row =mysqli_fetch_array($resultat)) {


            //                   $output .='

            //             <tr>
            //                   <td> ' .$id++. ' </td>
            //                   <td> ' .$row['matricule']. ' </td>
            //                   <td> ' .$row['nom']. ' </td>
            //                   <td> ' .$row['email']. ' </td>
            //                   <td> ' .$row['heureConnexion']. ' </td>
            //                   <td> ' .$row['heureDeconnexion']. ' </td>


            //             </tr>

            //                   ';
            //             }

            //             $output .='</table>'; 
            //             header("Content-Type: application/xls");
            //             header("Content-Disposition: attachment; filename=Logs employer ".$date.".xls ");

            //             echo $output;
            //       }
            // }




 ?>
 <?php 
      
       class csv extends mysqli
       {
             private $state_csv = false;
             public function __construct()
             {
                  parent::__construct("localhost","root","Iget1209","administration");
                  if ($this->connect_error) {
                       echo "Echec de connexion :".$this->connect_error;
                  }
             }


             public function import($file)
             {
                 $file = fopen($file, 'r');

                 while ($row = fgetcsv($file)) {
                      $value ="'".implode("','", $row)."'";
                      $q = "INSERT INTO  log_employe(matricule,nom,email,heureConnexion,heureDeconnexion) value(".$value.")";
                      if ($this->query($q)) {
                              $this->state_csv = true;
                          
                      }else{
                        $this->state_csv = false;
                      }
                 }
                 if ($this->state_csv) {
                     echo "Importation réussie";
                 }else {
                  echo "Erreur d'importation";
                 }
             }

             // public function export()
             // {
             //      $this->state_csv = false;
             //      $q = "SELECT t.matricule, t.nom, t.email, t.heureConnexion, t.heureDeconnexion FROM log_employe AS t";
             //      $run = $this->query($q);
             //      if ($run->num_rows > 0) {
             //          $fn = "csv_".uniqid().".csv";
             //          $file=fopen("files/".$fn, "w");

             //          while ($row = $run->fetch_array(MYSQLI_NUM)) {
             //               if (fputcsv($file, $row)) {
             //                        $this->state_csv = true;
             //               }else{
             //                  $this->state_csv = false;
             //               }
             //          }
             //           if ($this->state_csv) {
             //               echo "Exportation réussie";
             //           }else {
             //            echo "Erreur d'Exportation";
             //           }
             //           fclose($file);

             //      }else{
             //            echo " Rien à exporter";
             //      }
             // }
       }




 ?>