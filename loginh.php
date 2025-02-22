<?php 
session_start();
date_default_timezone_set('Asia/Kolkata');

include("login.php");
?>

<html lang="en">

<head>
    <script type="text/javascript">
        window.history.forward();
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <title>HACKLAB CTF</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap4-neon-glow.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel='stylesheet' href='//cdn.jsdelivr.net/font-hack/2.020/css/hack.min.css'>
    <link rel="stylesheet" href="css/main.css">
</head>
<style>
    input[type=number]::-moz-inner-spin-button,
    input[type=number]::-moz-outer-spin-button {
        -moz-appearance: none;
        margin: 0;
    }
</style>

<body class="imgloaded">
    <div class="glitch">
        <div class="glitch__img"></div>
        <div class="glitch__img"></div>
        <div class="glitch__img"></div>
        <div class="glitch__img"></div>
        <div class="glitch__img"></div>
    </div>
    <div class="navbar-dark text-white">
        <div class="container">
            <nav class="navbar px-0 navbar-expand-lg navbar-dark">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <h3 class="bold"><span class="color_danger">HACKLAB</span><span class="color_white">CTF</span></h3>
                    </div>
                    <div class="navbar-nav ml-auto">
                        <a href="loginh" class="p-3 text-decoration-none text-white bold">
                            <i class="fas fa-sign-in-alt fa-lg mr-2"></i> Login
                        </a>
                        <a href="admin/admin_login.php" class="p-3 text-decoration-none text-white bold">
                            <i class="fas fa-sign-in-alt fa-lg mr-2"></i> Admin
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <div class="jumbotron bg-transparent mb-0 pt-3 radius-0">
        <div class="container">
            <div class="row">
                <div class="col-xl-8">
                    <h1 class="display-1 bold color_white content__title">HACKLAB CTF<span class="vim-caret">&nbsp;</span></h1>
                    <p class="text-grey text-spacey hackerFont lead mb-5">
                        Type your credentials to conquer the world
                    </p>
                    <form action="" method="POST" autocomplete="off">
                        <div class="row hackerFont">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="team_name" placeholder="Team name" name="team_name" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
                                    <small id="passHelp" class="form-text text-muted">Make sure nobody's behind you</small>
                                </div>
                                <div class="row">
                                    <div class="input-field">
                                        <input type="submit" value="Login" class="btn btn-outline-danger btn-shadow px-3 my-2 ml-0 ml-sm-3" name="button" style="cursor:pointer;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <?php
                    if (isset($_POST['button'])) {
                        $team_name = $_POST['team_name'];
                        $password = $_POST['password'];

                        // Prepared statement to prevent SQL Injection
                        $query = "SELECT * FROM login WHERE team_name = ? AND password = ?";
                        $stmt = mysqli_prepare($conn, $query);
                        mysqli_stmt_bind_param($stmt, "ss", $team_name, $password);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $row = mysqli_fetch_assoc($result);

                        if ($row) {
                            // Check if user is already logged in
                            if (isset($_SESSION['user_name']) && $_SESSION['user_name'] == $team_name) {
                                echo '<div class="alert2 alert-danger" style="border: 1px solid transparent; background-color: transparent; color: red; font-size: 20px;" role="alert">Already logged in</div>';
                            } else {
                                $session_token = bin2hex(random_bytes(16));
                                $_SESSION['user_name'] = $team_name;
                                $_SESSION['session_token'] = $session_token;

                                // Update session token in DB
                                $update_query = "UPDATE login SET session_token = ? WHERE team_name = ?";
                                $stmt = mysqli_prepare($conn, $update_query);
                                mysqli_stmt_bind_param($stmt, "ss", $session_token, $team_name);
                                mysqli_stmt_execute($stmt);

                                echo '<meta http-equiv="refresh" content="0; url=instructions"/>';
                            }
                        } else {
                            echo '<div class="alert2 alert-danger" style="border: 1px solid transparent; background-color: transparent; color: red; font-size: 20px;" role="alert">Wrong credentials</div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
