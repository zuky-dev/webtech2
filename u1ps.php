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
        <title>uloha1</title>
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        
        <link rel="stylesheet" href="style.css">
    </head>  
    <body>
    <div class="container">
     <?php   

     function subjectInfo($idStudent){
        include 'config.php';
        $str = "";
        $conn = new mysqli($servername, $username, $password, $dbname) or die("Connection failed: " . $conn->connect_error);     
        mysqli_set_charset($conn,"utf8");
        $sql = "SELECT * FROM Uloha1 AS u JOIN Predmet AS p ON u.id_uloha1= p.id_uloha1 WHERE idStudent=".$idStudent."";
        $result= $conn->query($sql);
        mysqli_query($conn, $sql);

        while($row = $result->fetch_assoc()) {
         /*   $bonus = $row['prednaska'] + $row['cvicenia'];
            $str = $str . "<h1>".$row['predmet']."</h1><br>". $row['meno']."(".$row['skRok'].")";
            $str = $str ."<table class='table-condensed table-bordered'>
           <thead>
            <tr>
                <th>Zápočet</th>
                <th>Projekt</th>
                <th>Test</th>
                <th>Bonus</th>
                <th>Súčet</th>
                <th>Známka</th>     
            </tr>
            </thead>
            <tbody>
            <tr><td>";
            $str = $str.$row['zapocty']."</td>
            <td>".$row['projekt']."</td>
            <td>".$row['skuska']."</td>
            <td>".$bonus."</td>
            <td>".$row['spolu']."</td>
            <td>".$row['znamka']."</td>
            </tr></tbody>
            </table>";*/

            
           echo "<h1>".$row['predmet']."</h1><br>";
           $bonus = $row['prednaska'] + $row['cvicenia'];
           echo $row['meno']."(".$row['skRok'].")";?> 
          
        <table class="table">
        <thead class="thead-dark">
         <?php 
           echo" <tr>
                <th>Zápočet</th>
                <th>Projekt</th>
                <th>Test</th>
                <th>Bonus</th>
                <th>Súčet</th>
                <th>Známka</th>     
            </tr>
            </thead>
            <tbody>
            <tr><td>".$row['zapocty']."</td>
            <td>".$row['projekt']."</td>
            <td>".$row['skuska']."</td>
            <td>".$bonus."</td>
            <td>".$row['spolu']."</td>
            <td>".$row['znamka']."</td>
            </tr></tbody>
            </table>";
          }  
       //   return $str; 
      }
     ?>
    
      <?php

        subjectInfo($_GET['id']);

      ?>
    </div>
     </body>
</html>