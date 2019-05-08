<?php
//DB

$servername = "localhost";
$username = "p";
$password = "webtech2";
$dbname = "projekt";
$conn;
$stmt;
$result;
$error;

function dbConnect(){
    global $servername;
    global $username;
    global $password;
    global $dbname;
    global $error;
    global $conn;
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return true;
    }catch(PDOException $e) {
        $error = $e->getMessage();
        return false;
    }
}
function dbClose(){
    global $conn;
    $conn = null;
}
function dbStatement($statement, $select){
    global $conn;
    global $stmt;
    global $result;

    $stmt = $conn->prepare("$statement");

    $stmt->execute();
    if($select){
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }
}
?>
