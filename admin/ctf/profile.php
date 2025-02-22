<?php
include("login.php");
session_start();
error_reporting(0);
$userprofile = $_SESSION["user_name"];
if (!$userprofile) {
    header('Location: loginh.php');
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the team_name, name_of_members, and team_id information for the logged-in user
$sql = "SELECT team_id, team_name, name_of_members FROM teams WHERE name_of_members LIKE ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
}

$searchTerm = '%' . $userprofile . '%';
$stmt->bind_param("s", $searchTerm);

if (!$stmt->execute()) {
    die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
}

$stmt->bind_result($team_id, $team_name, $name_of_members);

$stmt->fetch();

$stmt->close();

// Split the members string into an array (assuming members are comma-separated)
$members_array = explode(", ", $name_of_members);

// Fetch points from scoreboard table
$sql_points = "SELECT team_name, Score FROM abc.scoreboard";
$stmt_points = $conn->prepare($sql_points);

if (!$stmt_points) {
    die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
}

if (!$stmt_points->execute()) {
    die("Execute failed: (" . $stmt_points->errno . ") " . $stmt_points->error);
}

$stmt_points->bind_result($team_name_points, $points);

$points_array = array();
$team_points_array = array();
$team_points = 0;

while ($stmt_points->fetch()) {
    $points_array[$team_name_points] = intval($points);
    if (in_array($team_name_points, $members_array)) {
        $team_points_array[$team_name_points] = intval($points);
        $team_points += intval($points);
    }
}

$stmt_points->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>

        .container {
            margin: 40px auto;
            padding: 20px;
            color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h1 {
            text-align: center;
        }

        .members {
            margin-top: 20px;
        }

        .member {
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }

        .member:last-child {
            border-bottom: none;
        }

        #chart-container {
            width: 100%;
            height: 400px;
            margin-top: 40px;
        }

        .members {
            font-size: large;
        }
    </style>

    <!-- Link your custom CSS here -->
    <link rel="stylesheet" href="css/main.css">
</head>
<body style="
background-image: url('images/bg.jpg');
background-repeat: no-repeat;
background-position: center;
background-size: cover;
background-attachment: fixed;
">

<!-- Navbar -->
<div class="navbar-dark text-white">
    <div class="container">
        <nav class="navbar px-0 navbar-expand-lg navbar-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <h3 class="bold"><span class="color_danger">TALAKUNCHI</span><span class="color_white">CTF</span></h3>
                </div>
                <div class="navbar-nav ml-auto">
                    <a href="about" class="p-3 text-decoration-none text-white bold">
                        <i class="fas fa-info-circle mr-2"></i>
                        About
                    </a>
                    <a href="Scoreboard" class="p-3 text-decoration-none text-light bold">
                        <i class="fas fa-trophy mr-2"></i>
                        Scoreboard
                    </a>
                    <a href="quests" class="p-3 text-decoration-none text-light bold">
                        <i class="fas fa-laptop-code mr-2"></i>
                        Challenges
                    </a>
                </div>
            </div>
        </nav>
    </div>
</div>

<!-- Profile Content -->
<div class="container">
    <div class="col-xl-12 text-center">
        <h1 class="display-1 bold color_white content__title">PROFILE<span class="vim-caret">&nbsp;</span></h1>
    </div>
    <?php if ($team_id): ?>
        <div class='members'>
            <h3>Members with your login:</h3>
            <b>Team Name: </b><?php echo htmlspecialchars($team_name); ?><br><br>
            <?php foreach ($members_array as $member): ?>
                <div class='member'><?php echo htmlspecialchars($member); ?> - <?php echo isset($team_points_array[$member]) ? $team_points_array[$member] : 0; ?> Points</div>
            <?php endforeach; ?>
            <br>
            <b>Total Points: </b><?php echo $team_points; ?><br>
        </div>
    <?php else: ?>
        <p>No team found with the login name <?php echo htmlspecialchars($userprofile); ?>.</p>
    <?php endif; ?>
    <div id="chart-container">
        <canvas id="pointsChart"></canvas>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById('pointsChart').getContext('2d');
        var chartData = {
            labels: <?php echo json_encode(array_keys($team_points_array)); ?>,
            datasets: [{
                label: 'Points',
                data: <?php echo json_encode(array_values($team_points_array)); ?>,
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(153, 102, 255, 0.2)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1,
                hoverOffset: 4,
            }]
        };

        var pointsChart = new Chart(ctx, {
            type: 'pie',
            data: chartData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true // Shows the legend
                    }
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var label = data.labels[tooltipItem.index];
                            var value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                            return label + ': ' + value + ' Points';
                        }
                    }
                }
            }
        });
    });
</script>

<div id="chart-container">
    <canvas id="challengesChart"></canvas>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx2 = document.getElementById('teamChart').getContext('2d');
        var teamChartData = {
            labels: <?php echo json_encode(array_keys($team_points_array)); ?>,
            datasets: [{
                label: 'Team Points',
                data: <?php echo json_encode(array_values($team_points_array)); ?>,
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(153, 102, 255, 0.2)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1,
                hoverOffset: 4,
            }]
        };

        var teamChart = new Chart(ctx2, {
            type: 'pie',
            data: teamChartData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true // Shows the legend
                    }
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var label = data.labels[tooltipItem.index];
                            var value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                            return label + ': ' + value + ' Points';
                        }
                    }
                }
            }
        });
    });
</script>
<div id="chart-container">
    <canvas id="teamChart"></canvas>
</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script>
    function confirmLogout() {
        // Display confirmation dialog
        var confirmLogout = confirm("Are you sure you want to log out?");
        
        // If user confirms, redirect to logout.php
        if(confirmLogout) {
            window.location.href = "logout.php";
            return true;
        } else {
            return false;
        }
    }
</script>

</body>
</html>
