<?php
require_once("./layout/header.php");
?>
<?php
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
                    <div class="col-xl-4 col-lg-4 col-md-6 layout-spacing">
                        <div class="plan-box p-4 bg-white shadow-sm rounded p-2">
                            <h5 class="my-3"><?= $row['stock_title'] ?></h5>
                            <div class="row">
                                <div class="col-md-11 mx-auto">
                                    <div class="py-1"><span class="font-weight-bold text-black mr-2">Plan Price: </span>
                                        <span
                                            class="text-muted"><?= $row['stock_amount'] ?> USD</span></div>
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
                                        <a href="./edit_stock.php?id=<?php echo $row['stock_id']; ?>">
                                            <button class="btn btn-primary"> Edit Plan</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                } ?>
            </div>
        </div>
    </div>
<?php
require_once("./layout/footer.php");
?>