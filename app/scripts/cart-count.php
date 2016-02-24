<?php

session_start();

include_once ('db.php');

if ($_SESSION['cart'])
    print(count($_SESSION['cart']));
else
    print 0;