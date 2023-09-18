<?php
$pageName = "Confirm Stock Investments";
include_once("layouts/header.php");
$user_id = $row['id'];
require_once("userPinfunction.php");
$investment_id = $_GET['id'];

$sql = "SELECT * FROM stock_investment WHERE stock_id=:investment_id";
$stmt = $conn->prepare($sql);
$stmt->execute([
    'investment_id'=> $investment_id
]);

$invest_data = $stmt->fetch(PDO::FETCH_ASSOC);
$invest_id = $invest_data['stock_id'];
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
<?=$invest_id; ?>