<?php include_once("admin_include/header.php");
$db_connection = connect_to_database();

$sql = "SELECT * FROM user";
$result = $db_connection->query($sql);



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Update"])) {
    // Perform the update for all records here
    $edit_id = $_POST['id'];
    // $new_first_name = $_POST["new_first_name"];
    // $new_last_name = $_POST["new_last_name"];
    // $new_age = $_POST["new_age"];
    // $new_email = $_POST["new_email"];
    // $new_address= $_POST["new_address"];
    // $new_password = $_POST["new_password"];
    $new_role = $_POST["new_role"];
    $new_status = $_POST["new_status"];



    $sql = "UPDATE user SET Role ='$new_role', Status='$new_status' WHERE id=$edit_id";


    if ($db_connection->query($sql) == TRUE) {
    } else {
        echo "Error updating users: " . $db_connection->error;
    }
}



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

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <!-- <link href="css/sb-admin-2.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="css/sb-admin-2.css">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">




        <!-- End of Topbar -->

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
                    <div class="table-responsive">

                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                            <?php if ($result->num_rows > 0) { ?>
                                <thead>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Age</th>
                                        <th>Nick Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Gender</th>
                                        <th>Password</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tfoot>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Age</th>
                                        <th>Nick Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Gender</th>
                                        <th>Password</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                <?php } ?>
                                </tfoot>
                                <tbody>
                                    <?php while ($row = $result->fetch_assoc()) { ?>
                                        <!-- Inside the while loop -->

                                        <tr>
                                            <td><?php echo $row["First_name"]; ?></td>
                                            <td><?php echo $row["Last_name"]; ?></td>
                                            <td><?php echo $row["Age"]; ?></td>
                                            <td><?php echo $row["Nick_name"]; ?></td>
                                            <td><?php echo $row["Email"]; ?></td>
                                            <td><?php echo $row["Address"]; ?></td>
                                            <td><?php echo $row["Gender"]; ?></td>
                                            <td><?php echo $row["Password"]; ?></td>
                                            <td><?php echo $row["Role"]; ?></td>
                                            <td><?php echo $row["Status"]; ?></td>
                                            <td>
                                                <form action="php/edit_user.php" method="post">
                                                    <input type="hidden" name="edit_id" value="<?php echo $row["ID"]; ?>">
                                                    <input class="btn btn-primary  mb-2 btn-user  btn-block" type="submit" name="Edit" value="Edit">
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; Your Website 2020</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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