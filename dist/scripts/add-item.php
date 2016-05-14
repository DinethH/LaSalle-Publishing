<?php

session_start();

include_once ('db.php');

$title = $_REQUEST['title'];
$description = $_REQUEST['description'];
$price = $_REQUEST['price'];
$cover = $_SESSION['cover'];
$backdrop = "";
$ebook = $_SESSION['ebook'];
$video = "";
$zip = $_SESSION['zip'];




$stmt = $db->prepare("INSERT INTO products 
    (name, img, screenshot, description, price, ebook, zip) 
            VALUES(:name,:img,:screenshot,:description,:price,:ebook,:zip)");

$stmt->execute(array(':name' => $title, ':img' => $cover, ':screenshot' => $backdrop, 
            ':description' => $description, ':price' => $price, ':ebook' => $ebook, ':zip' => $zip));

            
$affected_rows = $stmt->rowCount();
if ($affected_rows > 0) {
    jsonOut (1);
} else {
    jsonOut (0);
}

