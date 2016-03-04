<?php

session_start();

include_once ('db.php');

$orderNumber = $_REQUEST['orderNumber'];

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

jsonOut ($rows);
