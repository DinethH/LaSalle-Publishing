<?php

session_start();

include_once ('db.php');

if ($_SESSION['cart'])
    unset($_SESSION['cart']);


jsonOut (1);