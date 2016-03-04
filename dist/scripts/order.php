<?php

session_start();

include_once ('db.php');

$orderNumber = $_REQUEST['order'];

$payment = "paypal";

$affected_rows = $db->exec("UPDATE orders SET payment = '$payment' WHERE orderNumber = '$orderNumber'");


if ($affected_rows > 0) {
    echo 1;
} else {
    print 0;
}


