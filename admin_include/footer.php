<?php
include_once("../Arsha/php/connection.php");
$db_connection = connect_to_database();
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

$inactive_users = "SELECT COUNT(*) as inactive_users FROM  user WHERE Status = 'Inactive'";
$result = mysqli_query($db_connection, $inactive_users);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $inactive_users = $row['inactive_users'];
} else {
    $inactive_users = 0;
}

?>




    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; Your Website 2021</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

</div>


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
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>


</body>

</html>