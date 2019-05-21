<?php
// Start the session
session_start();
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);
  
?>
<!DOCTYPE html>
<html lang="sk">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>uloha2</title>
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> <!-- Plotly.js -->
        <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
         <!-- Numeric JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/numeric/1.2.6/numeric.min.js"></script>
        <link rel="stylesheet" href="style.css">
    
    </head>  
     <body>   
    
     <header>
          <h1>Štatistika</h1>
     </header>
     <div class="container">
        <table class="table">
        <thead class="thead-dark">
                <tr>  
                    <th>Počet študentov</th>
                    <th>Počet súhlasiacich študentov</th>
                    <th>Počet nesúhlasiacich študentov</th>
                    <th>Počet nevyjadrených študentov</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                <?php
                     
                    include 'config.php';
                    // fetch the data
                    $conn = new mysqli($server, $username, $password, $db) or die("Connection failed: " . $conn->connect_error);     
                    mysqli_set_charset($conn,"utf8");
                    $sql ="SELECT * FROM student AS s 
                    JOIN studentTeam AS st ON s.id_student = st.student_id 
                    JOIN teams AS t ON t.id_team=st.team_id
                    JOIN subjects AS sub ON sub.id_subject=t.subject_id
                    WHERE sub.id_subject='".$_POST['taskOpt']."' 
                    AND sub.years='".$_POST['taskOpt2']. "'";
                    $result= $conn->query($sql);
                     mysqli_query($conn, $sql);

                     $agree = 0; 
                     $disagree = 0;
                     $not= 0;
                     $sum = 0;
                                                                                
        
                   while ( $row = $result->fetch_assoc()){
                  
                   if($row['confirmStudent']==NULL){
                      $not++;
                   }
                   elseif($row['confirmStudent']==1){
                      $agree++;
                   }
                   elseif($row['confirmStudent']==0){
                     $disagree++;
                   } 
                   if($row['id_student']!=NULL){
                      $sum++;
                  }
                 }
                ?>
                     <td> <?php echo $sum ?> </td>
                     <td> <?php echo $agree ?> </td>
                     <td> <?php echo $disagree ?></td>
                     <td> <?php echo $not ?> </td>
                 </tr>
              </tbody>
         </table>
        </div>
        <div class="container">   
         <div id="myDiv"><!-- Plotly chart will be drawn inside this DIV --></div>  
        </div>  
         <?php
         echo "<script> 
              var data = [{
              values: [".$sum." , ".$agree." , ".$disagree.", ".$not."],
              labels: ['Počet študentov', 'Počet súhlasiacich študentov', 'Počet nesúhlasiacich študentov','Počet nevyjadrených študentov'],
              type: 'pie'
              }];
  
              Plotly.newPlot('myDiv', data, {}, {showSendToCloud:true});
        </script>";

    ?>

        <div class="container">
        <table class="table">
        <thead class="thead-dark">
                <tr>  
                    <th>Počet tímov</th>
                    <th>Počet uzavretých tímov</th>
                    <th>Počet tímov na vyjadrenie</th>
                    <th>Počet tímov s nevyjadrenými študentmi</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                <?php
                     
                    $sql ="SELECT DISTINCT t.id_team, t.confirmAdmin FROM student AS s JOIN studentTeam AS st ON s.id_student = st.student_id 
                    JOIN teams AS t ON t.id_team=st.team_id
                    JOIN subjects AS sub ON sub.id_subject=t.subject_id WHERE sub.id_subject='".$_POST['taskOpt']."' AND sub.years='".$_POST['taskOpt2']. "'";
                    $result= $conn->query($sql);
                     mysqli_query($conn, $sql);

                     $confAdmin = 0; 
                     $nstudent = 0;
                     $not= 0;
                     $team = 0;
                     $tmp=0;

                     while ( $row = $result->fetch_assoc()){
                  
                        if($row['id_team']!=NULL){
                           $team++;
                         }
                         if($row['confirmAdmin']==NULL){
                           $not++;
                         }
                         elseif($row['confirmAdmin']==1 || $row['confirmAdmin']==0){
                            $confAdmin++;
                          }

                          $sql2 ="SELECT  t.id_team, t.confirmAdmin, st.confirmStudent FROM student AS s 
                          JOIN studentTeam AS st ON s.id_student = st.student_id 
                          JOIN teams AS t ON t.id_team=st.team_id
                          JOIN subjects AS sub ON sub.id_subject=t.subject_id 
                          WHERE sub.id_subject='".$_POST['taskOpt']."' AND sub.years='".$_POST['taskOpt2']. "' 
                          AND t.id_team='".$row['id_team']. "'";
                          $result2= $conn->query($sql2);
                           mysqli_query($conn, $sql2);
                          while ( $row = $result2->fetch_assoc()){
                            if($row['confirmStudent']==NULL){
                                $tmp++;
                             }
                               
                            
                            
                        }
                        if($tmp>0){
                            $nstudent++;
                            $tmp=0;
                         }
                    }
          
                   
                   
                       
                ?>
                     <td> <?php echo $team ?> </td>
                     <td> <?php echo $confAdmin ?> </td>
                     <td> <?php echo $not ?></td>
                     <td> <?php echo $nstudent ?> </td>
                 </tr>
              </tbody>
         </table>
        </div>

    <div class="container">   
         <div id="myDiv2"><!-- Plotly chart will be drawn inside this DIV --></div>  
    </div>  
    <?php
    echo "<script> 
           var data = [{
           values: [".$team." , ".$confAdmin." , ".$not.", ".$nstudent."],
           labels: ['Počet tímov', 'Počet uzavretých tímov', 'Počet tímov na vyjadrenie','Počet tímov s nevyjadrenými študentmi'],
           type: 'pie'
         }];
  
         Plotly.newPlot('myDiv2', data, {}, {showSendToCloud:true});
    </script>";

    ?>

        

</body>
</html>