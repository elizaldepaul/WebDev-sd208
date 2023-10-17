<?php

include_once("connection.php");

$email = $_POST["email"];
$password = $_POST["password"];

session_start();
$conn = connect_to_database();

// Use prepared statements to prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM User WHERE Email = ? AND Password = ?");
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();

    if ($row["Status"] == "Active") {
        if ($row["Role"] == "Admin") {
            header("Location: ../admin.php");
        } else {

            
            header("Location: ../user.php");
        }
        $_SESSION['Email'] = $row['Email'];
        $_SESSION["ID"] = $row["ID"];
        $_SESSION["Role"] = $row["Role"];
    } else {
        echo "<script>alert('No Active Account Found');</script>";
        echo "<script>window.location.href = '../Arsha/index.php';</script>";
    }
} else {
    // Handle the case where no matching user was found
    echo "<script>alert('Invalid email or password');</script>";
    echo "<script>window.location.href = '../Arsha/index.php';</script>";
}

$stmt->close();
$conn->close();
?>