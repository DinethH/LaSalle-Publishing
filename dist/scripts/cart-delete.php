<?php

session_start();

include_once ('db.php');

$itemID = $_REQUEST['id'];

$key = array_search($itemID, ($_SESSION['cart']));



if ($_SESSION['cart']) {
    unset($_SESSION['cart'][$key]);
    print 1;
} else {
    print 0;
}

?>
