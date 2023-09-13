<?php
$pageName = "Confirm Stock Investments";
include_once("layouts/header.php");
require_once("userPinfunction.php");

$sql = "SELECT * FROM stock_investment ORDER BY date ASC, time ASC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$sn = 1;

$get_user_data = "SELECT * FROM users WHERE id=:user_id";
$user_data_hold = $conn->prepare($get_user_data);
$user_data_hold->execute([
    'user_id'=>$user_id
]);
$user_data = $user_data_hold->fetch(PDO::FETCH_ASSOC);
?>
