<?php
include_once("../Arsha/php/connection.php");
admin();
$db_connection = connect_to_database();


$id = $_SESSION['ID'];
// Assuming you have a query to fetch the username
$sql = "SELECT * FROM user WHERE ID = '$id'"; // Replace with your actual query
$result = mysqli_query($db_connection, $sql);

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $firstname = $row['First_name'];
    $lastname = $row['Last_name'];
} else {

    $username = 'Default Username';
}


// NUMBERS OF REGISTERED USERS
$total = "SELECT COUNT(*) as total_registered_users FROM user";
$result = mysqli_query($db_connection, $total);


if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalUsers = $row['total_registered_users'];
} else {
    $totalUsers = 0;
}

// NUMBER OF ACTIVE USERS
$active_users = "SELECT COUNT(*) as active_users FROM user WHERE Status = 'Active'";
$result = mysqli_query($db_connection, $active_users);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $active_users = $row['active_users'];
} else {
    $active_users = 0;
}

$inactive_users = "SELECT COUNT(*) as Deactive_users FROM  user WHERE Status = 'Deactive'";
$result = mysqli_query($db_connection, $inactive_users);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $inactive_users = $row['Deactive_users'];
} else {
    $inactive_users = 0;
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

    <title>Admin 2</title>
    <!-- Icon  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="css/sb-admin-2.css">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="css/sb-admin-2.css">
    <!-- <link href="css/sb-admin-2.min.css" rel="stylesheet"> -->


</head>


<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon ">
                    <img src="img/user-gear.png" alt="" width="50px" height="50px">
                </div>
                <div class="sidebar-brand-text mx-3">
                    <?php echo $firstname; ?>
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="admin.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Manage Your Users
            </div>


            <!-- Nav Item - Activity -->
            <li class="nav-item">
                <a class="nav-link" href="tables.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>List of Activites</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?php echo $firstname . " " . $lastname; ?>
                                </span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal"
                                    href="../php/logout.php" style="cursor: pointer;">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Number Of Registered Users</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $totalUsers; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users" style="color: #6888e4;"></i>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Active User -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Active Users</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $active_users; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa-solid fa-user-check" style="color:#1cc88a;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Inactive User -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2"
                                style="border-left: 0.25rem solid red !important;">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1"
                                                style="color: red !important;">deactived users
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                        <?php echo $inactive_users; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa-solid fa-user-xmark" style="color:#ff0000;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2"
                                style="border-left: 0.25rem solid black !important;">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1"
                                                style="color: black !important;">Add Announcements
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                        <input class="btn btn-primary" id="add_btn" type="submit"
                                                            name="Update" value="Add" onclick="openModal()"
                                                            style="background-color:black; border:none;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa-solid fa-bullhorn" style="color:black;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- =============  annoucement  ================ -->
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
                                height: 600px;
                                overflow: auto;
                            }
                        </style>
                        <div id="myModal" class="modal">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-lg-6">
                                        <div class="card o-hidden border-0 shadow-lg my-5">
                                            <div class="card-body p-0">
                                                <div class="p-5">
                                                    <div class="text-center">
                                                        <h1 class="h4 text-gray-900 mt-4">Add Announcements</h1>
                                                        <span class="close" onclick="closeModal()">&times;</span>
                                                    </div>
                                                    <div class="modal-content">

                                                        <form action="php/announcement.php" method="post"
                                                            autocomplete="off" enctype="multipart/form-data">

                                                            <div class="form-group">
                                                                <label for="Name">Announcements:</label>
                                                                <textarea style="height: 300px;" type="text"
                                                                    name="announcement" value=""></textarea>
                                                            </div>


                                                            <div class="text-center">
                                                                <input type="submit" name="Update" value="Post">
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
                        <!-- end announcments -->

                    </div>

                    <!-- Content Row -->



                    <!-- Area Chart -->

                    <!-- Pie Chart -->
                    <div class="col-xl-4 col-lg-5">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                                <div class="dropdown no-arrow">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                        aria-labelledby="dropdownMenuLink">
                                        <div class="dropdown-header">Dropdown Header:</div>
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="chart-pie pt-4 pb-2">
                                    <canvas id="myPieChart"></canvas>
                                </div>
                                <div class="mt-4 text-center small">
                                    <span class="mr-2">
                                        <i class="fas fa-circle text-primary"></i> Direct
                                    </span>
                                    <span class="mr-2">
                                        <i class="fas fa-circle text-success"></i> Social
                                    </span>
                                    <span class="mr-2">
                                        <i class="fas fa-circle text-info"></i> Referral
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>