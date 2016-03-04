<?php

include_once ('db.php');

$stmt = $db->query('SELECT * FROM products WHERE status = 1');

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

jsonOut($rows);