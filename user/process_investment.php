<?php
include_once("layouts/header.php");
require_once("userPinfunction.php");

// Assuming you've already established a database connection in $conn

// $user_id should be defined before using it in the SQL queries
//$user_id = 123; // Replace with the actual user ID

// Fetch user data
$get_user_data = "SELECT * FROM users WHERE id=:user_id";
$user_data_hold = $conn->prepare($get_user_data);
$user_data_hold->execute([
    'user_id' => $user_id
]);
$user_data = $user_data_hold->fetch(PDO::FETCH_ASSOC);
$user_acct_currency = $user_data['acct_currency'];

// Fetch investments that have expired
$query = "SELECT i.investment_date, i.plan_return, si.plan_duration
          FROM investments AS i
          JOIN stock_investment AS si ON i.stock_reference_id = si.reference_id
          WHERE i.user_id = :user_id AND DATE_ADD(i.investment_date, INTERVAL si.plan_duration DAY) <= CURDATE()";

$stmt = $conn->prepare($query);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();

$investments = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Update the user's account balance for each expired investment
foreach ($investments as $investment) {
    $investmentDate = $investment['investment_date'];
    $planReturn = $investment['plan_return'];
    $planDuration = $investment['plan_duration'];

    // Calculate the expiration date
    $expirationDate = date("Y-m-d", strtotime($investmentDate . " +{$planDuration} days"));

    // Update user_acct_bal if the investment has expired
    if ($expirationDate <= date("Y-m-d")) {
        $updateQuery = "UPDATE users SET user_acct_bal = user_acct_bal + :plan_return WHERE id = :user_id";

        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bindParam(':plan_return', $planReturn, PDO::PARAM_INT);
        $updateStmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $updateStmt->execute();
    }
}

echo "Account balances updated successfully for expired investments.";

// It's not clear where $planDuration should be used, so I've left it as an echo for your reference
echo $planDuration;
?>
