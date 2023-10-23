<?php include_once("admin_include/header.php");



?>

<!DOCTYPE html>
<html>
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


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
<?php
// Replace with your database connection code
include_once("php/connection.php");

$db_connection = connect_to_database();

$all_months = array(
    "January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
);

// SQL query to retrieve the total number of activities per month
$sql = "SELECT DATE_FORMAT(activity_date, '%Y-%m') AS month, COUNT(*) AS total_activities
        FROM activity
        GROUP BY month
        ORDER BY month";
$result = $db_connection->query($sql);

$dataPoints = array();

// Initialize an empty array for the results
$monthly_data = array();

// Populate the monthly data array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $monthly_data[$row["month"]] = $row["total_activities"];
    }
}

// Loop through all months to ensure they are included
foreach ($all_months as $month) {
    $formatted_month = date("Y-m", strtotime("1 $month"));
    $total_activities = isset($monthly_data[$formatted_month]) ? $monthly_data[$formatted_month] : 0;
    $dataPoints[] = array("y" => $total_activities, "label" => $month);
}

// Close the database connection
?>
           <!-- Bar Chart -->
<div class="col-xl-4 col-lg-4">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Monthly Activity Count</h6>
        </div>
        <div class="card-body">
            <div id="barChartContainer" style="height: 370px; width: 100%;"></div>
            <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

        </div>
    </div>
</div>
<script>
    window.onload = function () {
        var barChart = new CanvasJS.Chart("barChartContainer", {
            animationEnabled: true,
            title: {
                text: "Monthly Activity Count"
            },
            axisY: {
                title: "Number of Activities"
            },
            data: [{
                type: "column",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        barChart.render();
    }
</script>
<?php 
$db_connection = connect_to_database();

$sql = "SELECT * FROM activity";
$result = $db_connection->query($sql);?>


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