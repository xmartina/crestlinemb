<?php
$pageName = "Confirm Stock Investments";
include_once("layouts/header.php");
$user_id = $row['id'];
require_once("userPinfunction.php");

$sql = "SELECT * FROM stock_investment WHERE id=:user_id";
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

<div id="content" class="main-content">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
<?=$user_data['id']; ?>