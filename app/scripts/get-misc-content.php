<?php

include_once ('db.php');



$stmt = $db->query("SELECT * FROM misc_content");

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$contentArray = array();

$contentArray['subtitle'] = $rows[0]['content'];
$contentArray['slidetitle1'] = $rows[1]['content'];
$contentArray['slidetitle2'] = $rows[2]['content'];
$contentArray['slidetitle3'] = $rows[3]['content'];
$contentArray['instragram'] = $rows[4]['content'];
$contentArray['twitter'] = $rows[5]['content'];
$contentArray['facebook'] = $rows[6]['content'];
$contentArray['supportContent'] = $rows[7]['content'];
$contentArray['aboutContent'] = $rows[8]['content'];



echo json_encode($contentArray, JSON_PRETTY_PRINT);