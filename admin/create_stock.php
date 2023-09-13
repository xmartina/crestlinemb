<?php
require_once ("./layout/header.php");
?>

<?php
// Establish a database connection (replace with your database credentials)


if (isset($_POST['create_stock'])) {
    $stock_title = $_POST['stock_title'];
    $stock_amount = $_POST['stock_amount'];
    $stock_interest = $_POST['stock_interest'];
    $stock_duration = $_POST['stock_duration'];
    $stock_status = $_POST['stock_status'];
    $stock_id = str_pad(rand(0, 9999999999), 10, '0', STR_PAD_LEFT);

// SQL query to insert data into the database
    if (true) {
        $insert_stock = "INSERT INTO stock_investment (stock_id, stock_title, stock_amount, stock_interest, stock_duration, stock_status) VALUES (:stock_id, :stock_title, :stock_amount, :stock_interest, :stock_duration, :stock_status)";
        $stock_db = $conn->prepare($insert_stock);
        $stock_db->execute([
            'stock_id' => $stock_id,
            'stock_title' => $stock_title,
            'stock_amount' => $stock_amount,
            'stock_interest' => $stock_interest,
            'stock_duration' => $stock_duration,
            'stock_status' => $stock_status
        ]);
    }
    if (true) {
        $delay = 5;
        $redirectURL = "list_stock.php";
        toast_alert('success', 'Stock Plan Added Successfully', 'Approved');
        header("refresh:$delay;url=$redirectURL");

    } else {
        toast_alert('error', 'Sorry something went wrong');
    }
}
?>

<div id="content" class="main-content">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div id="basic" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Insert Stock Information</h4>
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
                                                <input type="text"  name="stock_title" class="form-control" id="" placeholder="Stock Title:" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label for="">Stock Amount: <span class="text-black bg-info p-2">USD</span>  </label>
                                                <input type="number"  name="stock_amount" class="form-control" id="" placeholder="Stock Amount:" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label for="">Stock Interest: <span class="text-black bg-info p-2">%</span>  </label>
                                                <input type="number"  name="stock_interest" class="form-control" id="" placeholder="Stock Interest:" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label for="">Stock Duration: <span class="text-black bg-info p-2">Days</span> </label>
                                                <input type="number"  name="stock_duration" class="form-control" id="" placeholder="Stock Duration:" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label for="">Stock Status:</label>
                                                <select name="stock_status" id="" class="form-control basic" required>
                                                    <option selected="selected">Select</option>
                                                    <option value="1">Active</option>
                                                    <option value="2">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <button type="submit" name="create_stock" class="btn btn-primary mt-3">Create Stock Investment</button>
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
require_once ("./layout/footer.php");
?>