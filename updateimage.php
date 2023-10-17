<?php

session_start();
include('php/connection.php');
$db_connection = connect_to_database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $activity_name = $_POST['activity_name'];
    $activity_time = $_POST['activity_time'];
    $activity_date = $_POST['activity_date'];
    $activity_location = $_POST['activity_location'];
    $user_id = $_SESSION['ID'];
    $activity_status = 'Pending';
    $activity_id = isset($_POST['activity']) ? $_POST['activity'] : null;

    if (!empty($_FILES['activity_ootd']['name'])) {
        $upload_dir = 'activity_image/'; // Update this path to your desired directory
        $temp_name = $_FILES['activity_ootd']['tmp_name'];
        $original_name = $_FILES['activity_ootd']['name'];
        $new_name = $original_name; // Unique file name
        $destination = $upload_dir . $new_name;

        if (move_uploaded_file($temp_name, $destination)) {
            $activity_ootd = $new_name;

            if ($activity_id) {
                // Update an existing activity
                $sql = "UPDATE activity
                        SET activity_name = '$activity_name',
                            activity_time = '$activity_time',
                            activity_date = '$activity_date',
                            activity_location = '$activity_location',
                            activity_ootd = '$activity_ootd',
                            activity_status = '$activity_status',
                            last_updated_time = NOW()
                        WHERE activity_id = '$activity_id'";

                if (mysqli_query($db_connection, $sql)) {
                    // Redirect or display a success message
                    header('Location: activity.php');
                } else {
                    echo "Error: " . mysqli_error($db_connection);
                }
            } else {
                echo "Activity ID is missing for update.";
            }
        } else {
            echo "Error uploading the image.";
        }
    } else {
        echo "No image uploaded.";
    }

    mysqli_close($db_connection);
}
