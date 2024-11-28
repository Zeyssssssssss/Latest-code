<?php
// Database connection
include 'db.php'; 

$itemsPerPage = 8; // Set number of items per page
$pageNumber = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1; // Current page, default is 1
$offset = ($pageNumber - 1) * $itemsPerPage; // Calculate offset

// Get total item count for pagination
$totalItemsQuery = "SELECT COUNT(*) AS total FROM borrow";
$totalResult = mysqli_query($conn, $totalItemsQuery);
$totalItems = mysqli_fetch_assoc($totalResult)['total'];
$totalPages = ceil($totalItems / $itemsPerPage); // Calculate total pages

// Fetch paginated data
$sql = "SELECT * FROM borrow ORDER BY id DESC LIMIT $offset, $itemsPerPage";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
    <title>Borrow</title>
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #DADADA;
        }

        /* Sidebar styling */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background-color: #333;
            display: flex;
            flex-direction: column;
            padding-top: 20px;
            padding-bottom: 260px;
        }

        .sidebar a, .Btn {
            padding: 15px 20px;
            text-decoration: none;
            font-size: 18px;
            color: #fff;
            display: block;
            transition: all 0.3s ease;
            margin-bottom: 5px;
        }

        .sidebar a i {
            margin-right: 10px;
        }

        /* Hover effect */
        .sidebar a:hover, .Btn:hover {
            background-color: #555;
            transform: scale(1.05);
            color: #f0f0f0;
        }

        /* Main content */
        .main-content {
            margin-left: 260px;
            padding: 20px;
            flex-grow: 1;
        }
        .navbar {
            background-color: #333;
            padding: 15px;
            color: white;
            text-align: center;
        }

        .navbar h2 {
            margin: 0;

        }
        .container {
            max-width: 1300px;
            margin: auto;
            margin-top: 5px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }

        .green-button {
            background-color: green; 
            color: white; 
            border: none; 
            padding: 8px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px; 
            cursor: pointer;
            border-radius: 5px;
            margin-right: 0; /* Remove the margin-right to align properly */
        }

        .green-button:hover {
            background-color: darkgreen; 
        }

        /* Search bar styling */
        .search-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            margin-right: 654px;
        }

        .search-bar input {
            padding: 0.5rem;
            width: 300px;
            font-size: 16px;
        }

        .inventory-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: white;
        }

        .inventory-table th, .inventory-table td {
            padding: 0.75rem;
            border: 1px solid #ddd;
            text-align: left;
        }

        .inventory-table th {
            background-color: #1C4E80;
            font-weight: bold;
            color:white;
        }

        .inventory-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .inventory-table tr:hover {
            background-color: #f1f1f1;
        }

/* Pagination styling */
.pagination {
    margin-top: 20px;
    margin-right: 20px; /* Move pagination to the right corner */
    text-align: right; /* Align items to the right */
}

.pagination a {
    padding: 8px 15px;
    margin: 0 5px;
    text-decoration: none;
    background-color: transparent; /* Remove background when not hovered */
    color: #1C4E80; /* Set text color to match the pagination number */
    border-radius: 5px;
    transition: all 0.3s ease; /* Smooth transition for hover effects */
}

/* Hover effect */
.pagination a:hover {
    background-color: #0056b3; /* Change background on hover */
    transform: scale(1.1); /* Slightly enlarge the number on hover */
    color: white; /* Text color remains white when hovered */
}

.pagination .active {
    background-color: #007bff; /* Active page number background */
    color: white; /* Active page number text color */
}

/* Disabled state for pagination (for previous/next buttons) */
.pagination .disabled {
    padding: 8px 15px;
    margin: 0 5px;
    background-color: #ccc;
    color: #888;
    cursor: not-allowed;
}


.button-container{
    color: green;
}
    </style>
</head>
<body>
    <?php include 'message.php';?>
<!-- Sidebar -->
<div class="sidebar">
    <a href="dashboard.php"><i class="fa-solid fa-tachometer-alt"></i> Dashboard</a>
    <a href="inventory.php"><i class="fa-solid fa-file-alt"></i> Borrow</a>
    <a href="stocks.php"><i class="fa-solid fa-boxes"></i> Stocks</a>    
    <a href="tracker.php"><i class="fa-solid fa-map-marker-alt"></i> Transaction Details</a>
    <a href="login.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
</div>

<!-- Main content -->
<div class="main-content">
        
<div class="navbar">
            <h2>Borrow </h2>
        </div>
    <!-- Container -->
    <div class="container">

        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search Inventory...">

        </div>
        <div clas="add-button">
        <form method="post" action="addstock.php">
                <button type="submit" name="myButton" class="green-button">Add New Record</button>
            </form>
</div>
        <div class="table-container">
            <table class="inventory-table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Item ID</th>
                        <th>Item Name</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Employee ID</th>
                        <th>Employee Name</th>
                        <th>Status</th>
                        


                    </tr>
                </thead>
                <tbody id="tableBody">
    <?php if ($result && mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['item_id']) ?></td>
                <td><?= htmlspecialchars($row['item_name']) ?></td>
                <td><?= htmlspecialchars($row['cate']) ?></td>
                <td><?= htmlspecialchars($row['quan']) ?></td>
                <td><?= htmlspecialchars($row['emp_id']) ?></td>
                <td><?= htmlspecialchars($row['emp_name']) ?></td>
                <td><?= htmlspecialchars($row['status']) ?></td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="8" style="text-align: center;">No records found</td>
        </tr>
    <?php endif; ?>
</tbody>


            </table>

<!-- Pagination -->
<div class="pagination">
    <?php if ($pageNumber > 1): ?>
        <a href="?page=<?= $pageNumber - 1 ?>">Previous</a>
    <?php else: ?>
        <span class="disabled">Previous</span>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="?page=<?= $i ?>" class="<?= $i == $pageNumber ? 'active' : '' ?>"><?= $i ?></a>
    <?php endfor; ?>

    <?php if ($pageNumber < $totalPages): ?>
        <a href="?page=<?= $pageNumber + 1 ?>">Next</a>
    <?php else: ?>
        <span class="disabled">Next</span>
    <?php endif; ?>
</div>
            </div>
        </div>
</div>
</body>
</html>