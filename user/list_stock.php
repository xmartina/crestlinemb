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

                <?php
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 layout-spacing">
                        <div class="widget widget-three">
                            <div class="widget-heading">
                                <h5 class=""><?= $row['stock_title'] ?></h5>
                            </div>
                            <div class="widget-content">
                                <div class="py-1"><span class="font-weight-bold text-black mr-2">Plan Price: </span>
                                    <span
                                        class="text-muted"><?= $row['stock_amount_min'] ?></span> - <span
                                        class="text-muted"><?= $row['stock_amount_max'] ?> USD</span></div>
                                <div class="py-1"><span
                                        class="font-weight-bold text-black mr-2">Plan Interest: </span> <span
                                        class="text-muted"><?= $row['stock_interest'] ?> %</span></div>
                                <div class="py-1"><span
                                        class="font-weight-bold text-black mr-2">Plan Duration: </span> <span
                                        class="text-muted"><?= $row['stock_duration'] ?> Days</span></div>
                                <div class="py-1"><span
                                        class="font-weight-bold text-black mr-2">Plan Status: </span> <?php if ($row['stock_status'] == 1) { ?>
                                        <span
                                            class="text-muted">Active</span><?php } elseif ($row['stock_status'] == 2) { ?>
                                        <span
                                            class="text-muted">Inactive</span><?php } ?>
                                </div>

                                <div class="form-group my-3">
                                    <a href="<?php if ($row['stock_status'] == 1) { ?> ./confirm_stock_investment.php?id=<?php echo $row['stock_id']; ?> <?php }elseif($row['stock_status'] == 2){ ?> javascript:void(0); <?php } ?>">
                                        <button class="btn btn-primary <?php if ($row['stock_status'] == 2) { ?> disabled <?php } ?>"> Invest</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <div class="stock_container mt-3">
                    <div class="py-3 my-2 text-white border_red_1 bg-dark">
                        <div class="row">
                            <div class="col-lg-12">
                                <h5 class="ml-2 text-light">OUR INVESTMENT PACKAGES (RIO)</h5>
                            </div>
                        </div>
                        <hr class="hr-bg my-3">
                        <div class="row">
                            <div class="col-lg-4"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


<?php
include_once("layouts/footer.php");
?>