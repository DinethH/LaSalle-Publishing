<?php

include_once ('db.php');

$q = $_REQUEST['q'];

$stmt = $db->query("SELECT content FROM misc_content WHERE field = '$q'");

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

jsonOut($rows[0]['content']);