<?php

session_start();

include_once ('db.php');

$username = $_REQUEST['username'];
$password = sha1($_REQUEST['password']);

$stmt = $db->query("SELECT * FROM users WHERE username = '$username' AND password = '$password'");

if ($rows = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
    $_SESSION['passcode'] = "3463";
    print 1;
} else {
    print 0;
}

