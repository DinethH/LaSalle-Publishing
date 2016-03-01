<?php

session_start();

include_once ('db.php');

    
if ($_SESSION['username'] == "admin" && $_SESSION['passcode'] = "3463") {
    print 1;
} else {
    print 0;
}
