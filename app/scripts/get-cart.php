<?php

session_start();

include_once ('db.php');

if ($_SESSION['cart']) {
    $cartItemIDs = $_SESSION['cart'];
    
    $stmt = $db->query('SELECT * 
          FROM products 
         WHERE id IN (' . implode(',', array_map('intval', $cartItemIDs)) . ')');

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($rows, JSON_PRETTY_PRINT);
}
else {
    print 0;
}