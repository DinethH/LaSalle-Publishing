<?php

include_once ('db.php');

$stmt = $db->query('SELECT * FROM products');

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($rows, JSON_PRETTY_PRINT);