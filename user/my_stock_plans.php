<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$pageName = "My Stock Investments";
include_once("layouts/header.php");
require_once("userPinfunction.php");

//get user data
$get_user_data = "SELECT * FROM users WHERE id=:user_id";
$user_data_hold = $conn->prepare($get_user_data);
$user_data_hold->execute([
    'user_id' => $user_id
]);
$user_data = $user_data_hold->fetch(PDO::FETCH_ASSOC);
$user_id = $user_data['id'];

//fetch investment data
$get_investment_data = "SELECT * FROM investments WHERE user_id=:user_id";
$get_investment_hold = $conn->prepare($get_investment_data);
$get_investment_hold->execute([
    'user_id' => $user_id
]);
$investment_data = $get_investment_hold->fetch(PDO::FETCH_ASSOC);
$stock_id = $investment_data['stock_investment_id'];

//fetch stock data
$get_stock_data = "SELECT * FROM stock_investment WHERE stock_id=:stock_id";
$get_stock_hold = $conn->prepare($get_stock_data);
$get_stock_hold->execute([
    'stock_id' => $stock_id
]);
$stock_data = $get_stock_hold->fetch(PDO::FETCH_ASSOC);
$stock_duration = $stock_data['stock_duration'];
//$investment_data['investment_plan_name'];

?>


    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="layout-top-spacing">
                <div class="row">
                    <div class="col-lg-1 d-none d-lg-block d-xl-block  d-sm-none d-md-none d-lg-block d-xl-block">S/N</div>
                    <div class="col-lg-4 font-weight-bold d-none d-lg-block d-xl-block">Plan Name</div>
<!--                    <div class="col-lg-2 font-weight-bold d-none d-lg-block d-xl-block">Duration</div>-->
                    <div class="col-lg-2 font-weight-bold d-none d-lg-block d-xl-block">Returns</div>
                    <div class="col-lg-1 font-weight-bold d-none d-lg-block d-xl-block">Status</div>
                    <div class="col-lg-4 font-weight-bold d-none d-lg-block d-xl-block">Plan Reference No</div>
                </div>
                <div class="my-4"></div>
                <?php while ($investment_data = $get_investment_hold->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="bg-white py-2 px-3 rounded-2 mb-1">
                    <div class="row gy-2">
                        <div class="col-lg-1 d-none d-lg-block d-xl-block ">1</div>
                        <div class="col-lg-4 col-md-6 col-sm-12 font-weight-bold"> <span class="d-lg-none d-xl-none d-md-block d-sm-block mr-2">Plan Name</span> <?=$investment_data['investment_plan_name'] ?></div>
                        <div class="d-lg-none d-xl-none d-md-block d-sm-block my-3"></div>
<!--                        --><?php //} ?>
<!--                        --><?php //while ($stock_data = $get_stock_hold->fetch(PDO::FETCH_ASSOC)) { ?>
<!--                        <div class="col-lg-2 col-md-6 col-sm-12"> <span class="d-lg-none d-xl-none d-md-block d-sm-block mr-2">Plan Duration</span> --><?php //= $stock_data['stock_duration']; ?><!--</div>-->
<!--                        <div class="d-lg-none d-xl-none d-md-block d-sm-block my-3"></div>-->
                        <div class="col-lg-2 col-md-6 col-sm-12 font-weight-bold"><span class="d-lg-none d-xl-none d-md-block d-sm-block mr-2">Plan Returns</span> <?=$investment_data['plan_returns'] ?></div>
                        <div class="d-lg-none d-xl-none d-md-block d-sm-block my-3"></div>
                        <div class="col-lg-1 col-md-6 col-sm-12">
                            <?php if ($investment_data['investment_status'] == 0){ echo $invest_status; ?> <?php $invest_status ="Running"; ?><?php }elseif($investment_data['investment_status'] == 1){ echo $invest_status; ?> <?php $invest_status = "Completed"; ?> <?php } ?>

                            <span class="d-lg-none d-xl-none d-md-block d-sm-block mr-2">Status</span> <?= $invest_status ?></div>
                        <div class="d-lg-none d-xl-none d-md-block d-sm-block my-3"></div>
                        <div class="col-lg-4 col-md-6 col-sm-12 font-weight-bold"> <span class="d-lg-none d-xl-none d-md-block d-sm-block mr-2">Reference No</span> <?= $investment_data['investment_ref_id'] ?></div>
                        <div class="d-lg-none d-xl-none d-md-block d-sm-block my-3"></div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

<?php
include_once("layouts/footer.php");
?>