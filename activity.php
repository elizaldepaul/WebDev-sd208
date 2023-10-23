<?php
include_once("user_include/header.php");
$db_connection = connect_to_database();
$_SESSION['Email'];
$_SESSION['ID'];
$user_id = $_SESSION['ID'];
$sql = "SELECT * FROM activity  WHERE user_id = '$user_id' AND activity_status = 'Pending'";
$show_activity = $db_connection->query($sql);


?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Tables</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <!-- <link href="css/sb-admin-2.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="css/sb-admin-2.css">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">




        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Activities</h1>
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
                            <input class="btn btn-primary" id="add_btn" type="submit" name="Update" value="Add"
                                onclick="openModal()">

                        </div>
                    </div>
                </div>


                <!-- =======================================================   add activity modal   ============================================================== -->
                <style>
                    /* Modal Styles */
                    .modal {
                        display: none;
                        position: fixed;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        overflow: auto;
                        background-color: rgba(0, 0, 0, 0.7);
                        /* z-index: 1; */
                        justify-content: center;
                        align-items: center;
                    }

                    .modal-content {
                        background-color: #fff;
                        padding: 20px;
                        border-radius: 5px;

                    }

                    /* Close Button Styles */
                    .close {
                        position: absolute;
                        top: 10px;
                        right: 10px;
                        cursor: pointer;
                    }

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

                    input[type="date"],
                    [type="time"],
                    [type="text"],
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

                    #wrapper #content-wrapper {
                        height: 700px;
                        overflow: auto;
                    }
                </style>


                <!-- Add Activity Modal -->
                <div id="myModal" class="modal">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="card o-hidden border-0 shadow-lg my-5">
                                    <div class="card-body p-0">
                                        <div class="p-5">
                                            <div class="text-center">
                                                <h1 class="h4 text-gray-900 mt-4">Add Activity</h1>
                                                <span class="close" onclick="closeModal()">&times;</span>
                                            </div>
                                            <div class="modal-content">

                                                <form action="php/add_activity.php" method="post" autocomplete="off"
                                                    enctype="multipart/form-data">

                                                    <div class="form-group">
                                                        <label for="Name">Activity Name:</label>
                                                        <input type="text" name="activity_name" value="">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="Date">Activity Date:</label>
                                                        <input type="date" name="activity_date"
                                                            value="<?php echo date('Y-m-d'); ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Time">Activity Time:</label>
                                                        <input type="time" name="activity_time"
                                                            value="<?php echo date('H:i'); ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Nickname">Activity Location:</label>
                                                        <input type="text" name="activity_location" value="">
                                                    </div>
                                                    <input type="hidden" name="activity_owner" id="activity_owner"
                                                        value="<?php echo $_SESSION['Email']; ?>" />
                                                    <input type="hidden" name="user_id"
                                                        value="<?php echo $_SESSION["ID"]; ?>">
                                                    <label for="Meridiem">Activity Ootd:</label>
                                                    <input type="file" name="activity_ootd" value=""><br>

                                                    <div class="text-center">
                                                        <input type="submit" name="Update" value="Add">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    // Function to open the modal
                    function openModal() {
                        var modal = document.getElementById("myModal");
                        modal.style.display = "block";
                    }

                    // Function to close the modal
                    function closeModal() {
                        var modal = document.getElementById("myModal");
                        modal.style.display = "none";
                    }
                    function openModalEdit() {
                        var modal = document.getElementById("myModalEdit");
                        modal.style.display = "block";
                    }

                    // Function to close the modal
                    function closeModalEdit() {
                        var modal = document.getElementById("myModalEdit");
                        modal.style.display = "none";
                    }

                    // Close the modal if the user clicks outside of it
                    // window.onclick = function (event) {
                    //     var modal = document.getElementById("myModal");
                    //     if (event.target === modal) {
                    //         modal.style.display = "none";
                    //     }
                    // }
                </script>

                <!-- =======================================================   end of add activity modal =============================================================== -->

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
                                <?php } else { ?>
                                    No Activity Yet!
                                <?php } ?>
                            </tfoot>
                            <tbody>
                                <?php while ($row = $show_activity->fetch_assoc()) { ?>



                                    <tr>
                                        <td>
                                            <?php echo $row["activity_name"]; ?>
                                        </td>
                                        <td>
                                            <?php echo date("F j, Y", strtotime($row["activity_date"])); ?>
                                        </td>
                                        <td>
                                            <?php echo date("h:i A", strtotime($row["activity_time"])); ?>
                                        </td>
                                        <td>
                                            <?php echo $row["activity_location"]; ?>
                                        </td>
                                        <td>
                                            <img width="100px" height="100px"
                                                src="activity_image/<?php echo $row["activity_ootd"]; ?>" alt="">

                                        </td>
                                        <td>
                                            <?php echo date("F j, Y h:i A", strtotime($row["date_created"]));
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($row["last_updated_time"] !== null) {
                                                echo date("F j, Y h:i A", strtotime($row["last_updated_time"]));
                                            } else {

                                            }
                                            ?>
                                        </td>
                                        <td><input type="button" name="edit" value="Edit"
                                                id="<?php echo $row["activity_id"]; ?>"
                                                class=" btn btn-primary  mb-2 btn-user  btn-block edit_data" />
                                            <input type="button" name="view" value="Set"
                                                id="<?php echo $row["activity_id"]; ?>"
                                                class="btn btn-primary  mb-2 btn-user  btn-block view_data" />
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


    <div id="dataModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"> Your Activity</h4>

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body" id="employee_detail">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div id="add_data_Modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Activity</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                <form method="post"  action="updateimage.php" autocomplete="off" enctype="multipart/form-data">
                        <label>Activity Name</label>
                        <input type="text" name="activity_name" id="activity_name" class="form-control" />
                        <input type="hidden" name="activity" id="activity" class="form-control" />
                        <br />
                        <label>Activity Date</label>
                        <input type="date" name="activity_date" id="activity_date" class="form-control"></input>
                        <br />
                        <label>Activity Time</label>
                        <input type="time" name="activity_time" id="activity_time" class="form-control"></input>
                        <br />
                        <label>Activity Location</label>
                        <input type="text" name="activity_location" id="activity_location" class="form-control"></input>
                        <br />
                        <label for="activity_ootd">Activity Ootd</label>
                        <input type="file" name="activity_ootd" id="activity_ootd">
                        <img id="activity_ootd_preview" src="" name="activity_ootd" alt="Activity Ootd Image"
                            style="max-width: 100%; max-height: 200px;">

                        <br />
                        <input type="hidden" name="activity_status" value="Pending">
                        <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION["ID"]; ?>">
                        <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script>
         document.getElementById('activity_ootd').addEventListener('change', function() {
    var input = this;
    var preview = document.getElementById('activity_ootd_preview');
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        preview.setAttribute('src', e.target.result);
      };
      reader.readAsDataURL(input.files[0]);
    }
  });
        $(document).ready(function () {
            $('#add').click(function () {
                $('#insert').val("Insert");
                $('#insert_form')[0].reset();
            });
            $(document).on('click', '.edit_data', function () {
                var activity_id = $(this).attr("id");
                $.ajax({
                    url: "fetch_activity.php",
                    method: "POST",
                    data: { activity_id: activity_id },
                    dataType: "json",
                    success: function (data) {
                        $('#activity_name').val(data.activity_name);
                        $('#activity').val(data.activity_id);
                        $('#activity_date').val(data.activity_date);
                        $('#activity_time').val(data.activity_time);
                        $('#activity_location').val(data.activity_location);
                        $('#activity_ootd').attr('src', 'activity_image/'+data.activity_ootd);

                        // Handle the image update
                        $('#insert').val("Update");
                        $('#add_data_Modal').modal('show');
                    }
                });
            });
            $('#insert_form').on("submit", function (event) {
                event.preventDefault();
                if ($('#name').val() == "") {
                    alert("Name is required");
                }
                else if ($('#activity_date').val() == '') {
                    alert("activity_date is required");
                }
                else if ($('#designation').val() == '') {
                    alert("Designation is required");
                }
                else if ($('#age').val() == '') {
                    alert("Age is required");
                }
                else {
                    $.ajax({
                        url: "insert_activity.php",
                        method: "POST",
                        data: $('#insert_form').serialize(),
                        beforeSend: function () {
                            $('#insert').val("Inserting");
                        },
                        success: function (data) {
                            $('#insert_form')[0].reset();
                            $('#add_data_Modal').modal('hide');
                            $('#employee_table').html(data);
                        }
                    });
                }
            });
            $(document).on('click', '.view_data', function () {
                var activity_id = $(this).attr("id");
                if (activity_id != '') {
                    $.ajax({
                        url: "select_act.php",
                        method: "POST",
                        data: { activity_id: activity_id },
                        success: function (data) {
                            $('#employee_detail').html(data);
                            $('#dataModal').modal('show');
                        }
                    });
                }
            });

            $(document).on('click', '.mark_as_done', function () {
                var activity_id = $(this).attr("id");
                var activity_remarks = $("#notes").val();


                $.ajax({
                    url: "mark_activity_done.php",
                    method: "POST",
                    data: { activity_id: activity_id, activity_remarks: activity_remarks },
                    success: function (response) {

                        if (response === 'success') {

                            window.location.href = 'activity.php';

                        } else {
                            alert('Failed to mark activity as done.');
                        }
                    }
                });
            });
            $(document).on('click', '.mark_as_cancel', function () {
                var activity_id = $(this).attr("id");


                $.ajax({
                    url: "mark_as_cancel.php",
                    method: "POST",
                    data: { activity_id: activity_id },
                    success: function (response) {

                        if (response === 'success') {
                            window.location.href = 'activity.php';

                        } else {
                            alert('Failed to mark activity as done.');
                        }
                    }
                });
            });
        });

    </script>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="php/logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>



</body>

</html>