<?php
function connect_to_database() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sd208";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    return $conn; // Return the database connection object
}


function admin(){
    session_start();
    if($_SESSION["Role"] == null)
    {        
        header("Location: /Arsha/login.php");
    }
    else
    {
        if($_SESSION["Role"] == "Admin")
        {}
        else
        {
            header("Location: /Arsha/login.php");
    
        }
    
    }
}


function users(){
    session_start();
    if($_SESSION["Role"] == null)
    {        
        header("Location: /Arsha/login.php");
    }
    else
    {
        if($_SESSION["Role"] == "User")
        {}
        else
        {
            header("Location: /Arsha/login.php");
    
        }
    
    }
}
?>