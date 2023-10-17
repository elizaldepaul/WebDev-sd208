<?php
include_once('user_include/header.php');
 $_SESSION['ID'];
$user_id = $_SESSION['ID'];
$sql = "SELECT * FROM activity  WHERE user_id = '$user_id' AND activity_status = 'Done'";
$show_activity = $db_connection->query($sql);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/register.css">
    <title>Edit Record</title>

</head>

<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<div class="container-fluid" >
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Past Activities</h1>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="m-0 font-weight-bold text-primary">All Your Activities To Come</h6>
                        </div>
                        <div class="col-auto">
                            <!-- <input class="" id="add_btn" type="submit" name="Update" value="Add"
                                onclick="openModal()"> -->
                            

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive" id="employee_table">

                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                            <?php if ($result->num_rows > 0) { ?>
                                <thead>
                                    <tr>
                                        <th>activity_name</th>
                                        <th>activity_date</th>
                                        <th>activity_time</th>
                                        <th>activity_location</th>
                                        <th>activity_ootd</th>
                                        <th>date_created</th>
                                        <!-- <th>last_updated_time</th> -->
                                        <th>activity_status</th>
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
                                        <!-- <th>last_updated_time</th> -->
                                        <th>activity_status</th>

                                    </tr>
                                <?php } else { ?>
                                    No Done Activity Yet!
                                <?php } ?>
                            </tfoot>
                            <tbody>
                                <?php while ($row = $show_activity->fetch_assoc()) { ?>



                                    <tr>
                                        <td>
                                            <?php echo $row["activity_name"]; ?>
                                        </td>
                                        <td>
                                            <?php echo date("F j, Y",strtotime( $row["activity_date"])) ; ?>
                                        </td>
                                        <td>
                                            <?php echo date("h:i A", strtotime($row["activity_time"])); ?>
                                        </td>
                                        <td>
                                            <?php echo $row["activity_location"]; ?>
                                        </td>
                                        <td>
                                           <img height="100px" width="100px" src="activity_image/<?php echo $row["activity_ootd"]; ?>" alt="" srcset="">
                                        </td>
                                        <td>
                                            <?php echo date("F j, Y h:i A", strtotime($row["date_created"]));
                                            ?>
                                        </td>
                                       
                                        <td style="color:green;">
                                        <?php echo $row["activity_status"]; ?>
                                        
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


 <!-- Bootstrap core JavaScript-->

</body>

</html>
<?php include_once("user_include/footer.php")  ?>
