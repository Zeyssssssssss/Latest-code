<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return Record</title>
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
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 2rem;
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
            border: 1px solid grey;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #1C4E80;
            color:white;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination button {
            padding: 10px;
            margin: 0 5px;
            background-color: #333;
            color: white;
            border: none;
            cursor: pointer;
        }

        .pagination button:hover {
            background-color: #555;
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

            .small-boxes-container {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .small-box {
                width: 90%;
                margin: 10px 0;
            }

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
        <div class="navbar">
            <h1>Returned Record</h1>
        </div>
        <div class="transaction-container">
            <div class="table-container">
                <table class="transaction-table">
                    <thead>
                        <tr>
                            <th>Item ID</th>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Employee ID</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <tr>
                            <td>201</td>
                            <td>Item C</td>
                            <td>5</td>
                            <td>Single</td>
                            <td>200131</td>
                        </tr>
                        <tr>
                            <td>c2010334</td>
                            <td>Carl Catral</td>
                            <td>1 pero pwede 5</td>
                            <td>Single</td>
                            <td>2001334</td>
                        </tr>
                        <!-- More rows as needed -->
                    </tbody>
                </table>
          
    
</body>
</html>
