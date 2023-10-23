<?php

include('connection.php');
$db_connection = connect_to_database();
session_start();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Other form field values...
    $announcement = $_POST['announcement'];



    $sql = "INSERT INTO announcement (announcement)  
                    VALUES('$announcement');";

    if (mysqli_query($db_connection, $sql)) {
        echo "<script>alert('Announcement Posted Succcesfully');</script>";
        echo "<script>window.location.href = '../admin.php';</script>";
 
    } else {
        echo "Error: " . mysqli_error($db_connection);
    }
}

?>