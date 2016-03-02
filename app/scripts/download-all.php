<?php

session_start();

include_once ('db.php');

$orderNumber = $_REQUEST['orderNumber'];

$strDownloadFolder = "https://lasalle-publishing-dinethh.c9users.io/app/images/products/";

$stmt = $db->query("SELECT * 
          FROM orders 
         WHERE orderNumber = '$orderNumber' AND payment = 'paypal'");
         
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$items = $rows[0]['items'];
$items = explode(',', $items);


$stmt = $db->query('SELECT * 
      FROM products 
     WHERE id IN (' . implode(',', array_map('intval', $items)) . ')');

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$files = array();

foreach ($rows as $row) {
	$ebook = $strDownloadFolder.$row['ebook'];
	$video = $strDownloadFolder.$row['video'];
	
	array_push($files, $ebook, $video);

}

$zip = new ZipArchive();
$zip_name = time().".zip"; // Zip name
$zip->open($zip_name,  ZipArchive::CREATE);
foreach ($files as $file) {
  $path = $file;
  if(file_exists($path)){
  $zip->addFromString(basename($path),  file_get_contents($path));  
  }
  else{
   echo"file does not exist";
  }
}
$zip->close();


header('Content-Type: application/zip');
header('Content-disposition: attachment; filename='.$zip_name);
header('Content-Length: ' . filesize($zip_name));
readfile($zip_name);


