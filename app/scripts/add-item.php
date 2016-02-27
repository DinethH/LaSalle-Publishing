<?php

session_start();

include_once ('db.php');

$title = $_REQUEST['title'];
$description = $_REQUEST['description'];
$price = $_REQUEST['price'];
$cover = $_SESSION['cover'];
$backdrop = $_SESSION['backdrop'];
$ebook = $_SESSION['ebook'];
$video = $_SESSION['video'];

$stmt = $db->prepare("INSERT INTO products 
    (name, img, screenshot, description, price, ebook, video) 
            VALUES(:name,:img,:screenshot,:description,:price,:ebook,:video)");

$stmt->execute(array(':name' => $title, ':img' => $cover, ':screenshot' => $backdrop, 
            ':description' => $description, ':price' => $price, ':ebook' => $ebook, ':video' => $video));

            
$affected_rows = $stmt->rowCount();
if ($affected_rows > 0) {
    echo 1;
} else {
    print 0;
}

