<?php

include_once ('config.php');
$id=intval($_COOKIE['id']);

//$id=139;

$sum=0;

// Start the session
session_start();
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);

// Create connection
$conn = new mysqli($server, $username, $password, $db);
$conn->set_charset("utf8");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql ="SELECT s.subject_name, t.pointsTeam,c.name, t.numberTeam, t.id_team,st.pointsStudent 
FROM student c 
join studentTeam st on st.student_id=c.id_student 
join teams t on t.id_team=st.team_id 
join subjects s on t.subject_id=s.id_subject
where c.id_student='".$id."'";

$result=$conn->query($sql);

if(isset($_POST['uloz'])){
  $studentBody=$_POST['bod'];
  $aktualStudent=$_GET['idSt'];
  $timId=$_GET['idT'];
    
    $tmpsql ="SELECT st.pointsStudent FROM student s
    JOIN studentTeam st on st.student_id=s.id_student WHERE st.student_id ='".$aktualStudent."'";

    $resultT=$conn->query($tmpsql);
    $prideleneBody=0;
    if ($resultT->num_rows > 0) {
      while($rowT = $resultT->fetch_assoc()) {
      if($rowT['pointsStudent'] == NULL){
      $sql11 = "UPDATE studentTeam SET pointsStudent='".$studentBody."' 
      WHERE student_id='".$aktualStudent."' AND team_id='".$timId."'";
      if ($conn->query($sql11) === TRUE) {
        header( "refresh:1;url=index.php" );
      } else {
        echo 'Počas aktualizovania údajov sa vyskytla chyba1'.$conn->error;
        }
      }
      else{
          $prideleneBody++;
      }
    }
    }

    if( $prideleneBody>0){
      header( "refresh:2;url=index.php" );
      echo "Body už boli rozdelené kapitánom tímu!";
    }
    
  
}



if(isset($_POST['yes'])){
    
     $timId=$_GET['idTeam'];
     
    $sql11 = "UPDATE studentTeam SET confirmStudent=TRUE WHERE  student_id='". $id."' 
    AND team_id='".$timId."'";
    if ($conn->query($sql11) === TRUE) {
      header( "refresh:0;url=index.php" );
    } else {
      echo "Počas aktualizovania údajov sa vyskytla chyba.";
    }
		
	}
	
	if(isset($_POST['no'])){
    $timId=$_GET['idTeam'];
    $sql11 = "UPDATE studentTeam SET confirmStudent=FALSE WHERE  student_id='". $id."'
    AND team_id='".$timId."'";
    if ($conn->query($sql11) === TRUE) {
      header( "refresh:0;url=index.php" );
    } else {
      echo "Počas aktualizovania údajov sa vyskytla chyba.";
    }
    
  }
  
?> 



<!DOCTYPE html>
<html lang="sk">

<head>
    <title>Zadanie </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <link rel="stylesheet" href="styleUploadPoints.css">
  <script>
      function suhlas() {
        confirm("Naozaj chcete potvrdiť Váš súhlas na rozdelenie bodov?");
      }
  </script>

  <script>
      function nesuhlas() {
        confirm("Naozaj chcete zamietnuť Váš súhlas na rozdelenie bodov?");
      }
  </script>

</head>

<body>
<div class="container">
<h2>Úloha 2</h2>
    <hr>
    <h2>Zoznam vašich tímov</h2>
    <hr>
<?php 
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $body=$row["pointsTeam"];
      $tim=$row["numberTeam"];
      $idtim=$row["id_team"];
      $menoPredmetu=$row["subject_name"];

      
      $sql1 ="SELECT s.name, c.confirmStudent, s.id_student,c.pointsStudent FROM student s 
      join studentTeam c on s.id_student=c.student_id 
      where c.team_id='".$idtim."'";

      $result1=$conn->query($sql1);

    echo '<div class="container">
    <h2>Predmet: '.$menoPredmetu.'</h2>
    <h2>Tím: '.$tim.'</h2>
    <h2>Body: '.$body.'</h2>    
    <div class="card bg-light">
    <div class="card-body">';
