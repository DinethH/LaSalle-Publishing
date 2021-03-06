<?php

session_start();

include_once ('db.php');

$orderNumber = time() + rand(10000, 90000);

$items1 = $_SESSION['cart'];

$items = implode(",", $items1);

$email = $_REQUEST['email'];

$stmt1 = $db->query('SELECT ROUND(SUM(price), 2) AS total
          FROM products 
         WHERE id IN (' . implode(',', array_map('intval', $items1)) . ')');

$rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

$total = $rows1[0]['total'];

$payment = "created";

$stmt = $db->prepare("INSERT INTO orders 
    (orderNumber, items, total, email, payment) 
            VALUES(:orderNumber,:items,:total,:email,:payment)");

$stmt->execute(array(':orderNumber' => $orderNumber, ':items' => $items,':total' => $total, ':email' => $email, ':payment' => $payment));

            
$affected_rows = $stmt->rowCount();
if ($affected_rows > 0) {
    jsonOut ($orderNumber);
} else {
    jsonOut (0);
}


