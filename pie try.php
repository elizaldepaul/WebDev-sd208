<?php
include_once("php/connection.php");
$db_connection = connect_to_database();
// Fetch data from your database
$query = "SELECT gender, COUNT(*) AS count FROM user GROUP BY gender";
$result = mysqli_query($db_connection, $query);

$dataPoints = array();

while ($row = mysqli_fetch_assoc($result)) {
    $label = ucfirst($row['gender']);
    $y = $row['count'];
    $dataPoints[] = array("label" => $label, "y" => $y);
}

?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function() {
    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        title: {
            text: "Gender Distribution"
        },
        data: [{
            type: "pie",
            yValueFormatString: "#,##0.00\"%\"",
            indexLabel: "{label} ({y})",
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html>