if ($result1->num_rows > 0) {
  // output data of each row
  while($row1 = $result1->fetch_assoc()) {
   
    $menoClena=$row1["name"];
    $potvrdenieStudenta=$row1["confirmStudent"];
    $idstud=$row1["id_student"];
    $bodyStudenta=$row1["pointsStudent"];
    echo'<div class="container">
<form class="form-horizontal" method="post" action="index.php?idSt='.$idstud.'&idT='.$idtim.'">
  <div class="form-group">
    <label class="control-label col-sm-2" >'.$menoClena.':</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="bod" name="bod" pattern="[0-9]+" value="'.$bodyStudenta.'">
    </div>	
    <div class =" col-sm-1" >
    <button name="uloz" type="submit" class="btn btn-default zm">Uložiť body</button>
    </div>
    <label class="col-sm-offset-1 control-label col-sm-0">'; 
    if($potvrdenieStudenta == NULL) {echo ''; }
  elseif($potvrdenieStudenta == 1) {echo 'Súhlasím'; }
  elseif ($potvrdenieStudenta == 0){ echo 'Nesúhlasím';}
  echo'</label>
      </div>
  </form>
  </div>';
 
  $sum = $sum + $bodyStudenta;
  
}
}

if($sum != $body){
  echo '<label class="control-label col-sm-6 nes" >
  Súčet rozdelených bodov musí byť rovný počtu pridelených bodov!</label></br></br>';
}
$sqlC ="SELECT t.confirmAdmin FROM teams t 
      join studentTeam st on t.id_team=st.team_id 
      where st.team_id='".$idtim."'";

$resultC=$conn->query($sqlC);

      if ($resultC->num_rows > 0) {
        while($rowC = $resultC->fetch_assoc()) {
            $suhlas=0;
            $nesuhlas=0;
          if($rowC['confirmAdmin'] == NULL){
            echo "";
          }
          elseif($rowC['confirmAdmin'] == 1){
            $suhlas++;
            
          }
          elseif($rowC['confirmAdmin'] == 0){
            $nesuhlas++;

            }
        }
      }
if($suhlas>0){echo '<label class="control-label col-sm-6 suh" >
  Administrátor súhlasí s Vašim bodovým rozdelením!</label>&nbsp;';}
if($nesuhlas>0){echo '<label class="control-label col-sm-6 nes" >
  Administrátor nesúhlasí s Vašim bodovým rozdelením!</label>&nbsp;';}
$sum=0;
$sqlP ="SELECT st.confirmStudent FROM student s 
      join studentTeam st on s.id_student=st.student_id 
      where st.student_id='".$id."' AND st.team_id='".$idtim."'";

$resultP=$conn->query($sqlP);

      if ($resultP->num_rows > 0) {
        while($rowP = $resultP->fetch_assoc()) {
if($rowP['confirmStudent'] == NULL) {
echo'
<form class="form-horizontal" method="post" action="index.php?idTeam='.$idtim.'">
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-4 ">
      <button name="yes" type="submit" class="btn btn-default zm" onClick="suhlas();">Súhlasím</button>

      <button name="no" type="submit" class="btn btn-default zm" onClick="nesuhlas();">Nesúhlasím</button>
    </div>
  </div>
</form>
';
}
}
}
echo'</div></div>
</div>';
}
}
?>
&nbsp;
&nbsp;
<hr>
<hr>
<div class="container">
<h1>Export jednotlivých bodov do CSV súboru</h1>
        <div class="card bg-light">
        <div class="card-body">
        <form action="export.php" method="post"> 
        <?php  
        echo "  <div ><select class='form-control' name='taskOption'>";
        include 'config.php';
        // fetch the data
        $conn = new mysqli($server, $username, $password, $db) or die("Connection failed: " . $conn->connect_error);     
        mysqli_set_charset($conn,"utf8");
        $sql ="SELECT * FROM subjects";
        $result= $conn->query($sql);
        mysqli_query($conn, $sql);
        while ($row = $result->fetch_assoc()){
           echo" <option value='".$row['id_subject']."'>".$row['subject_name']."</option> ";
        }
        echo "</select></br>";
        ?>  
        <?php 
           echo "<select class='form-control' name='taskOption2'>";
           
           $sql2 ="SELECT DISTINCT years FROM subjects";
           $result2= $conn->query($sql2);
           mysqli_query($conn, $sql2);
           while ($row = $result2->fetch_assoc()){
             echo" <option value='".$row['years']."'>".$row['years']."</option> ";
           }
           echo "</select></div></br>";  
        ?>
        <button type="submit" class="btn btn-default zm">Exportovať</button>
          </div>
          </div>
        </form>
        &nbsp;
    </div>
</body>
</html>
