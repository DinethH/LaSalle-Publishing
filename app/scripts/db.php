<?php


$servername = getenv('IP');

$db = new PDO("mysql:host=$servername;dbname=lasallepub;charset=utf8", 'dinethh', '');
