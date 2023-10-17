<?php
include_once("php/connection.php");
$db_connection = connect_to_database();

if (isset($_POST["activity_id"])) {
    $activity_remarks = $_POST["activity_remarks"];
    $activity_id = $_POST["activity_id"];

    // Update the activity status to "Done" in the database
    $query = "UPDATE activity SET activity_status = 'Done', activity_remarks = '$activity_remarks' WHERE activity_id = '$activity_id'";
    if (mysqli_query($db_connection, $query)) {
        echo 'success'; // Send a success response to the AJAX request
    } else {
        echo 'error'; // Send an error response to the AJAX request
    }
}
?>
