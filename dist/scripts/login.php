<?php

session_start();

include_once ('db.php');

$email = $_REQUEST['email'];
$password = sha1($_REQUEST['password']);

$stmt = $db->query("SELECT * FROM users WHERE email = '$email' AND password = '$password'");

if ($rows = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
    $_SESSION['email'] = $rows[0]['email'];
    $_SESSION['username'] = $rows[0]['username'];
    
    if ($rows[0]['username'] == "admin") {
        $_SESSION['passcode'] = "3463";
    }
    
    print 1;
} else {
    print 0;
}

