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
$db_connection->close();
?>
<!DOCTYPE HTML>
<html>
<head>
<style>
    .chart-container {
        width: 80%;
        max-width: 600px;
        margin: 0 auto;
        border: 1px solid #ccc;
        padding: 10px;
        background-color: #f5f5f5;
    }
</style>
<script>
window.onload = function() {
    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        title: {
            text: "Monthly Activity Count"
        },
        axisY: {
            title: "Total Activities",
            includeZero: false,
            minimum: 0,
            maximum: null,
            valueFormatString: "#,##0"
        },
        data: [{
            type: "bar",
            yValueFormatString: "#,##0",
            indexLabel: "{y}",
            indexLabelPlacement: "inside",
            indexLabelFontWeight: "bolder",
            indexLabelFontColor: "white",
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();
}

</script>
</head>
<body>
<div class="chart-container">
    <div id="chartContainer" style="height: 370px;"></div>
</div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
