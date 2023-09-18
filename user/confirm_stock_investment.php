<?php
$pageName = "Confirm Stock Investments";
include_once("layouts/header.php");
require_once("userPinfunction.php");
$investment_id = $_GET['id'];

$sql = "SELECT * FROM stock_investment WHERE stock_id=:investment_id";
$stmt = $conn->prepare($sql);
$stmt->execute([
    'investment_id' => $investment_id
]);

$invest_data = $stmt->fetch(PDO::FETCH_ASSOC);
$invest_id = $invest_data['stock_id'];
$invest_title = $invest_data['stock_title'];
$get_user_data = "SELECT * FROM users WHERE id=:user_id";
$user_data_hold = $conn->prepare($get_user_data);
$user_data_hold->execute([
    'user_id' => $user_id
]);
$user_data = $user_data_hold->fetch(PDO::FETCH_ASSOC);
$user_id = $user_data['id'];
$user_balance = $user_data['acct_balance'];
require_once('investment_id_generator.php');
?>

    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="row layout-top-spacing">

                <div class="col-xl-4 col-lg-4 col-md-6 layout-spacing offset-4">
                    <div class="plan-box p-4 bg-white shadow-sm rounded p-2">
                        <h5 class="my-3 text-capitalize"><?= $row['stock_title'] ?></h5>
                        <div class="row">
                            <div class="col-md-11 mx-auto">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?= $randomString; ?>