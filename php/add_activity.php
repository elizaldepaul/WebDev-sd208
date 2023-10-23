<?php

session_start();
include('connection.php');
$db_connection = connect_to_database();
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Other form field values...
    $activity_name = $_POST['activity_name'];
    $activity_time = $_POST['activity_time'];
    $activity_date = $_POST['activity_date'];
    $activity_owner = $_POST['activity_owner'];
    $activity_location = $_POST['activity_location'];
    $user_id = $_SESSION['ID'];
    $activity_status = 'Pending';

    // Check if a file was uploaded
    if ($_FILES['activity_ootd']['error'] == UPLOAD_ERR_OK) {
        $upload_dir = '../activity_image/'; // Update this path to your desired directory
        $temp_name = $_FILES['activity_ootd']['tmp_name'];
        $original_name = $_FILES['activity_ootd']['name'];
        $new_name = $original_name; // Unique file name
        $destination = $upload_dir . $new_name;

        // Move the uploaded file to the destination directory
        if (move_uploaded_file($temp_name, $destination)) {
            // File upload successful, now insert data into the database


            $sql = "INSERT INTO activity (activity_name, activity_time, activity_date, activity_location, activity_ootd, user_id, activity_status,activity_owner)  
                    VALUES('$activity_name', '$activity_time', '$activity_date', '$activity_location', '$new_name', '$user_id', '$activity_status','$activity_owner');";

            if (mysqli_query($db_connection, $sql)) {
                // Redirect or display a success message
                header('Location: ../activity.php');
            } else {
                echo "Error: " . mysqli_error($db_connection);
            }

            // Close the database connection
            mysqli_close($db_connection);
        } else {
            echo "<script>alert('Error uploading the image.');</script>";
            echo "<script>window.location.href = '../activity.php';</script>";
        }
    } else {
        // Handle the case where no file was uploaded
        echo "<script>alert('Error uploading the image.');</script>";
        echo "<script>window.location.href = '../activity.php';</script>";
    }
}
?>