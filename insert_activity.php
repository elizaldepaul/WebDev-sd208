<?php
include_once("php/connection.php");
$db_connection = connect_to_database();

if (!empty($_POST)) {
    $output = '';
    $message = '';
    $activity_name = mysqli_real_escape_string($db_connection, $_POST["activity_name"]);
    $activity_time = mysqli_real_escape_string($db_connection, $_POST["activity_time"]);
    $activity_date = mysqli_real_escape_string($db_connection, $_POST["activity_date"]);
    $activity_location = mysqli_real_escape_string($db_connection, $_POST["activity_location"]);
    $activity_status = mysqli_real_escape_string($db_connection, $_POST["activity_status"]);
    $user_id = mysqli_real_escape_string($db_connection, $_POST["user_id"]);
    $activity_id = isset($_POST["activity"]) ? mysqli_real_escape_string($db_connection, $_POST["activity"]) : null;

    $activity_ootd = ''; // Initialize the variable

    if (!empty($_FILES['activity_ootd']['name'])) {
        $uploaded_image = $_FILES['activity_ootd'];
        $target_directory = 'activity_image/'; // Define your target directory
        $target_file = $target_directory . basename($uploaded_image['name']);
    
        // Move the uploaded file to the target directory
        if (move_uploaded_file($uploaded_image['tmp_name'], $target_file)) {
            $activity_ootd = $uploaded_image['name']; // Store the new image filename
        } else {
            // Handle image upload failure (e.g., provide an error message)
        }
    } else {
        // No new image uploaded; retain the existing image filename
        if ($activity_id) {
            $query_existing_image = "SELECT activity_ootd FROM activity WHERE activity_id ='" . $activity_id . "'";
            $result = mysqli_query($db_connection, $query_existing_image);
            $row_existing_image = mysqli_fetch_array($result);
            $activity_ootd = $row_existing_image['activity_ootd'];
        }
    }
    if ($activity_id) {
        // Update existing activity
        $query = "  
           UPDATE activity   
           SET activity_name = '$activity_name',   
           activity_time = '$activity_time',   
           activity_date = '$activity_date',   
           activity_location = '$activity_location',   
           activity_ootd = '$activity_ootd',
           activity_status = '$activity_status',
           last_updated_time = NOW() 
           WHERE activity_id = '$activity_id'";
        $message = 'Data Updated';
    } else {
        // Insert new activity
        $message = 'Failed To Update';
    }

    if (mysqli_query($db_connection, $query)) {
        $sql = "SELECT * FROM activity  WHERE user_id = '$user_id' AND activity_status = 'Pending'";
        $show_activity = $db_connection->query($sql);
        $output .= '<label class="text-success">' . $message . '</label>';
        $output .= '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                  <tr>
                      <th>activity_name</th>
                      <th>activity_date</th>
                      <th>activity_time</th>
                      <th>activity_location</th>
                      <th>activity_ootd</th>
                      <th>date_created</th>
                      <th>last_updated_time</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tfoot>
                  <tr>
                      <th>activity_name</th>
                      <th>activity_date</th>
                      <th>activity_time</th>
                      <th>activity_location</th>
                      <th>activity_ootd</th>
                      <th>date_created</th>
                      <th>last_updated_time</th>
                      <th>Action</th>
                  </tr>
              </tfoot>
              <tbody>';

        while ($row = $show_activity->fetch_assoc()) {
            $output .= '<tr>
                  <td>' . $row["activity_name"] . '</td>
                  <td>' . $row["activity_date"] . '</td>
                  <td>' . date("h:i A", strtotime($row["activity_time"])) . '</td>
                  <td>' . $row["activity_location"] . '</td>
                <td>  <img width="100px" height="100px" src="activity_image/'. $row["activity_ootd"].'" id="activity_ootd" alt=""></td>
                  <td>' . date("F j, Y h:i A", strtotime($row["date_created"])) . '</td>
                  <td>' . $row["last_updated_time"] . '</td>
                  <td>
                      <input type="button" name="edit" value="Edit" id="' . $row["activity_id"] . '" class="btn btn-primary  mb-2 btn-user  btn-block edit_data" />
                      <input type="button" name="view" value="view" id="' . $row["activity_id"] . '" class="btn btn-primary  mb-2 btn-user  btn-block view_data" />
                  </td>
              </tr>';
        }

        $output .= '</tbody></table>
          <script src="vendor/datatables/jquery.dataTables.min.js"></script>
          <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
          <script src="js/demo/datatables-demo.js"></script>';
    }

    echo $output;
}
