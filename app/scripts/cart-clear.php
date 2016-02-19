<?php

session_start();

include_once ('db.php');

if ($_SESSION['cart'])
    unset($_SESSION['cart']);


print_r($_SESSION['cart']);