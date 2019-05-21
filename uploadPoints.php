<?php
include_once ('config.php');

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

$sql ="SELECT t.numberTeam, t.pointsTeam, t.id_team, s.subject_name, s.years, t.confirmAdmin
        FROM teams t
        JOIN subjects  s ON t.subject_id = s.id_subject";

$result=$conn->query($sql);

if(isset($_POST['change'])){
  $point=$_POST['bodyTimu'];
  $timId=$_GET['m'];

$sql11 = "UPDATE teams SET pointsTeam='".$point."' WHERE  id_team='". $timId."'";
	if ($conn->query($sql11) === TRUE) {
    header( "refresh:1;url=uploadPoints.php" );
  } else {
    echo "Počas aktualizovania údajov sa vyskytla chyba!";
  }
}

if(isset($_POST['yes'])){
  $timId=$_GET['idTeam'];
  $sql11 = "UPDATE teams SET confirmAdmin=TRUE WHERE  id_team='". $timId."'";
	if ($conn->query($sql11) === TRUE) {
    header( "refresh:0;url=uploadPoints.php" );
  } else {
    echo "Počas aktualizovania údajov sa vyskytla chyba!";
  }
}

if(isset($_POST['no'])){
  $timId=$_GET['idTeam'];
  $sql11 = "UPDATE teams SET confirmAdmin=FALSE WHERE  id_team='". $timId."'";
	if ($conn->query($sql11) === TRUE) {
    header( "refresh:0;url=uploadPoints.php" );
  } else {
    echo "Počas aktualizovania údajov sa vyskytla chyba!";
  }
}
?>

<!DOCTYPE html>
<html lang="sk">

<head>
    <title>Zadanie </title>
    <meta charset="UTF-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="styleUploadPoints.css">
</head>

<body>
<div class="container">
          <h2>Úloha 2</h2>
          <hr>
          <h2>Zoznam všetkcýh tímov</h2>
          <hr>
<?php 
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $idTeamu= $row["id_team"];

      $sql1 ="SELECT s.name, c.confirmStudent, c.pointsStudent FROM student s 
      join studentTeam c on s.id_student=c.student_id 
      where c.team_id='".$idTeamu."'";

    echo '<div class="container">
          <h2>Predmet: '.$row["subject_name"].'</h2>
          <h2>Tím: '.$row["numberTeam"].'</h2>
          
          <form class="form-inline" method="post" action="uploadPoints.php?m='.$idTeamu.'">
            <div class="form-group">
              <label >Body:</label>
              <input type="text" class="form-control" name="bodyTimu" value="'.$row["pointsTeam"].'">
            </div>
            <button type="submit" class="btn btn-default zm" name="change">Zmeniť</button>
          </form>
          </div>
          </br>
          <div class="card bg-light">
          <div class="card-body">';

echo'

<form class="form-horizontal" method="post" action="uploadPoints.php?idTeam='.$idTeamu.'">';
$result1=$conn->query($sql1);

if ($result1->num_rows > 0) {
  // output data of each row
  while($row1 = $result1->fetch_assoc()) {
    echo'
  <div class="form-group">
    <label class="control-label col-sm-2" >'.$row1["name"].':</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="c1" value="'.$row1["pointsStudent"].'" >
    </div>	
  <label class="control-label col-sm-0" >'; 
  if($row1["confirmStudent"] == NULL) {echo ''; }
  elseif($row1["confirmStudent"] == 1) {echo 'Súhlasí'; }
  elseif ($row1["confirmStudent"] == 0){ echo 'Nesúhlasí';}
  echo'</label>
  </div>';
}
}
if( $row["confirmAdmin"] == NULL){
echo'
  <div class="form-group suhNesuh"> 
    <div class="col-sm-offset-2 col-sm-1 ">
      <button name="yes" type="submit" class="btn btn-default zm">Súhlasím</button>
    </div>

    <div class="col-sm-1">
      <button name="no" type="submit" class="btn btn-default zm">Nesúhlasím</button>
    </div>
  </div>';
}
elseif( $row["confirmAdmin"] == 1){
  echo '<label class="control-label col-sm-4 suh" >Súhlasíte s rozdelením bodov študentmi</label>';
}
elseif($row["confirmAdmin"] == 0){
  echo '<label class="control-label col-sm-4 nes" >Nesúhlasíte s rozdelením bodov študentmi</label>';
}
echo'
</div>
</div>
</form>
';
}
}
?>
&nbsp;
&nbsp;
<hr>
<hr>
 <h1>Zobrazenie štatistiky pre zvolený predmet a školský rok</h1>
        <div class="card bg-light">
        <div class="card-body">
        <form action="statistics.php" method="post">
        <?php
          $sql ="SELECT * FROM subjects";
          $result= $conn->query($sql);
          mysqli_query($conn, $sql);
          echo " <div class='form-group'><select class='form-control' name='taskOpt'>";
          while ($row = $result->fetch_assoc()){
            echo" <option value='".$row['id_subject']."'>".$row['subject_name']."</option> ";
          }
         echo "</select></br>";

         $sql2 ="SELECT DISTINCT years FROM subjects";
         $result2= $conn->query($sql2);
         mysqli_query($conn, $sql2);
         echo "<select class='form-control' name='taskOpt2'>";
         while ($row = $result2->fetch_assoc()){ 
              echo" <option value='".$row['years']."'>".$row['years']."</option> ";
         }
        echo "</select></div></br>";
        mysqli_close($conn);
        ?>
        <button type="submit" class="btn btn-default zm">Zobraziť štatistiku</button>
        
        </form>
        &nbsp;
        </div>
        </div>
        &nbsp;
</body>
</html>

