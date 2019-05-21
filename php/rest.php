<?php

//include_once TODO include members php files
include_once('./login.php');

header('Access-Control-Allow-Origin: *');
$request = $_SERVER['REQUEST_URI'];
$request = preg_replace('/\/team\/api\//',"",$request);
$request_parts = explode('/',$request);

$result = array();
switch($request_parts[0]){
    case 'login':
        //TODO $ret = someFunct();
        $result = login_funct($request_parts[1],$request_parts[2]);
        break;
    default:
        $result['err'] = 'Invalid function';
        break;
}

echo json_encode($result);

?>