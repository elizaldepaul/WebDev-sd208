<?php include_once("connection.php");
$db_connection = connect_to_database();






if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Update"])) {


    $edit_id = $_POST['activity_id'];
    $activity_name = $_POST['activity_name'];
    $activity_time = $_POST['activity_time'];
    $activity_date = $_POST['activity_date'];
    $activity_location = $_POST['activity_location'];
    $activity_ootd = $_POST['activity_ootd'];



    // $sql = "UPDATE activity SET activity_name ='$activity_name', activity_time= '$activity_time' , activity_date = '$activity_date' , activity_location = '$activity_location',  activity_ootd = '$activity_ootd' WHERE activity_id= $edit_id";

    $sql = "UPDATE activity SET 
  activity_name ='$activity_name', 
  activity_time= '$activity_time', 
  activity_date = '$activity_date', 
  activity_location = '$activity_location',  
  activity_ootd = '$activity_ootd', 
  last_updated_time = NOW() 
  WHERE activity_id= $edit_id";



    if ($db_connection->query($sql) == TRUE) {
        header("Location: ../show_activity.php");
    } else {
        echo "Error updating users: " . $db_connection->error;
    }
}

?>