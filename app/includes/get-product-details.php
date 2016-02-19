<?php

include_once ('db.php');

$stmt = $db->query('SELECT * FROM products WHERE id = 1');

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($rows, JSON_PRETTY_PRINT);