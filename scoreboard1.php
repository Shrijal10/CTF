<?php include("login.php");
session_start();
error_reporting(0);
$userprofile = $_SESSION["user_name"];
if ($userprofile == true)       
{
    
}
else    
{
    header('Location: loginh'); 
}
?>
<?php
// Database connection parameters
$servername = "localhost";
$username ="root";
$password = "";
$dbname = "abc";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn) {
    //echo "Connected successfully";
    } else {
        echo "Connection failed ".mysqli_connect_error();
    }
    // Query to fetch scoreboard data
    $sql = "SELECT *, TIMESTAMPDIFF(SECOND, first_solve_time, NOW()) AS total_time_taken FROM scoreboard ORDER BY Score DESC, first_solve_time ASC";

$result = $conn->query($sql);

$result = $conn->query($sql);
?>

<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <title>TALAKUNCHI CTF</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <link rel="stylesheet" href="css/bootstrap4-neon-glow.min.css">


    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel='stylesheet' href='//cdn.jsdelivr.net/font-hack/2.020/css/hack.min.css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <link rel="stylesheet" href="css/main.css">
    <style>
        .demo {
            font-size: 30px; /* Adjust the font size as needed */
            position:absolute;
            left: 100px;
            color:red;
            font-family: 'Hack;apple-system;BlinkMacSystemFont;Segoe UI;Roboto;Helvetica Neue;Arial;sans-serif;Apple Color Emoji;Segoe UI Emoji;Segoe UI Symbol'
           }
           .welcome{
            font-size: 28px;
            color: red;
            font-family: 'Hack;apple-system;BlinkMacSystemFont;Segoe UI;Roboto;Helvetica Neue;Arial;sans-serif;Apple Color Emoji;Segoe UI Emoji;Segoe UI Symbol'
        }
        .user_name{
            font-size: 28px;
            font-family: 'Hack;apple-system;BlinkMacSystemFont;Segoe UI;Roboto;Helvetica Neue;Arial;sans-serif;Apple Color Emoji;Segoe UI Emoji;Segoe UI Symbol'
        }
        .btn{
            padding-bottom: 8%;
            font-weight: bold;
            border-color: black;
            background-color: transparent; 
        }
        .dropdown{
            padding-top: 8px;
        }
        .dropdown-menu{
            min-width: 0px;
            background-color: transparent; 
        }
        .btn-secondary:hover{
            background-color: #000;
            border-color: #000;
        }
        .show>.btn-secondary.dropdown-toggle{
            background-color: #000;
            border-color: #000;
        }
    </style>

</head>

<body class="imgloaded">
    <div class="glitch">
        <div class="glitch__img glitch__img_leaderboard"></div>
        <div class="glitch__img glitch__img_leaderboard"></div>
        <div class="glitch__img glitch__img_leaderboard"></div>
        <div class="glitch__img glitch__img_leaderboard"></div>
        <div class="glitch__img glitch__img_leaderboard"></div>
    </div>
    <?php
        // Display the welcome message with the username
        //echo "<span class='welcome'>Welcome  </span> <span class='user_name'>" . $_SESSION['user_name'] . "</span>";
        ?>
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
                        <a href="about1" class="p-3 text-decoration-none text-light bold">
                            <i class="fas fa-info-circle mr-2"></i>
                            About
                        </a>
                        <a href="Scoreboard1" class="p-3 text-decoration-none text-white bold">
                            <i class="fas fa-trophy mr-2"></i>
                            Scoreboard
                        </a>
                        <!-- <a href="logout.php" onclick="return confirmLogout()" class="p-3 text-decoration-none text-light bold">Log Out</a> -->
                        <div class="dropdown">
  <button class="btn btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="min-width: 100px;"><i class="fas fa-user mr-2"></i>
    <?php
    $username = $_SESSION['user_name']; ?>
    <?php echo $username; ?>
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="min-width: 100px;">
    <a href="#" onclick="return confirmLogout()" class="dropdown-item" style="color: white;font-weight: bold;"><i class="fas fa-sign-out-alt mr-2"></i> Log Out</a>
  </div>
</div>
                        
                    </div>
                </div>
            </nav>
            <p id="demo" class="demo"></p>
            <div id="clock" class="clock"></div>
        </div>
    </div>
   
    
    <div class="jumbotron bg-transparent mb-0 pt-3 radius-0">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <h1 class="display-1 bold color_white content__title text-center"><span class="color_danger">SCORE</span>BOARD<span class="vim-caret">&nbsp;</span></h1>
                    <p class="text-grey lead text-spacey text-center hackerFont">
                        Where the world get's ranked!
                    </p>
                </div>
            </div>
    
            <div class="row mt-5  justify-content-center">
                <div class="col-xl-10">
                    <table class="table table-hover table-striped">
                        <thead class="thead-dark hackerFont">
                            <tr>
                                <th>No</th>
                                <th>Team Name</th>
                                <th> Challenges Solved</th>
                                <th>Score</th>
                                <!-- <th>Total Time Taken</th> -->
                            </tr>
                        </thead>
                        <tbody>
                        
                           <?php
                           $counter = 1;
                           while ($row = $result->fetch_assoc()) {
                               echo "<tr>";
                               echo "<th scope='row'>" . $counter . "</th>";
                               echo "<td>" . $row['team_name'] . "</td>";
                               echo "<td>" . $row['Challenges_Solved'] . "</td>";
                               echo "<td>" . $row["Score"] . "</td>";
                            //    echo "<td>" . gmdate("H:i:s", $row["total_time_taken"]) . "</td>";
                               echo "</tr>";
                               $counter++;
                           }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Display the countdown timer in an element -->

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
    


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>

</html>
<?php  
$conn-> close();
?>


