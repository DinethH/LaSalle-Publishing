<?php

session_start();

include_once ('db.php');

if (!$_SESSION['cart'])
    $_SESSION['cart'] = array(); 


if (strlen($_REQUEST['id']) > 0) {
    $item = $_REQUEST['id'];
    
    if (!in_array($item, $_SESSION['cart'])) {
        array_push($_SESSION['cart'], $item);  
    }
}


print_r($_SESSION['cart']);