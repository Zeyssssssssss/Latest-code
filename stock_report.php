<?php 
// Database configuration 
$host = 'localhost'; 
$username = 'root';  // Change to your DB username 
$password = '';      // Change to your DB password 
$dbname = 'transactions_db';  // Change to your database name 
 
// Create a new PDO connection 
try { 
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password); 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
} catch (PDOException $e) { 
    die("Connection failed: " . $e->getMessage()); 
} 
 
// Get the number of transactions to consider (default is 5) 
$transactions_limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 5; 
 
// Validate the limit to avoid too large numbers or invalid input 
if ($transactions_limit <= 0) { 
    $transactions_limit = 5; // Default to 5 if invalid input 
} 
 
// Query to fetch the last N transactions (using LIMIT) 
$query = "SELECT * FROM transactions ORDER BY transaction_date DESC LIMIT :limit"; 
$stmt = $pdo->prepare($query); 
$stmt->bindParam(':limit', $transactions_limit, PDO::PARAM_INT); 
$stmt->execute(); 
 
// Calculate the total quantity of stock based on the specified number of transactions 
$total_quantity = 0; 
 
echo "<html>"; 
echo "<head><title>Stock Report (Last $transactions_limit Transactions)</title></head>"; 
echo "<body>"; 
echo "<h1>Stock Report (Last $transactions_limit Transactions)</h1>"; 
 
// Form to change the number of transactions to display 
echo "<form method='GET' action=''>"; 
echo "  <label for='limit'>Number of Transactions:</label>"; 
echo "  <input type='number' id='limit' name='limit' value='$transactions_limit' min='1'>"; 
echo "  <input type='submit' value='Generate Report'>"; 
echo "</form>"; 
 
echo "<table border='1' cellpadding='5' cellspacing='0'>"; 
echo "<tr><th>ID</th><th>Transaction Date</th><th>Amount</th><th>Quantity</th><th>Description</th><th>Category</th><th>Customer ID</th></tr>"; 
 
// Fetch and display transactions, summing up the quantities 
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
    $total_quantity += $row['quantity']; // Add the quantity to the total 
 
    echo "<tr>"; 
    echo "<td>" . $row['id'] . "</td>"; 
    echo "<td>" . $row['transaction_date'] . "</td>"; 
    echo "<td>" . number_format($row['amount'], 2) . "</td>"; 
    echo "<td>" . $row['quantity'] . "</td>"; 
    echo "<td>" . $row['description'] . "</td>"; 
    echo "<td>" . $row['category'] . "</td>"; 
    echo "<td>" . $row['customer_id'] . "</td>"; 
    echo "</tr>"; 
} 
 
// Display the total quantity of stock from the specified transactions 
echo "<tr><td colspan='7'><strong>Total Quantity of Stock: $total_quantity</strong></td></tr>"; 
 
echo "</table>"; 
echo "</body>"; 
echo "</html>"; 
?>