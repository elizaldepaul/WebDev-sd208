<?php

include_once("connection.php");

$email = $_POST["email"];
$password = $_POST["password"];

session_start();
$conn = connect_to_database();
$sql = "SELECT * from User where Email = '" . $email . "' and Password = '" . $password . "'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();


if($email == null || $password == null){
    header('Location: ../login.php');
}
else{
    if ($row["Email"] == $email && $row["Password"] == $password) {
        if ($row["Status"] == "Active"){

        if ($row["Role"] == "Admin") {
            header("Location: ../admin.php");
        } 
        else
         {
            header("Location: ../user.php");
        }
    }
    else {
        echo "<script> alert ('No Active Account Found'); </script>";
        echo "<script> alert ('Please Register To Proceed'); </script>";
        echo "<script>window.location.href = '../register.html'; </script>";
    }
        $_SESSION["ID"] = $row["ID"];
        $_SESSION["Role"] = $row["Role"];
    
    } else {
        header("Location: ../login.php");
    }

    

}

?>