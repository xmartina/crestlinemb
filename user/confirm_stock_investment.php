<?php
$pageName = "Confirm Stock Investments";
include_once("layouts/header.php");
require_once("userPinfunction.php");
$investment_id = $_GET['id'];
require_once ('investment_id_generator.php');
$investment_ref_id = $randomString;

$sql = "SELECT * FROM stock_investment WHERE stock_id=:investment_id";
$stmt = $conn->prepare($sql);
$stmt->execute([
    'investment_id' => $investment_id
]);

$invest_data = $stmt->fetch(PDO::FETCH_ASSOC);
$stock_investment_id = $invest_data['stock_id'];
$invest_title = $invest_data['stock_title'];
$invest_min = $invest_data['stock_amount_min'];
$invest_max = $invest_data['stock_amount_max'];
$investment_plan_name = $invest_data['stock_title'];
$stock_interest = $invest_data['stock_interest'];

$get_user_data = "SELECT * FROM users WHERE id=:user_id";
$user_data_hold = $conn->prepare($get_user_data);
$user_data_hold->execute([
    'user_id' => $user_id
]);
$user_data = $user_data_hold->fetch(PDO::FETCH_ASSOC);
$user_id = $user_data['id'];
$user_balance = $user_data['acct_balance'];
require_once('investment_id_generator.php');

if(isset($_POST['invest_now'])){
    $amount_invested = $_POST['confirm_invest_amount'];

    if($amount_invested = ''){
        toast_alert('error', 'you did not specify how much you are investing');
    }elseif ($amount_invested > $user_balance){
        toast_alert('error', 'you did not have sufficient balance for this plan');
    }elseif ($amount_invested < $invest_min ){
        toast_alert('error', 'you can not invest lesser than the plan price');
    }elseif ($amount_invested > $invest_max){
        toast_alert('error', 'you can not invest higher than the plan price');
    }else{
        $plan_returns = $stock_interest * $amount_invested;
        $investment_status = "running";
        $insert_investment = "INSERT INTO investments (user_id, stock_investment_id,investment_ref_id, investment_plan_name, amount_invested, plan_returns, investment_status) VALUES (:user_id,:stock_investment_id,:investment_ref_id,:investment_plan_name,:amount_invested,:plan_returns,:investment_status)";
        $insert_invest_db = $conn->prepare($insert_investment);
        $hold_invest = $insert_invest_db ->execute([
            'user_id'=>$user_id,
            'stock_investment_id'=>$stock_investment_id,
            'investment_ref_id'=>$investment_ref_id,
            'investment_plan_name'=>$investment_plan_name,
            'amount_invested'=>$amount_invested,
            'plan_returns'=>$plan_returns,
            'investment_status'=>$investment_status
            ]);
    }
}
?>

    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="row layout-top-spacing">

                <div class="col-xl-4 col-lg-4 col-md-6 layout-spacing offset-4">
                    <div class="plan-box p-4 bg-white shadow-sm rounded p-2">
                        <h5 class="my-3 text-capitalize">you are about to invest into</h5>
                        <div class="pt-2"><?= $invest_title ?></div>
                        <div class="row">
                            <div class="col-md-11 mx-auto">
                                <form method="post">
                                    <label for="">Input your investment amount below to confirm this deal</label>
                                    <input type="text"  name="confirm_invest_amount" class="form-control" id="" placeholder="Investment Amount:" required>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <button type="submit" name="invest_now" class="btn btn-primary mt-3">Invest Now</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require_once ('layouts/footer.php'); ?>
