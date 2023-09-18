<?php
include_once("./layout/header.php");
//require_once("./include/adminloginFunction.php");
//include_once("../include/config.php");

$id = $_GET['id'];
$sql = "SELECT * FROM stock_investment WHERE stock_id =:id";
$data = $conn->prepare($sql);
$data->execute(['id' => $id]);

$row = $data->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['modify_stock'])) {
    $stock_title = $_POST['stock_title'];
    $stock_amount_min = $_POST['stock_amount_min'];
    $stock_amount_max = $_POST['stock_amount_max'];
    $stock_interest = $_POST['stock_interest'];
    $stock_duration = $_POST['stock_duration'];
    $stock_status = $_POST['stock_status'];
    $id = $_GET['id'];
    $stock_id = $id;

    $sql = "UPDATE stock_investment SET stock_id=:stock_id, stock_title=:stock_title, stock_amount_min=:stock_amount_min,stock_amount_max=:stock_amount_max, stock_interest=:stock_interest, stock_duration=:stock_duration, stock_status=:stock_status WHERE stock_id=:id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'stock_id' => $stock_id,
        'stock_title' => $stock_title,
        'stock_amount_min' => $stock_amount_min,
        'stock_amount_max' => $stock_amount_max,
        'stock_interest' => $stock_interest,
        'stock_duration' => $stock_duration,
        'stock_status' => $stock_status,
        'id' => $id
    ]);

    if ($stmt->rowCount() > 0) {
        $delay = 5;
        $redirectURL = "list_stock.php";
        toast_alert('success', 'Stock Plan Updated Successfully', 'Approved');
        header("refresh:$delay;url=$redirectURL");
    } else {
        toast_alert('error', 'Sorry something went wrong');
    }
}

if(isset($_POST['delete_stock_plan'])){
    $delete_stock_plan = $_POST['delete_stock_plan'];

    $sql = "DELETE FROM stock_investment WHERE stock_id =$id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        // '$status_delete'=>$status_delete
    ]);


    if(true){
        toast_alert('success','Stock Plan Deleted Successfully');
        $delay = 5;
        $redirectURL = "list_stock.php";
        toast_alert('success', 'Stock Plan Deleted Successfully', 'Approved');
        header("refresh:$delay;url=$redirectURL");
    }else{
        toast_alert('error', 'Sorry Something Went Wrong');
    }



}
?>


    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="row layout-top-spacing">
                <div id="basic" class="col-lg-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Edit Stock Information</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <div class="row">
                                <div class="col-lg-10 col-12 mx-auto">
                                    <form method="post">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-4">
                                                    <label for="">Stock Title:</label>
                                                    <input type="text" name="stock_title" class="form-control" id=""
                                                           placeholder="Stock Title:"
                                                           value="<?= $row['stock_title']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-4">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <label for="">Stock Amount Min: <span
                                                                    class="text-white bg-info p-1 rounded shadow-sm">USD</span>
                                                            </label>
                                                            <input type="number" name="stock_amount_min" class="form-control" id=""
                                                                   placeholder="Minimum Stock Amount:"
                                                                   value="<?= $row['stock_amount_min']; ?>">
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label for="">Stock Amount Max: <span
                                                                    class="text-white bg-info p-1 rounded shadow-sm">USD</span>
                                                            </label>
                                                            <input type="number" name="stock_amount_max" class="form-control" id=""
                                                                   placeholder="Maximum Stock Amount:"
                                                                   value="<?= $row['stock_amount_max']; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-4">
                                                    <label for="">Stock Interest: <span
                                                            class="text-white bg-info p-1 rounded shadow-sm">%</span>
                                                    </label>
                                                    <input type="number" name="stock_interest" class="form-control"
                                                           id="" placeholder="Stock Interest:"
                                                           value="<?= $row['stock_interest']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-4">
                                                    <label for="">Stock Duration: <span
                                                            class="text-white bg-info p-1 rounded shadow-sm">Days</span>
                                                    </label>
                                                    <input type="number" name="stock_duration" class="form-control"
                                                           id="" placeholder="Stock Duration:"
                                                           value="<?= $row['stock_duration']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-4">
                                                    <?php
                                                    if ($row['stock_status'] == 1) {
                                                        $stock_status = "Active";
                                                    } elseif ($row['stock_status'] == 2) {
                                                        $stock_status = "Inactive";
                                                    }
                                                    ?>
                                                    <label for="">Stock Status:</label>
                                                    <select name="stock_status" id="" class="form-control basic"
                                                            value="<?= $stock_status; ?>">
                                                        <option selected="selected"
                                                                disabled><?= $stock_status; ?></option>
                                                        <option value="1">Active</option>
                                                        <option value="2">Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-4">

                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 text-center">
                                                <button type="submit" name="modify_stock" class="btn btn-primary mt-3">
                                                    Modify Stock
                                                </button>
                                            </div>
                                            <div class="col-md-6 text-center">
                                                <button type="submit" name="delete_stock_plan" class="btn btn-primary bg-danger mt-3">
                                                    Delete Stock
                                                </button>
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
    </div>
<?php
require_once("./layout/footer.php");
?>