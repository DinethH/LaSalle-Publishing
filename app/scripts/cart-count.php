<?php

session_start();

include_once ('db.php');

if ($_SESSION['cart']) {
    $count = (count($_SESSION['cart']));
    jsonOut ($count);
}
else {
    jsonOut (0);
}