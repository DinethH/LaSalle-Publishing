<?php

session_start();

include_once ('db.php');

if ($_SESSION['cart']) {
    $cartItemIDs = $_SESSION['cart'];
    
    $stmt = $db->query('SELECT ROUND(SUM(price), 2) AS total
          FROM products 
         WHERE id IN (' . implode(',', array_map('intval', $cartItemIDs)) . ')');

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    print json_encode(($rows[0]['total']), JSON_PRETTY_PRINT);
} else {
    print 0;
}