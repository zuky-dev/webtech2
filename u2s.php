<?php
// URL https://147.175.121.210:4453/ZavZadanie/index.php

//TODO ziskat udaje z db
$body=45;
$celn1=0;
$celn2=0;
$celn3=0;
$celn4=0;
$celn5=0;
$body=45;
$suhlas1="";
$suhlas2="";
$suhlas3="";
$suhlas4="";
$suhlas5="";
$reg="/[0-9].*/";

//TODO rozlisit kapitana  a nekapitana, najma pri kliknuti na suhlasim

if(isset($_POST['yes'])){
	//TODO upozornenia, ak vkladana hodnota nie je cislo
	$clen1=$_POST['c1'];
	if(preg_match($reg, $clen1)){
    echo "Match found!";
} else{
    echo "Match not found.";
}
	$clen2=$_POST['c2'];
		if(preg_match($reg, $clen2)){
    echo "Match found!";
} else{
    echo "Match not found.";
}
	$clen3=$_POST['c3'];
		if(preg_match($reg, $clen3)){
    echo "Match found!";
} else{
    echo "Match not found.";
}
	$clen4=$_POST['c4'];
		if(preg_match($reg, $clen4)){
    echo "Match found!";
} else{
    echo "Match not found.";
}
	$clen5=$_POST['c5'];
		if(preg_match($reg, $clen5)){
    echo "Match found!";
} else{
    echo "Match not found.";
}
	$sum = $clen1 + $clen2 + $clen3 + $clen4 + $clen5;

	if($body != $sum){
		//TODO alert
		echo "Súčet rozdelených bodov musi byt rovný počtu pridelených bodov!";
	}
	else{
		//TODO potvrdzovacie okno
		//TODO ulozenie do db
		echo "Sucet ok";

	}
	
	}
	
	if(isset($_POST['no'])){
		//TODO potvrdzovacie okno
		//TODO treba osetrit vypisanie len prihlaseneho pouzivatela ostatne z db
		$suhlas1="Nesuhlasim";
		$suhlas2="Nesuhlasim";
		$suhlas3="Nesuhlasim";
		$suhlas4="Nesuhlasim";
		$suhlas5="Nesuhlasim";
	}

?> 


<!DOCTYPE html>
<html lang="sk">

<head>
    <title>Zadanie 6</title>
    <meta charset="UTF-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

</head>

<body>
<div class="container">
<h2>Body: <?php echo $body;?></h2>
<form class="form-horizontal" method="post" action="index.php">
  <div class="form-group">
    <label class="control-label col-sm-2" >Clen1:</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" name="c1" >
    </div>	
	<label class="control-label col-sm-1" ><?php echo $suhlas1;?></label>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" >Clen2:</label>
    <div class="col-sm-6"> 
      <input type="text" class="form-control" name="c2" >
    </div>
	<label class="control-label col-sm-1" ><?php echo $suhlas2;?></label>
  </div>
    <div class="form-group">
    <label class="control-label col-sm-2" >Clen3:</label>
    <div class="col-sm-6"> 
      <input type="text" class="form-control" name="c3" >
    </div>
	<label class="control-label col-sm-1" ><?php echo $suhlas3;?></label>
  </div>
    <div class="form-group">
    <label class="control-label col-sm-2" >Clen4:</label>
    <div class="col-sm-6"> 
      <input type="text" class="form-control" name="c4" >
    </div>
	<label class="control-label col-sm-1" ><?php echo $suhlas4;?></label>
  </div>
    <div class="form-group">
    <label class="control-label col-sm-2" >Clen5:</label>
    <div class="col-sm-6"> 
      <input type="text" class="form-control" name="c5" >
    </div>
	<label class="control-label col-sm-1" ><?php echo $suhlas5;?></label>
  </div>
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

</div>
</body>
</html>