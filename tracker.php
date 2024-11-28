<?php     
// Database connection
include 'db.php';  // Assuming you have a separate DB connection file
$itemsPerPage = 8;  // Set the number of items per page
$pageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1;  // Get current page number (default is 1)
$offset = ($pageNumber - 1) * $itemsPerPage;  // Calculate offset for SQL query

// Get total number of items in the table
$totalItemsQuery = "SELECT COUNT(*) AS total FROM additem";
$totalResult = mysqli_query($conn, $totalItemsQuery);
$totalItems = mysqli_fetch_assoc($totalResult)['total'];
$totalPages = ceil($totalItems / $itemsPerPage);  // Calculate total number of pages

// Fetch current page's items from the database, ordered by the latest transaction
$sql = "SELECT * FROM additem ORDER BY date DESC LIMIT $offset, $itemsPerPage";
$result  = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
    
    <title>Transaction Details</title>
    <style>
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

        .navbar h1 {
            margin: 0;
        }

        /* Container adjustment */
        .container {
            margin: 20px auto;
            max-width: 1200px; /* Max width for the container */
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .search-container {
            margin-bottom: 20px;
            width: 100%;
            padding: 10px;
            max-width: 500px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .search-container input {
            padding: 10px;
            width: 80%;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .green-button, .add {
            padding: 8px 15px;
            font-size: 14px;
            justify-content: space-between;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 5px;
            text-align: center;
            margin-left:550px;
            margin-bottom:-200px;
            margin-top:-100px;
        }

        .add {
            background-color: green;
           

        }

        .add:hover {
            background-color: #0056b3;
        }
        .green-button, .filter {
            padding: 8px 15px;
            font-size: 14px;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 5px;
            text-align: center;
        }

        .button-container{
            margin-top: -68px;
            margin-right: 55px;
        }
        .green-button {
            background-color: green;
            
        }

        .green-button:hover {
            background-color: darkgreen;
        }

        .filter {
            background-color: green;
        }

        .filter:hover {
            background-color: #0056b3;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border: 1px solid #ccc;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ccc; /* Border for table cells */
        }

        th {
            background-color: #1C4E80;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2; /* Light gray background for even rows */
        }

        tr:nth-child(odd) {
            background-color: white; /* White background for odd rows */
        }

        tr:hover {
            background-color: #f1f1f1; /* Light gray hover effect */
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

    </style>
</head>
<body>



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
            <h1>Transaction Details</h1>
        </div>

        <div class="container">

            <!-- Buton Container for Add New Record and Filter -->
            <div class="search-container">
                <input type="text" id="search" placeholder="Search for equipment..." onkeyup="filterTable()">
                <button type="button" class="filter">Filter</button>
 
            </div>
            <div class="button-container">
            <button onclick="window.location.href='addform.php'" class="add">Add new record</button>
         
            </div>
            <!-- Transaction Table -->
            <table id="trackerTable">
          
                <thead>
                    <tr>
                        <th>Item ID</th>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Employee ID</th>
                        <th>Last Checked</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($row = mysqli_fetch_assoc($result)){
                            ?>
                                <tr>
                                    <td><?= $row['id']?></td>
                                    <td><?= $row['item']?></td>
                                    <td><?= $row['quantity']?></td>
                                    <td><?= $row['status']?></td>
                                    <td><?= $row['employee id']?></td>
                                    <td><?= $row['date']?></td>
                                </tr>
                            <?php
                        }
                    ?>
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

    <script>
        function filterTable() {
            const filter = document.getElementById("search").value.toUpperCase();
            const table = document.getElementById("trackerTable");
            const rows = table.getElementsByTagName("tr");

            for (let i = 1; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName("td");
                let match = false;

                for (let j = 0; j < cells.length; j++) {
                    const cell = cells[j];
                    if (cell) {
                        if (cell.textContent.toUpperCase().indexOf(filter) > -1) {
                            match = true;
                        }
                    }
                }

                if (match) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }
    </script>
</body>
</html>
