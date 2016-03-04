<?php


$servername = getenv('IP');

$db = new PDO("mysql:host=$servername;dbname=lasallepub;charset=utf8", 'dinethh', '');

function jsonOut ($val) {
    $data = (json_encode($val, JSON_PRETTY_PRINT));
    if(array_key_exists('callback', $_GET)){
        header('Content-Type: text/javascript; charset=utf8');
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Max-Age: 3628800');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        $callback = $_GET['callback'];
        echo $callback.'('.$data.');';
    }else{
        // normal JSON string
        header('Content-Type: application/json; charset=utf8');
        echo $data;
    }
}
