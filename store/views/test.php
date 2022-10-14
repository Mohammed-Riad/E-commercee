<?php require 'connection.php'; ?>

<?php
$search = '';

$sql = $connect->query(
    "SELECT product_name , price FROM products WHERE product_name LIKE '%$search%' AND price BETWEEN 10 AND 50"
);
$result = $sql->fetchAll();

print_r($result);


?>
