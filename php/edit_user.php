<?php
include_once('connection.php');
$db_connection = connect_to_database(); // Check connection

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_id"])) {
    $edit_id = $_POST["edit_id"];
    $sql = "SELECT * FROM user WHERE ID = $edit_id";
    $result = $db_connection->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        // Retrieve values for the form fields
        $first_name = $row["First_name"];
        $last_name = $row["Last_name"];
        $age = $row["Age"];
        $nickname = $row["Nick_name"];
        $email = $row["Email"];
        $address = $row["Address"];
        $gender = $row["Gender"];
        $password = $row["Password"];
        $role = $row["Role"];
        $status = $row["Status"];
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

                            <form action="../tables.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $edit_id; ?>">

                                <div class="form-group">
                                    <label for="Name">First Name:</label>
                                    <input type="text" name="new_first_name" value="<?php echo $first_name; ?>" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="Date">Last Name:</label>
                                    <input type="text" name="new_last_name" value="<?php echo $last_name; ?>" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="Age">Age:</label>
                                    <input type="text" name="new_age" value="<?php echo $age; ?>" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="Nickname">Nickname:</label>
                                    <input type="text" name="new_nickname" value="<?php echo $nickname; ?>" disabled>
                                </div>


                                <label for="Meridiem">Email:</label>
                                <input type="text" name="new_email" value="<?php echo $email; ?>" disabled><br>

                                <label for="Location">Address:</label>
                                <input type="text" name="new_address" value="<?php echo $address; ?>" disabled><br>

                                <label for="Ootd">Password:</label>
                                <input type="text" name="new_password" value="<?php echo $password; ?>" disabled><br>

                                <label for="Ootd">Role:</label>
                                <select name="new_role">
                                    <option value="User">User</option>
                                    <option value="Admin">Admin</option>
                                </select><br>



                                <label for="Ootd">Status:</label>
                                <input type="text" name="new_status" value="<?php echo $status; ?>"><br>

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