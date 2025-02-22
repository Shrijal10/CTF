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
    <title>HackLab CTF</title>

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
                            <h3 class="bold"><span class="color_danger">HackLab</span><span class="color_white">CTF</span></h3>
                    </div>
                    <div class="navbar-nav ml-auto">
                        <a href="about1" class="p-3 text-decoration-none text-white bold">
                            <i class="fas fa-info-circle mr-2"></i>
                            About
                        </a>
                        <a href="Scoreboard1" class="p-3 text-decoration-none text-light bold">
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
                            A capture the flag (CTF) contest is a special kind of cybersecurity competition designed to challenge its participants to solve computer security problems and/or capture and defend computer systems. The game consists of a series of challenges where participants
                            must reverse engineer, break, hack, decrypt, or do whatever it takes to solve the challenge. The challenges are all set up with the intent of being hacked, making it an excellent, legal way to get hands-on experience.
                            <h5 class="bold color_white pt-3">
                                About HackLab CTF
                            </h5>
                            HackLab CTF is a sub event of PICT's <a href="https://pictinc.org">Impetus and Concepts</a> mega event where students partcipate from all over the world!<br> Out aim is about spreading the importance of cybersecurity in today's
                            community. Each and every person should be aware of different vulnerabilities in systems as well as how to protect onselves agains cyber attacks<br> We believe gamification is the best technique to teach oneself about cybersecurity.
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</script><script>
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
