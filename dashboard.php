<?php

include 'db.php';

$sql = "SELECT * FROM additem ";
$result  = mysqli_query($conn, $sql);

$ssql = "SELECT * FROM borrow";
$eresult  = mysqli_query($conn, $ssql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
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

        /* Main content styling */
        .main-content {
            margin-left: 250px;
            padding: 20px;
            
        }

        /* Container and table styling */
        .container {
            max-width: 1000px;
            margin: auto;
            margin-top: 30px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }

        h1 {
            color: #333;
            font-style: italic;
        }

        /* Transaction container styling */
        .transaction-container {
            background-color: #f4f4f4;
            padding: 1.5rem;
            margin-top: 20px;
            border-radius: 5px;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
        }

        /* Table styling */
        .transaction-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .transaction-table thead {
            background-color: grey;
        }

        .transaction-table th, .transaction-table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
           
        }

        .transaction-table tbody tr:nth-child(even) {
            background-color: #cedccc;
        }

        /* Table container for responsive layout */
        .table-container {
            overflow-x: auto;
            width: 100%;
        }
        th, td {
            padding: 12px;
            text-align: left;
            width:  600px;
        }

        th {
            background-color: #1C4E80;
            color:white;

        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: 100%;
                height: auto;
                position: fixed;
                top: 0;
                left: 0;
                z-index: 1000;
            }

            .main-content {
                margin-left: 0;
                padding: 10px;

            }

            .small-boxes-container {
                display: flex;
                flex-direction: column;
                align-items: center;
                
            }

            .small-box {
                width: 90%;
                margin: 10px 0;
            }

            /* Ensure tables can scroll horizontally on smaller screens */
            .transaction-table th, .transaction-table td {
                white-space: nowrap;
            }

            .table-container {
                display: block;
                overflow-x: auto;
            }
            
        }

        /* Button to toggle sidebar on mobile */
        .menu-toggle {
            display: none;
            padding: 10px;
            background-color: #333;
            color: white;
            border: none;
            position: fixed;
            top: 10px;
            left: 10px;
            cursor: pointer;
            z-index: 1001;
        }
