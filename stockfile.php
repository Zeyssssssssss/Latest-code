<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
    <title> Stocks </title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            background-color: #DADADA;
        }

        /* Sidebar style */
        .sidebar {
            height: 100vh;
            width: 250px;
            background-color: #333;
            padding-top: 20px;
            position: fixed;
        }

        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
        }

        .sidebar a:hover {
            background-color: #575757;
        }

        /* Main content */
        .main-content {
            margin-left: 260px;
            padding: 20px;
            flex-grow: 1;
            box-sizing: border-box;
            background-color: #f9f9f9;
        }

        header {
            background-color: #333;
            color: white;
            padding: 1px;
            text-align: center;
        }

        .container {
            max-width: 1100px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-bottom: 1rem;
            color: #333;
        }

        /* Search bar styles */
        .search-bar {
            margin-bottom: 1rem;
            display: flex;
            justify-content: flex-end;
        }

        .search-bar input {
            padding: 0.5rem;
            width: 200px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* Stock table styles */
        .stock-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2rem;
        }

        .stock-table th,
        .stock-table td {
            padding: 0.75rem;
            border: 1px solid #ddd;
            text-align: left;
        }

        .stock-table th {
            background-color: #f4f4f4;
        }

        /* Button styles */
        button {
            padding: 0.75rem;
            border: none;
            border-radius: 4px;
            background-color: #333;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 1rem;
        }

        button:hover {
            background-color: #555;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: white;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            border-radius: 5px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .modal input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
        }


    </style>
</head>
<body>
    
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="dashboard.php"><i class="fa-solid fa-tachometer-alt"></i> Dashboard</a>
        <a href="inventory.php"><i class="fa-solid fa-file-alt"></i> Borrow </a>
        <a href="stocks.php"><i class="fa-solid fa-boxes"></i> Stocks</a>    
        <a href="tracker.php"><i class="fa-solid fa-map-marker-alt"></i>  Transaction Details</a>
    </div>

    <!-- Main content -->
    <div class="main-content">
        <header>
            <h1>Stocks Management</h1>
        </header>

        <div class="container">
            <div class="search-bar">
                <input type="text" id="search" placeholder="Search Stocks..." onkeyup="filterTable()">
            </div>

            <h2>Current Stock</h2>
            <table class="stock-table" id="stock-table">
                <thead>
                    <tr>
                        <th>Item ID</th>
                        <th>Item Name</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td data-label="Item ID">001</td>
                        <td data-label="Item Name">Excavator</td>
                        <td data-label="Category">Heavy Machinery</td>
                        <td data-label="Quantity">5</td>
                        <td data-label="Action">
                            <button onclick="editStock(this)">Edit</button>
                            <button onclick="deleteStock(this)" style="background-color: red;">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td data-label="Item ID">002</td>
                        <td data-label="Item Name">Bulldozer</td>
                        <td data-label="Category">Heavy Machinery</td>
                        <td data-label="Quantity">3</td>
                        <td data-label="Action">
                            <button onclick="editStock(this)">Edit</button>
                            <button onclick="deleteStock(this)" style="background-color: red;">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td data-label="Item ID">003</td>
                        <td data-label="Item Name">Backhoe Loader</td>
                        <td data-label="Category">Heavy Machinery</td>
                        <td data-label="Quantity">4</td>
                        <td data-label="Action">
                            <button onclick="editStock(this)">Edit</button>
                            <button onclick="deleteStock(this)" style="background-color: red;">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>

           <a href="stocking.php">Add New Stock</a>


          
                <tbody>
                    <?php
                        include 'db.php';
                        $sql = "SELECT * FROM stocks";
                        $result  = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_assoc($result)){
                            ?>
                                <tr>
                                    <td><?= $row['itemid']?></td>
                                    <td><?= $row['itemname']?></td>
                                    <td><?= $row['category']?></td>
                                    <td><?= $row['quantity']?></td>
                                    
                                </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
            
        </div>
    </div>

    <!-- Modal for editing stock -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Edit Stock</h2>

            <div class="inc">
                <label for="editItemId">Item ID</label>
                <input type="text" id="editItemId" readonly>

                <label for="editItemName">Item Name</label>
                <input type="text" id="editItemName">

                <label for="editCategory">Category</label>
                <input type="text" id="editCategory">

                <label for="editQuantity">Quantity</label>
                <input type="text" id="editQuantity">

                <button onclick="saveStock()">Save</button>
            </div>
        </div>
    </div>

    <style>
        .modal-content {
            width: 850px;
            position: relative;
            left: 140px;
            bottom: 70px;
        }

        .inc {
            width: 819px;
        }
    </style>

    <script>
        let currentRow;

        function editStock(button) {
            currentRow = button.parentElement.parentElement;
            const itemId = currentRow.cells[0].innerText;
            const itemName = currentRow.cells[1].innerText;
            const category = currentRow.cells[2].innerText;
            const quantity = currentRow.cells[3].innerText;

            document.getElementById("editItemId").value = itemId;
            document.getElementById("editItemName").value = itemName;
            document.getElementById("editCategory").value = category;
            document.getElementById("editQuantity").value = quantity;

            document.getElementById("editModal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("editModal").style.display = "none";
        }

        function saveStock() {
            const itemName = document.getElementById("editItemName").value;
            const category = document.getElementById("editCategory").value;
            const quantity = document.getElementById("editQuantity").value;

            currentRow.cells[1].innerText = itemName;
            currentRow.cells[2].innerText = category;
            currentRow.cells[3].innerText = quantity;

            closeModal();
        }

        // Delete row from table
        function deleteStock(button) {
            const row = button.parentElement.parentElement;
            row.remove();
        }

        // Filter table rows based on search input
        function filterTable() {
            const searchValue = document.getElementById("search").value.toLowerCase();
            const table = document.getElementById("stock-table");
            const rows = table.getElementsByTagName("tr");

            for (let i = 1; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName("td");
                let rowMatches = false;

                for (let j = 0; j < cells.length - 1; j++) { // Skip the action cell
                    if (cells[j].innerText.toLowerCase().indexOf(searchValue) > -1) {
                        rowMatches = true;
                        break;
                    }
                }

                rows[i].style.display = rowMatches ? "" : "none";
            }
        }
    </script>


<script>
    function deleteStock(button) {
        // Show confirmation dialog
        const confirmation = confirm("Are you sure you want to delete this item?");
        if (confirmation) {
            // If confirmed, delete the row
            const row = button.parentElement.parentElement;
            row.remove();
            alert("Item deleted successfully."); // Optional: Alert for successful deletion
        }
    }
</script>


</body>
</html>
