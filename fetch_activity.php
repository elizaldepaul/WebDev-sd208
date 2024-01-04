<?php
include_once("php/connection.php");
$db_connection = connect_to_database();

if(isset($_POST["activity_id"])) {  
    $act_id = $_POST["activity_id"];
    $query = "SELECT * FROM activity WHERE activity_id = '".$_POST["activity_id"]."'";  
    $activity = mysqli_query($db_connection, $query);  
    $row = mysqli_fetch_array($activity);  
    echo json_encode($row);  
}

 ?>