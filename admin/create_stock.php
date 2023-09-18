<?php
require_once ("./layout/header.php");
?>

<?php
// Establish a database connection (replace with your database credentials)
// Assuming you have already defined $conn for database connection

if (isset($_POST['create_stock'])) {
    $stock_title = $_POST['stock_title'];
    $stock_amount_min = $_POST['stock_amount_min'];
    $stock_amount_max = $_POST['stock_amount_max'];
    $stock_interest = $_POST['stock_interest'];
    $stock_duration = $_POST['stock_duration'];
    $stock_status = $_POST['stock_status'];

    if ($stock_amount_min >= $stock_amount_max) {
        toast_alert('error', 'Maximum investment should be greater than minimum');
    } else {
        // SQL query to insert data into the database
        $insert_stock = "INSERT INTO stock_investment (stock_title, stock_amount_min, stock_amount_max, stock_interest, stock_duration, stock_status) VALUES (:stock_title, :stock_amount_min, :stock_amount_max, :stock_interest, :stock_duration, :stock_status)";
        $stock_db = $conn->prepare($insert_stock);
        $result = $stock_db->execute([
            'stock_title' => $stock_title,
            'stock_amount_min' => $stock_amount_min,
            'stock_amount_max' => $stock_amount_max,
            'stock_interest' => $stock_interest,
            'stock_duration' => $stock_duration,
            'stock_status' => $stock_status
        ]);

        if ($result) {
            $delay = 5;
            $redirectURL = "list_stock.php";
            toast_alert('success', 'Stock Plan Added Successfully', 'Approved');
            header("refresh:$delay;url=$redirectURL");
        } else {
            toast_alert('error', 'Sorry something went wrong');
        }
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
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label for="">Stock Amount Min: <span class="text-white bg-info p-1 rounded shadow-sm">USD</span>  </label>
                                                        <input type="number"  name="stock_amount_min" class="form-control" id="" placeholder="Minimum Stock Amount:" required>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="">Stock Amount Max: <span class="text-white bg-info p-1 rounded shadow-sm">USD</span>  </label>
                                                        <input type="number"  name="stock_amount_max" class="form-control" id="" placeholder="Maximum Stock Amount:" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label for="">Stock Interest: <span class="text-white bg-info p-1 rounded shadow-sm">%</span>  </label>
                                                <input type="number"  name="stock_interest" class="form-control" id="" placeholder="Stock Interest:" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label for="">Stock Duration: <span class="text-white bg-info p-1 rounded shadow-sm">Days</span> </label>
                                                <input type="number"  name="stock_duration" class="form-control" id="" placeholder="Stock Duration:" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label for="">Stock Status:</label>
                                                <select name="stock_status" id="" class="form-control" required>
                                                    <option selected="selected" disabled>Select</option>
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