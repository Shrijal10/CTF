<?php include("login.php");
session_start();
error_reporting(0);
$userprofile = $_SESSION["user_name"];
if ($userprofile == true)       
{
    //echo "<span class='welcome'>Welcome  </span> <span class='user_name'>" . $_SESSION['user_name'] . "</span>";
}
else    
{
    header('Location: loginh'); 
}
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
    <link rel="stylesheet" href="css/main.css">
    <style>
        .demo {
            font-size: 30px; /* Adjust the font size as needed */
            position:absolute;
            left: 100px;
            color: red;
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
<div id="clock" class="clock"></div>
    <div class="glitch">
        <div style="position: fixed;" class="glitch__img"></div>
        <div style="position: fixed;" class="glitch__img"></div>
        <div style="position: fixed;" class="glitch__img"></div>
        <div style="position: fixed;" class="glitch__img"></div>
        <div style="position: fixed;" class="glitch__img"></div>
    </div>
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
                        <a href="quests"class="p-3 text-decoration-none text-light bold">
                            <i class="fas fa-laptop-code mr-2"></i>
                            Challenges
                        </a>
                        <!-- <a href="logout.php" onclick="return confirmLogout()" class="p-3 text-decoration-none text-light bold">Log Out</a> -->
                        <div class="dropdown">
  <button class="btn btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="min-width: 100px;"><i class="fas fa-user mr-2"></i>
    <?php
    $username = $_SESSION['user_name']; ?>
    <?php echo $username; ?>
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="min-width: 100px;">
    <a href="logout.php" onclick="return confirmLogout()" class="dropdown-item" style="color: white;font-weight: bold;"><i class="fas fa-sign-out-alt mr-2"></i> Log Out</a>
  </div>
</div>
                    
                    </div>
                </div>
            </nav>
            <p id="demo" class="demo"></p>
        </div>
    </div>

    <div class="jumbotron bg-transparent mb-0 pt-3 radius-0">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <h1 class="display-1 bold color_white content__title text-center"><span class="color_danger">ABOUT</span>US<span class="vim-caret">&nbsp;</span></h1>
                    <p class="text-grey text-spacey text-center hackerFont lead">
                        A community of like minded individuals who support cybersecurity and FOSS.
                    </p>
                    <div class="row justify-content-center hackerFont">
                        <div class="col-md-8">
                            <h5 class="bold color_white pt-3">
                                What is Capture the Flag?
                            </h5>
                            CTF stands for Capture The Flag, which is a type of cybersecurity competition that challenges participants to solve a variety of tasks related to computer security, cryptography, reverse engineering, and other related fields. The goal is typically to find hidden flags within computer systems or networks, which are usually pieces of data or strings that signify a successful exploit or completion of a challenge.
                            <h5 class="bold color_white pt-3">
                                About TALAKUNCHI CTF
                            </h5>
                            Talakunchi CTF is an annual internal competition designed to enhance and evaluate employees' skills. The primary aim of this activity is to raise awareness among employees and facilitate learning of techniques commonly utilized in CTF (Capture The Flag) competitions. By participating in Talakunchi CTF, employees have the opportunity to sharpen their cybersecurity skills in a collaborative and engaging environment, contributing to their professional development and the overall security posture of the organization.
                            <br>Flag:- TKCTF{Welcome_to_TKCTF}
    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <html>
<head>
  <title>Countdown Timer</title>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
  <div id="demo"></div>

  <script>
  // Set the countdown time to August 1, 2024, 17:45:00 in India timezone
  var countDownDate = new Date('June 30, 2024 17:45:00 GMT+0530');

  // Function to update the countdown
  function updateCountdown() {
    // Get the current time in India
    var now = new Date().getTime();

    // Find the distance between now and the countdown time
    var distance = countDownDate - now;

    // Time calculations for hours, minutes, and seconds
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Display the result in the element with id="demo"
    document.getElementById("demo").innerHTML = "<i class='fas fa-stopwatch'></i> " + hours + "H:" +
      minutes + "M:" + seconds + "S ";

    // If the countdown is finished, redirect to 'closed.html'
    if (distance <= 0) {
      window.location.href = 'scoreboard1.php';
    } else {
      // Call the function recursively after 1 second
      setTimeout(updateCountdown, 1000);
    }
  }

  // Initial call to start the countdown
  updateCountdown();
</script>


</body>
</html>
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