/* ////////////////small box 1/////////////////////////// */
        .small-boxes-container {
            display: flex;
            gap: 20px;
            margin-top: 20px;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .small-box {
            background-color:green;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4); /* Stronger shadow */
            text-align: center;
            width: 15%;
            min-width: 150px;
            transition: transform 0.3s ease;
          
        }

        .small-box:hover {
            transform: translateY(-5px);
        }

        .small-box h3 {
            margin: 0;
            color: white;
            font-size: 18px;
        }

        .small-box p {
            font-size: 20px;
            color: white;
            margin: 15px ;
            padding: 10px;
            border-radius: 25px;

        }
        /* ////////////////////////////////// */
        .small-boxes1-container {
            display: flex;
            gap: 20px;
            margin-top: 20px;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .small-box1 {
            background-color:#1f3f49;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4); /* Stronger shadow */
            text-align: center;
            width: 15%;
            min-width: 150px;
            transition: transform 0.3s ease;
          
        }

        .small-box1:hover {
            transform: translateY(-5px);
        }

        .small-box1 h3 {
            margin: 0;
            color: white;
            font-size: 18px;
        }

        .small-box1 p {
            font-size: 20px;
            color: white;
            
        }
        /* ///////////////small box2///////////////// */
        .small-boxes2-container {
            display: flex;
            gap: 20px;
            margin-top: 20px;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .small-box2 {
            background-color:#AC3E31;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4); /* Stronger shadow */
            text-align: center;
            width: 15%;
            min-width: 150px;
            transition: transform 0.3s ease;
          
        }

        .small-box2:hover {
            transform: translateY(-5px);
        }

        .small-box2 h3 {
            margin: 0;
            color: white;
            font-size: 18px;
        }

        .small-box2 p {
            font-size: 20px;
            color: white;
          
        }
/* ///////////small box3///////////////////// */
.small-boxes3-container {
            display: flex;
            gap: 20px;
            margin-top: 20px;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .small-box3 {
            background-color:#DBAE58;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4); /* Stronger shadow */
            text-align: center;
            width: 15%;
            min-width: 150px;
            transition: transform 0.3s ease;
          
        }

        .small-box3:hover {
            transform: translateY(-5px);
        }

        .small-box3 h3 {
            margin: 0;
            color: white;
            font-size: 18px;
        }

        .small-box3 p {
            font-size: 20px;
            color: white;
           
        }
    </style>
</head>
<body>
   

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <a href="dashboard.php"><i class="fa-solid fa-tachometer-alt"></i> Dashboard</a>
        <a href="inventory.php"><i class="fa-solid fa-file-alt"></i> Borrow</a>
        <a href="stocks.php"><i class="fa-solid fa-boxes"></i> Stocks</a>    
        <a href="tracker.php"><i class="fa-solid fa-map-marker-alt"></i> Transaction Details</a>
        <a href="login.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
    </div>

    <!-- Toggle button for mobile view -->
    <button class="menu-toggle" onclick="toggleSidebar()">☰ Menu</button>

    <!-- Main content -->
    <div class="main-content">
        <!-- Small Boxes Section -->
        <div class="small-boxes-container">
            <div class="small-box">
                <h3>Overall Transaction</h3>
                <p>2198</p>
            </div>
            <div class="small-box1">
                <h3>Available Stock</h3>
                <p>350 items</p>
            </div>
            <div class="small-box2">
                <h3>Returns Processed</h3>
                <p>75 items</p>
            </div>
            <div class="small-box3">
                <h3>Pending Orders</h3>
                <p>18 orders</p>
            </div>
        </div>

        <!-- Transaction Containers -->
        <div class="transaction-container">
            <h2> Borrowed</h2>
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
    <?php if ($eresult && mysqli_num_rows($eresult) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($eresult)): ?>
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
</div>
</div>

        <div class="transaction-container">
            <h2> Transaction Details</h2>
            <div class="table-container">
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
            </div>
        </div>

        <div class="transaction-container">
            <h2>Stocks </h2>
            <div class="table-container">
            <table class="stock-table-container" id="stock-table">
                    <thead>
                        <tr>
                            <th>Item ID</th>
                            <th>Item Name</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Quantity</th>
                            <th>Date</th>
                            
                          
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include 'db.php';

                            // Pagination Logic
                            $limit = 8;
                            $page = isset($_GET['page']) ? $_GET['page'] : 1;
                            $offset = ($page - 1) * $limit;

                            $sql = "SELECT * FROM stocks LIMIT $limit OFFSET $offset";
                            $result  = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($result)){
                                $idd = $row['id'];
                                ?>
                                <tr>
                                    
                                    <td><?= $row['id']?></td>
                                    <td><?= $row['itemid']?></td>
                                    <td><?= $row['itemname']?></td>
                                    <td><?= $row['category']?></td>
                                    <td><?= $row['quantity']?></td>
                                    <td>
                                       
                                    </td>
                                </tr>
                                <?php
                            }

                            // Total number of records for pagination
                            $count_sql = "SELECT COUNT(*) AS total FROM stocks";
                            $count_result = mysqli_query($conn, $count_sql);
                            $total_rows = mysqli_fetch_assoc($count_result)['total'];
                            $total_pages = ceil($total_rows / $limit);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.style.transform = sidebar.style.transform === 'translateX(0)' ? 'translateX(-100%)' : 'translateX(0)';
        }

        function searchTable() {
            let input = document.getElementById('search-bar');
            let filter = input.value.toUpperCase();
            let table = document.querySelector('.transaction-table');
            let tr = table.querySelectorAll('tr');
            
            tr.forEach(row => {
                let td = row.querySelectorAll('td');
                let match = false;
                td.forEach(cell => {
                    if (cell.textContent.toUpperCase().indexOf(filter) > -1) {
                        match = true;
                    }
                });
                row.style.display = match ? "" : "none";
            });
        }
    </script>
</body>
</html>
