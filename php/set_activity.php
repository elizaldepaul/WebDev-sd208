<?php
include_once('connection.php');
$db_connection = connect_to_database(); // Check connection

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_id"])) {
    $edit_id = $_POST["edit_id"];
    $sql = "SELECT * FROM activity WHERE activity_id = $edit_id";
    $result = $db_connection->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        // Retrieve values for the form fields
        $activity_name = $row['activity_name'];
        $activity_time = $row['activity_time'];
        $activity_date = $row['activity_date'];
        $activity_location = $row['activity_location'];
        $activity_ootd = $row['activity_ootd'];
    }
}
$db_connection->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/register.css">
    <title>Edit Record</title>
    <style>
        /* Add your custom CSS styles here */
        .container {
            margin-top: 20px;
        }

        /* Center the form horizontally */
        .col-lg-6 {
            margin: 0 auto;
            float: none;
        }

        /* Style labels and inputs */
        label {
            font-weight: bold;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Center the submit button */
        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                            </div>

                            <form action="../show_activity.php" method="post">
                                <input type="hidden" name="activity_id" value="<?php echo $edit_id; ?>">

                                <div class="form-group">
                                    <label for="Name">activity_name:</label>
                                    <input type="text" name="activity_name" value="<?php echo $activity_name; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="Date">activity_date:</label>
                                    <input type="text" name="activity_date" value="<?php echo $activity_date; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="Age">activity_time:</label>
                                    <input type="text" name="activity_time" value="<?php echo $activity_time; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="Nickname">activity_location:</label>
                                    <input type="text" name="activity_location" value="<?php echo $activity_location; ?>">
                                </div>


                                <label for="Meridiem">activity_ootd:</label>
                                <input type="text" name="activity_ootd" value="<?php echo $activity_ootd; ?>"><br>


                                <input type="submit" name="Update" value="Update">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>