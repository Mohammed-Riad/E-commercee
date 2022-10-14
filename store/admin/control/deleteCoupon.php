<?php
require_once '../../views/connection.php';
$CouponID = $_GET['id'];

$sql = $connect->query("DELETE FROM Coupons WHERE coupon_id='$CouponID'");

header('location:../views/coupons.php?d=yes');

?>
