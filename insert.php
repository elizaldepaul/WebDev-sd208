<?php
include_once("php/connection.php");
$db_connection = connect_to_database();
if (!empty($_POST)) {
     $output = '';
     $message = '';
     $first_name = mysqli_real_escape_string($db_connection, $_POST["first_name"]);
     $last_name = mysqli_real_escape_string($db_connection, $_POST["last_name"]);
     $age = mysqli_real_escape_string($db_connection, $_POST["age"]);
     $nick_name = mysqli_real_escape_string($db_connection, $_POST["nick_name"]);
     $email = mysqli_real_escape_string($db_connection, $_POST["email"]);
     $address = mysqli_real_escape_string($db_connection, $_POST["address"]);
     $gender = mysqli_real_escape_string($db_connection, $_POST["gender"]);
     $password = mysqli_real_escape_string($db_connection, $_POST["password"]);
     $role = mysqli_real_escape_string($db_connection, $_POST["role"]);
     $status = mysqli_real_escape_string($db_connection, $_POST["status"]);
     if ($_POST["user_id"] != null) {
          $query = "  
           UPDATE user   
           SET First_name='$first_name',   
           Last_name='$last_name',   
           Age='$age',   
           Nick_name = '$nick_name',   
           Email = '$email',
           Address='$address',
           Gender='$gender',
           Password='$password',
           Role='$role',
           Status='$status'  
           WHERE ID='" . $_POST["user_id"] . "'";
          
     } else {
         
          $message = 'Data Failed to update';
     }
     if (mysqli_query($db_connection, $query)) {
          echo "<script> window.location.href='admin.php' </script>;";
     }
    
}