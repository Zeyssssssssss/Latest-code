<?php
    include 'db.php';

    if(isset($_POST['save'])){
        $nname = $_POST['username'];
        $passwordd = $_POST['password'];

        $sql = "SELECT * FROM  log WHERE email = '$nname' and pass = '$passwordd'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0){
            echo "Successfully Login";
            header("Location: dashboard.php");
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
            background-image: url(jams.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            margin-left: 190px;
            overflow-y: hidden;
            
        }
        .login-container {
            background: dimgrey;
            padding: 40px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            opacity: 0.8;
        

            
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 24px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 100px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form  method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <input type="submit" value="Login" name="save">

            <style>
                .login-container{
                    margin-left: 800px;
                    width:234px;
                }
            </style>
        </form>
    </div>
</body>
</html>
