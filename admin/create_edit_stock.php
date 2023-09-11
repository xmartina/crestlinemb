<?php
require_once ("./layout/header.php");
?>

<?php
if (isset($_POST['submit'])) {
    $stock_title = $_POST['stock_title'];
    $stock_amount = $_POST['stock_amount'];
    $stock_interest = $_POST['stock_interest'];
    $stock_duration = $_POST['stock_duration'];
    $stock_status = $_POST['stock_status'];

// SQL query to insert data into the database
    $sql = "INSERT INTO stock_investment (stock_title, stock_amount, stock_interest, stock_duration, stock_status)
            VALUES ('$stock_title', '$stock_amount', '$stock_interest', '$stock_duration', '$stock_status')";

    if(true){
        toast_alert('success','Plan added successfully','Approved');



    }else{
        toast_alert('error','Sorry something went wrong');


    }

    header('Location:'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
    die;


}
?>

<h2 class="mt-5 pt-5">Insert Stock Information</h2>
<form method="POST">
    <label for="stock_title">Stock Title:</label>
    <input type="text" name="stock_title" required><br><br>

    <label for="stock_amount">Stock Amount:</label>
    <input type="number" name="stock_amount" required><br><br>

    <label for="stock_interest">Stock Interest:</label>
    <input type="number" name="stock_interest" required>%<br><br>

    <label for="stock_duration">Stock Duration:</label>
    <input type="number" name="stock_duration" required><br><br>

    <label for="stock_status">Stock Status:</label>
    <select name="stock_status" required>
        <option value="Active">Active</option>
        <option value="Inactive">Inactive</option>
    </select><br><br>

    <input type="submit" name="create_stock" value="Submit">
</form>

