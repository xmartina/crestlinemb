<?php
require_once ("./layout/header.php");
?>

<?php
// Establish a database connection (replace with your database credentials)
$servername = "localhost";
$username = "multistream6_crestlinemb";
$password = "+C@ppy126";
$dbname = "multistream6_crestlinemb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $stock_title = $_POST['stock_title'];
    $stock_amount = $_POST['stock_amount'];
    $stock_interest = $_POST['stock_interest'];
    $stock_duration = $_POST['stock_duration'];
    $stock_status = $_POST['stock_status'];

// SQL query to insert data into the database
    $sql = "INSERT INTO stock_investment (stock_title, stock_amount, stock_interest, stock_duration, stock_status)
            VALUES ('$stock_title', '$stock_amount', '$stock_interest', '$stock_duration', '$stock_status')";

    if ($conn->query($sql) === TRUE) {
        echo "Stock information inserted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
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

