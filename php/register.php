<?php

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$address = $_POST['address'];
$age = $_POST['age'];
$nickname= $_POST['nickname'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$role = $_POST['role'];
$status = $_POST['status'];

include_once('connection.php');
$db_connection = connect_to_database();


$emailCheckQuery = "SELECT COUNT(*) FROM user WHERE Email = '$email'";
$result = mysqli_query($db_connection, $emailCheckQuery);
if ($result) {
    $count = mysqli_fetch_row($result)[0];
    if ($count > 0) {
        echo "<script>alert('Email already exists. Please choose another email.');</script>";
        echo "<script>window.location.href = '../Arsha/index.php';</script>";
    
        mysqli_close($db_connection);
        exit; // Stop execution if email exists
    }
} else {
    echo "Error checking email: " . mysqli_error($db_connection);
    mysqli_close($db_connection);
    exit; // Stop execution on error
}

$sql = "INSERT INTO user (First_name, Last_name, Age, Nick_name ,Email, Address , Gender , Password,  Role, Status) VALUES ('$firstname','$lastname', '$age', '$nickname','$email', '$address' , '$gender' , '$password', '$role' , '$status')";

// Perform the SQL query
if (mysqli_query($db_connection, $sql)) {
    
    echo "<script>alert('Registered Successfully Please Log in To Continue');</script>";
    echo "<script>window.location.href = '../Arsha/index.php';</script>";
} else {
    echo "Error: " . mysqli_error($db_connection);
}



// Close the database connection
mysqli_close($db_connection);

?>