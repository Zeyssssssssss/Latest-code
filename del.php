<?php
    include 'db.php';   
    $iids = $_GET['id'];

    $sql = "DELETE  FROM  stocks WHERE id = '$iids' ";
    $result = mysqli_query($conn, $sql);

    
?>