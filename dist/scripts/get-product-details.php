<?php

include_once ('db.php');

$id = $_REQUEST['id'];

$stmt = $db->query("SELECT * FROM products WHERE id = $id");

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($rows, JSON_PRETTY_PRINT);