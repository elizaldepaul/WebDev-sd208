<?php
session_start();

// Include your database connection and session-related code here
include('php/connection.php');
$db_connection = connect_to_database();



// Modify your SQL query to retrieve activity data including dates
$sql = "SELECT activity_date FROM activity";
$activity_Date = mysqli_query($db_connection, $sql);

// Initialize an array to store date-count pairs
$dateCountData = array();

// Initialize an array with all months as keys and an initial count of zero
$allMonths = [
    "January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
];

foreach ($allMonths as $month) {
    $dateCountData[$month] = 0;
}

// Process the query result and count activities for each date
while ($row = mysqli_fetch_assoc($activity_Date)) {
    $activityDate = $row['activity_date'];

    // Check if the date is a valid month, e.g., "January", "February", etc.
    if (in_array($activityDate, $allMonths)) {
        $dateCountData[$activityDate]++;
    }
}

// Convert $dateCountData to JSON
$dateCountDataJSON = json_encode(array_values($dateCountData)); // Convert to indexed array
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/chart.js" rel="stylesheet">
</head>
<body>
    <h1>Activity Dashboard</h1>

    <!-- Display the Bar Chart -->
    <div>
        <canvas id="myBarChart"></canvas>
    </div>

    <!-- Display the Registered Users Table -->
    <table>
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM user ORDER BY ID DESC";
            $result = mysqli_query($db_connection, $query);

            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row["First_name"] . '</td>';
                echo '<td>' . $row["Last_name"] . '</td>';
                echo '<td>';
                echo '<div class="btn-block">';
                echo '<input type="button" name="edit" value="Edit" id="' . $row["ID"] . '" class="btn btn-primary mb-2 btn-user btn-block edit_data" />';
                echo '<input type="button" name="view" value="View" id="' . $row["ID"] . '" class="btn btn-primary mb-2 btn-user btn-block view_data" />';
                echo '</div>';
                echo '</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Chart rendering code here
            // ...

            // Set new default font family and font color to mimic Bootstrap's default styling
            Chart.defaults.global.defaultFontFamily = 'Nunito, sans-serif';
            Chart.defaults.global.defaultFontColor = '#858796';

            function number_format(number, decimals, dec_point, thousands_sep) {
                // ... (number_format function remains the same)
            }

            // Bar Chart Example
            var dateCountData = <?php echo $dateCountDataJSON; ?>;
            // Extract dates and counts from the JSON data
            var dates = Object.keys(dateCountData);
            var counts = Object.values(dateCountData);

            // Create a bar chart using Chart.js
            var ctx = document.getElementById("myBarChart").getContext("2d");
            var myBarChart = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: dates, // Dates as labels
                    datasets: [
                        {
                            label: "Number of Activities",
                            backgroundColor: "#4e73df",
                            hoverBackgroundColor: "#2e59d9",
                            borderColor: "#4e73df",
                            data: counts, // Activity counts as data
                        },
                    ],
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                                max: 15000,
                                maxTicksLimit: 5,
                                padding: 10,
                                callback: function(value, index, values) {
                                    return '$' + number_format(value);
                                },
                            },
                            gridLines: {
                                color: "rgb(234, 236, 244)",
                                zeroLineColor: "rgb(234, 236, 244)",
                                drawBorder: false,
                                borderDash: [2],
                                zeroLineBorderDash: [2],
                            },
                        }],
                    },
                    legend: {
                        display: false,
                    },
                    tooltips: {
                        titleMarginBottom: 10,
                        titleFontColor: '#6e707e',
                        titleFontSize: 14,
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                        callbacks: {
                            label: function(tooltipItem, chart) {
                                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
                            },
                        },
                    },
                },
            });

            // ...
        });

        // Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}

// Bar Chart Example
var ctx = document.getElementById("myBarChart");
var myBarChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ["January", "February", "March", "April", "May", "June","July", "August","September","October","November","December"],
    datasets: [{
      label: "Revenue",
      backgroundColor: "#4e73df",
      hoverBackgroundColor: "#2e59d9",
      borderColor: "#4e73df",
      data: [215, 5312, 6251, 7841, 9821, 184],
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'month'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 6
        },
        maxBarThickness: 25,
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 15000,
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return '$' + number_format(value);
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
        }
      }
    },
  }
});
    </script>
</body>
</html>
