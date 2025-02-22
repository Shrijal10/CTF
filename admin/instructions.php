<?php
session_start();
if(!isset($_SESSION['user_name'])) {
    header('Location: loginh');
    exit;
}
 

?>

<!DOCTYPE html>
<html lang="en">

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
            font-size: 28px; /* Adjust the font size as needed */
            padding-left: 630px; /* Add some padding to the right for spacing */
            right:   50px; /* Position the clock in the top right corner of the window */
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
    </style>
</head>

<body class="imgloaded">
<div>
        <?php
        // Display the welcome message with the username
       // echo "<span class='welcome'>Welcome  </span> <span class='user_name'>" . $_SESSION['user_name'] . "</span>";
        ?>
</div>
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
                <div class="container">
                    <div class="navbar-nav">
                            <h3 class="bold"><span class="color_danger">TALAKUNCHI</span><span class="color_white">CTF</span></h3>
                            <div id="demo" class="demo"></div>
                    </div>
                    
                </div>
            </nav>

        </div>
    </div>

    <div class="jumbotron bg-transparent mb-0 pt-3 radius-0">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <h1 class="display-1 bold color_white content__title text-center"><span class="color_danger">INSTRUC</span>TIONS<span class="vim-caret">&nbsp</span></h1>
                    <p class="text-grey text-spacey text-center hackerFont lead">
                        Now that you are a part of our community, you must know of some rules we follow around here.
                    </p>
                    <div class="row justify-content-center  hackerFont ">
                        <div class="col-md-10">
                            <h5 class="bold color_white pt-3">
                                General Rules and Instructions
                            </h5>
                            <ul>
                                <li>When you start the CTF, 6 hours will be alloted to complete the challenges.</li>
                                <li>There is no particular order of solving the questions.</li>
                                <li>Judging of the round will be based on the score of the team. </li>
                                <li>Ranks can be viewed on the scoreboard page. The scoreboard time is updated everytime a submission is made.</li>
                                <li>Flags found are of the format <span class="vim-caret">TKCTF{flag}.</span> Some of the files may contain just the inner text within the brackets. Make sure you submit it in the format specified. Flag text is not
                                    case sensitive.</li>
                                <li>This is a competitive environment with the aim of learning cyber security and ethical hacking. Please do not share the flags & solutions with others.</li>
                                <li>Internet access is granted. Feel free to explore and read about the concept behind the problem. </li>
                            </ul>
                            <h5 class="bold color_white pt-3">
                                Special Rules and Instructions
                            </h5>
                            <ul>
                                <li>Dont try to hack anything apart from this CTF Network </li>
                                <li>Dont try to hack other members </li>
                                <li>Dont spoil! Dont share how you solved each challenge with other members. </li>
                                <li>Performing denial of service attacks on the server will lead to disqualification. You are requested to play ethically.</li>
                                <li>Brute force attacks on the flag form is prohibited.</li>
                                <li>Remember, once the timer starts, it can't be paused. The timer will not resume if you logout and log back in.</li>
                            </ul>
                            <div class="row text-center pt-5">
                                <div class="col-xl-12">
                                    <small id="registerHelp" class="mt-2 form-text text-muted">We expect each and every one of you to comply by the rules. Failure to do so might result in a permanent ban.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
// Set the current date
var currentDate = new Date();

// Set the countdown time for today's date at 16:00:00
currentDate.setHours(16, 0, 0, 0);
var countDownDate = currentDate.getTime();

// Function to update the countdown
function updateCountdown() {
  // Get the current time
  var now = new Date().getTime();

  // Find the distance between now and the countdown time
  var distance = countDownDate - now;

  // Time calculations for hours, minutes, and seconds
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("demo").innerHTML = hours + "H "
  + minutes + "M " + seconds + "S ";

  // If the countdown is finished, redirect to 'closed.html'
  if (distance <= 0) {
    window.location.href = 'quests';
  } else {
    // Call the function recursively after 1 second
    setTimeout(updateCountdown, 1000);
  }
}

// Initial call to start the countdown
updateCountdown();
</script>
    <!-- <script>
    function updateClock() {
        var now = new Date();
        var hours = now.getHours();
        var minutes = now.getMinutes();
        var seconds = now.getSeconds();

        // Format the time
        var timeString = hours.toString().padStart(2, '0') + ':' + minutes.toString().padStart(2, '0') + ':' + seconds.toString().padStart(2, '0');

        // Update the clock element
        document.getElementById('clock').textContent = timeString;

        // Check if it's 4 pm and close the website
        if (hours == 17 && minutes == 32 && seconds == 30) {
            window.location.href = 'quests.php';
        }

        // Update every second
        setTimeout(updateClock, 1000);
    }

    // Start the clock
    updateClock();
</script> -->



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>
<?php
include("login.php");
error_reporting(0);
$userprofile = $_SESSION["username"];
if ($userprofile == true)       
{
    
}
else    
{
    header('Location: loginh'); 
}
?>