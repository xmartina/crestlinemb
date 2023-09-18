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
$investment_data['investment_plan_name'];

?>


    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="layout-top-spacing">
                <div class="row">
                    <div class="col-sm-1 d-none d-lg-block d-xl-block ">S/N</div>
                    <div class="col-sm-4 font-weight-bold">Plan Name</div>
                    .col-
                </div>
                <?php while ($investment_data = $get_investment_hold->fetch(PDO::FETCH_ASSOC)) { ?>
                <?php } ?>
                <div class="bg-white py-2 px-3 rounded-2 mb-1">
                    <div class="row">
                        <div class="col-sm-1 d-none d-lg-block d-xl-block ">1</div>
                        <div class="col-sm-2 font-weight-bold">Plan Name</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
include_once("layouts/footer.php");
?>