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

include('connection.php');
$db_connection = connect_to_database();


$sql = "INSERT INTO user (First_name, Last_name, Age, Nick_name ,Email, Address , Gender , Password,  Role, Status) VALUES ('$firstname','$lastname', '$age', '$nickname','$email', '$address' , '$gender' , '$password', '$role' , '$status')";

// Perform the SQL query
if (mysqli_query($db_connection, $sql)) {
    header("Location: ../login.php");

} else {
    echo "Error: " . mysqli_error($db_connection);
}

// Close the database connection
mysqli_close($db_connection);

?>