<?php

session_start();

include_once ('db.php');

$id = $_REQUEST['id'];
$status = 0;

if ($_SESSION['passcode'] == 3463) {
    $stmt = $db->prepare("UPDATE products SET status=? WHERE id=?");
    $stmt->execute(array($status, $id));
    $affected_rows = $stmt->rowCount();
    if ($affected_rows > 0) {
        jsonOut (1);
    } else {
        jsonOut (0);
    }
}