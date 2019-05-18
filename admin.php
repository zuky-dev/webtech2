<?php
include_once ('config.php');

// Create connection
$conn = new mysqli($server, $username, $password, $db);
$conn->set_charset("utf8");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


if(isset($_POST["upload"])){
    $oddelovac = $_POST["oddel"];
    $skrok=$_POST["rok"];
    $sub=$_POST["predmet"];
    $filename=$_FILES["file"]["tmp_name"];    
     if($_FILES["file"]["size"] > 0)
     {
        $file = fopen($filename, "r");
          while (($getData = fgetcsv($file, 10000, $oddelovac)) !== FALSE)
           {
            $body=$getData[0];
             $sql = "INSERT INTO Tim (years,subjects,points,confirm) 
                   VALUES ('$skrok', '$sub','".$getData[0]."', NULL)";
                  
                  if ($conn->query($sql) === TRUE /*&& $conn->query($sq3) === TRUE &&
                   $conn->query($sql2) === TRUE */) {
                    echo "Udaje boli uspesne nahrane.<br>";
                    //header( "refresh:5;url=index.php" );
                } else {
                    echo 'Pocas pridavania udajov sa vyskytla chyba.'.$conn->error;
                }

           }
      
           fclose($file);  
     }
  }   

  $conn->close();

?>

<!DOCTYPE html>
<html lang="sk">

<head>
    <title>Zadanie</title>
    <meta charset="UTF-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

</head>

<body>
<div class="container">
<h2>Nahravanie bodov</h2>
<form class="form-horizontal" method="post" enctype="multipart/form-data" action="admin.php">
  <div class="form-group">
    <label class="control-label col-sm-2" >Skolsky rok:</label>
    <div class="col-sm-6">
       <select name="rok" id="rok" class="form-control" >
                                <option value="2018/2019" selected>2018/2019</option>
                                <option value="2017/2018">2017/2018</option>
                                <option value="2016/2017">2016/2017</option>
                                <option value="2015/2016">2015/2016</option>
                            </select>
    </div>	
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" >Nazov predmetu:</label>
    <div class="col-sm-6"> 
      <input type="text" class="form-control" name="predmet" >
    </div>
  </div>
    <div class="form-group">
    <label class="control-label col-sm-2" >Nahrajte subor:</label>
    <div class="col-sm-6"> 
    <input type="file" class="form-control" name="file" id="file">
    </div>
  </div>
    <div class="form-group">
    <label class="control-label col-sm-2" >Oddelovac v subore:</label>
    <div class="col-sm-6"> 
      <input type="text" class="form-control" name="oddel" >
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button name="upload" type="submit" class="btn btn-default">Nahrat</button>
    </div>
  </div>
</form>

</div>
</body>
</html>