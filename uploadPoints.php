<?php
include_once ('config.php');

// Create connection
$conn = new mysqli($server, $username, $password, $db);
$conn->set_charset("utf8");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}  

// $sql ="SELECT * FROM student s 
//  join studentTeam c on s.id_student=c.student_id 
//  join teams t on t.id_team=c.team_id 
//  join subjects su on t.subject_id=su.id_subject
// ";

$sql ="SELECT t.numberTeam, t.pointsTeam, s.subject_name, s.years
		FROM teams t
		JOIN subjects  s ON t.subject_id = s.id_subject";

$result=$conn->query($sql);

?>

<!DOCTYPE html>
<html lang="sk">

<head>
    <title>Zadanie </title>
    <meta charset="UTF-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

</head>

<body>
<?php 
// if ($result1->num_rows > 0) {
//   // output data of each row
//   while($row1 = $result1->fetch_assoc()) {
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $idTeamu= $row["id_team"];
			// $sql1 ="SELECT s.name, s.email, st.pointsStudent 
			// 	FROM studentTeam st
			// 	JOIN student s ON st.student_id = s.id_student
			// 	WHERE st.team_id = '".$idTeamu."'";
      //$menoPredmetu=$row["subject_name"];
     // $bodyTimu=$row["pointsTeam"];

      // $sql1 ="SELECT t.numberTeam, t.pointsTeam FROM student s 
      // join studentTeam c on s.id_student=c.student_id 
      // join teams t on t.id_team=c.team_id 
      // join subjects su on t.subject_id=su.id_subject
      // where su.subject_name='".$menoPredmetu."'";
  

      $sql1 ="SELECT s.name, c.confirmStudent FROM student s 
      join studentTeam c on s.id_student=c.student_id 
      join teams t on t.id_team=c.team_id 
      where t.numberTeam='".$row["numberTeam"]."'";
      // $result2=$conn->query($sql2);
    echo '<div class="container">
<h2>Predmet: '.$row["subject_name"].'</h2>
<h2>Tim: '.$row["numberTeam"].'</h2>
<form class="form-inline" action="uploadPoints.php">
  <div class="form-group">
    <label >Body:</label>
    <input type="text" class="form-control" name="bodyTimu" value="'.$row["pointsTeam"].'">
  </div>
  <button type="submit" class="btn btn-default" name="change">Zmenit</button>
</form>
</div>
</br>';
// if(isset($_POST['change'])){
//   $point=$_POST['bodyTimu'];
// $sql11 = "UPDATE teams SET pointsTeam='".$point."' WHERE subject_id='".$row["subject_id"]."' 
// AND numberTeam='".$row["numberTeam"]."'";
// 	if ($conn->query($sql11) === TRUE) {
//     echo "Údaje boli úspešne aktualizované.";
//   } else {
//     echo "Počas aktualizovania údajov sa vyskytla chyba.";
//   }
// }
echo'
<div class="container">
<form class="form-horizontal" method="post" action="index.php">';
$result1=$conn->query($sql1);

if ($result1->num_rows > 0) {
  // output data of each row
  while($row1 = $result1->fetch_assoc()) {

// if ($result2->num_rows > 0) {
//   // output data of each row
//   while($row2 = $result2->fetch_assoc()) {
    echo'
  <div class="form-group">
    <label class="control-label col-sm-2" >'.$row1["name"].':</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" name="c1" >
    </div>	
  <label class="control-label col-sm-1" >'.$row1["confirmStudent"].'</label>
  </div>';
}
}
echo'
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button name="yes" type="submit" class="btn btn-default">Suhlasim</button>
    </div>
  </div>
    <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button name="no" type="submit" class="btn btn-default">Nesuhlasim</button>
    </div>
  </div>
</form>
</div>';
// }
// }
}
}
?>
</body>
</html>

