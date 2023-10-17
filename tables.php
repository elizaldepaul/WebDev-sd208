<?php include_once("admin_include/header.php");
$db_connection = connect_to_database();

$sql = "SELECT * FROM activity";
$result = $db_connection->query($sql);


?>

<!DOCTYPE html>
<html>

<head>
    <style>
        td {
            text-align: center !important;
        }

        .btn-block {
            display: flex !important;
            flex-direction: row-reverse !important;
        }

        .view_data,
        .edit_data {
            width: 100px;
        }

        input[type="submit"].btn-block,
        input[type="reset"].btn-block,
        input[type="button"].btn-block {
            text-align: center !important;
            width: auto;
            margin: auto;
        }

        .edit_data {
            margin-top: 8px;
        }
    </style>
</head>

<body id="page-top">
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tables</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Registered Users</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive" id="user_table">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Activity Name</th>
                                <th>Activity Date</th>
                                <th>Activity Ootd</th>
                                <th>Activity Location</th>
                                <th>Activity Owner</th>

                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Activity Name</th>
                                <th>Activity Date</th>
                                <th>Activity Ootd</th>
                                <th>Activity Location</th>
                                <th>Activity Owner</th>

                            </tr>
                        </tfoot>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()) { ?>
                                <tr>
                                    <td>
                                        <?php echo $row["activity_name"]; ?>
                                    </td>
                                    <td>
                                    <?php echo date("F j, Y",strtotime( $row["activity_date"])) ; ?>
                                    </td>
                                    <td>
                                     <img height="100px" width="100px" src="activity_image/<?php echo $row["activity_ootd"]; ?>" alt="" srcset="">  
                                    </td>
                                    <td>
                                        <?php echo $row["activity_location"]; ?>
                                    </td>
                                    <td>
                                        <?php echo $row["activity_owner"]; ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php
include_once('admin_include/footer.php');
?>