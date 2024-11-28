<?php 
session_start();
include 'db.php';

if(isset($_POST['save'])){
    $itemid = trim($_POST['itemid']);
    $name = trim($_POST['name']);
    $cate = trim($_POST['cate']);
    $quan = trim($_POST['quan']);
    $empid = trim($_POST['emp_id']);
    $empname = trim($_POST['emp_name']);
    $status = trim($_POST['status']);
    $sql = "INSERT INTO borrow ( `item_id`,`item_name`, `cate`, `quan`, `emp_id`, `emp_name`, `status`) 
            VALUES ('$itemid', '$name', '$cate', '$quan', '$empid', '$empname', '$status')";

    $result = mysqli_query($conn, $sql);

    if($result){
        $_SESSION['message'] = "Data Saved Successfully";
        $_SESSION['message_type'] = "success";
        header("location: inventory.php");
       
    }else{
        $_SESSION['message'] = "Failed to Save Data";
        $_SESSION['message_type'] = "error";
    }
}
?>





    

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
    <title>New Record</title>
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
            margin-left: 260px; /* Adjust to sidebar width */
            padding: 20px;
            flex-grow: 1;
            height: 100%;
            overflow-y: auto;
        }

        /* Navbar styling */
        .navbar {
            background-color: #333;
            padding: 15px;
            color: white;
            text-align: center;
        }

        .navbar h1 {
            margin: 0;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input, select, textarea {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        label {
            font-weight: bold;
            color: #333;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .btn {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #218838;

            

        }
        <style>
/* Notification container */
.notification {
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 15px 20px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
    font-size: 16px;
    color: #fff;
    display: none; /* Hidden by default */
    z-index: 1000;
}

/* Success message */
.notification.success {
    background-color: #28a745; /* Green */
}

/* Error message */
.notification.error {
    background-color: #dc3545; /* Red */
}

/* Fade-in animation */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.notification.show {
    display: block;
    animation: fadeIn 0.5s ease-in-out;
}


</style>
</head>
<body>
    
<!-- Sidebar -->
<div class="sidebar">
    <a href="dashboard.php"><i class="fa-solid fa-tachometer-alt"></i> Dashboard</a>
    <a href="inventory.php"><i class="fa-solid fa-file-alt"></i> Borrow </a>
    <a href="stocks.php"><i class="fa-solid fa-boxes"></i> Stocks</a>    
    <a href="tracker.php"><i class="fa-solid fa-map-marker-alt"></i> Transaction Details</a>
    <a href="login.php"><i class="fa fa-sign-out-alt"></i> Logout</a>


</div>

<!-- Main content -->
<div class="main-content">
    <div class="navbar">
        <h1>New Record</h1>
    </div>

    <div class="container">
    <?php include 'message.php';?>
        <h2>Create New Record</h2>
        <form action="" method="post">
        <div class="form-group">
                <label for="item-name">Item Id:</label>
                <input type="number" id="item-name" name="itemid"  required>
            </div>
            <!-- Form group for Item Name -->
            <div class="form-group">
                <label for="item-name">Item Name:</label>
                <input type="text" id="item-name" name="name"  required>
            </div>

            <!-- Form group for Item Code -->
            <div class="form-group">
                <label for="employee">Category:</label>
                <select id="employee" name="cate" required>
                    <option value="">Select a Category</option>
                    <option value="construction">Construction</option>
                    <option value="machinery">Heavy Machinery</option>
                    <option value="tools">Tools</option>
                </select>
            </div>

            <!-- Form group for Date -->
            <div class="form-group">
                <label for="date">Quantity :</label>
                <input type="number" id="date" name="quan" required>
            </div>

            <!-- Form group for Employee Assigned -->
            <div class="form-group">
                <label for="date">Employee_id :</label>
                <input type="number" id="date" name="emp_id" required>
            </div>
            <!-- Form group for Remarks -->
            <div class="form-group">
                <label for="remarks">Employee Name:</label>
                <textarea id="remarks" name="emp_name" rows="4"></textarea>
            </div>
            <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="Item Returned">Item Returned</option>
                    <option value="Pending">Pending</option>
                    <option value="Lost">Lost</option>
                </select>

                <div class="lel">
                <label for="returned_date">Returned Date:</label>
                <input type="date" id="returned_date" name="returned_date" required>
                </div>

            <!-- Submit button -->
            <button type="submit" class="btn" name="save">Submit Record</button>
        </form>
    </div>
</div>

</body>
</html>
