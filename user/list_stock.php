<?php
$pageName = "Stock Investments";
include_once("layouts/header.php");
require_once("userPinfunction.php");

$sql = "SELECT * FROM stock_investment ORDER BY date ASC, time ASC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$sn = 1;
?>

    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="row layout-top-spacing">
                <div class="stock_container mt-3">
                    <div class="py-3 my-2 text-white bg-dark">
                        <div class="border_red_1">
                            <h5 class="ml-2 text-light">OUR INVESTMENT PACKAGES (RIO)</h5>
                        </div>
                        <hr class="hr-bg my-3">
                        <div class="row">
                            <?php
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                            <div class="col-lg-4 plan_main_bg rounded shadow-sm">
                                <div class="text-center">
                                    <div class="h6 my-3 text-light"><?= $row['stock_title'] ?></div>
                                    <div class="text-danger h3 mb-1"><?= $row['stock_interest'] ?> %</div>
                                    <div class="text-light text-capitalize mb-3">After <?= $row['stock_duration'] ?> Days</div>
                                    <div class="h6 mb-2">Min : USD<?= $row['stock_amount_min'] ?></div>
                                    <div class="h6 mb-2">Max : USD<?= $row['stock_amount_max'] ?></div>
                                    <a href="<?php if ($row['stock_status'] == 1) { ?> ./confirm_stock_investment.php?id=<?php echo $row['stock_id']; ?> <?php }elseif($row['stock_status'] == 2){ ?> javascript:void(0); <?php } ?>" class="btn bg-danger text-light my-3">
                                        <button class="btn bg-danger text-light px-3 py-2 <?php if ($row['stock_status'] == 2) { ?> disabled <?php } ?>"> Invest</button>
                                    </a>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


<?php
include_once("layouts/footer.php");
?>