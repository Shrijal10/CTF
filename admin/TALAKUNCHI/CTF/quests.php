<?php include("login.php");
session_start();
error_reporting(0);
$userprofile = $_SESSION["user_name"];
if ($userprofile == true)       
{
        // Display the welcome message with the username
        //echo "<span class='welcome'>Welcome </span> <span class='user_name'>" . $_SESSION['user_name'] . "</span>";
}
else    
{
   header('Location: loginh'); 
}

?>
              <?php
              session_start();
                               
// Check if the form is submitted
function solvers($conn, $challengeId, $flag,$teamName) {
    // Check if the flag is correct for the challenge
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag']) && isset($_POST['challenge_id']) && $_POST['challenge_id'] == $challengeId) {
        // Escape user inputs to prevent SQL injection
        $submitted_flag = mysqli_real_escape_string($conn, $_POST['flag']);
        $actual_flag = mysqli_real_escape_string($conn, $flag);

        // Fetch the actual flag from the database using a prepared statement
        $stmt = $conn->prepare("SELECT flag FROM challenges WHERE challenge_id = ?");
        $stmt->bind_param("i", $challengeId);
        $stmt->execute();
        $stmt->bind_result($actual_flag);
        $stmt->fetch();
        $stmt->close();

        if ($submitted_flag === $actual_flag) {
            // Check if the challenge is already solved
            if (!is_challenge_solved($conn, $challengeId, $teamName)) {
                // Flag is correct and challenge is not already solved, update the solver count in the database using a prepared statement
                $stmt = $conn->prepare("UPDATE challenges SET solvers = solvers + 1 WHERE challenge_id = ?");
                $stmt->bind_param("i", $challengeId);
                if ($stmt->execute()) {
                    // Update successful
                } else {
                    echo "Error updating solver count: " . $stmt->error . "<br>";
                }
                $stmt->close();
            }
        }
    }


    // Retrieve the updated solver count from the database
    $numSolvers = 0;
    $stmtSolvers = $conn->prepare("SELECT solvers FROM challenges WHERE challenge_id = ?");
    $stmtSolvers->bind_param("i", $challengeId);
    $stmtSolvers->execute();
    $stmtSolvers->bind_result($numSolvers);
    $stmtSolvers->fetch();
    $stmtSolvers->close();
    
    

    // Display the updated solver count
    echo $numSolvers;
}

// Function to check if a challenge is already solved based on the cookie
function is_challenge_solved($conn, $challengeId, $teamName) {
    $stmt = $conn->prepare("SELECT * FROM solved_challenges WHERE team_name = ? AND challenge_id = ?");
    $stmt->bind_param("ss", $teamName, $challengeId);
    $stmt->execute();
    $stmt->store_result();
    $numRows = $stmt->num_rows;
    $stmt->close();

    return $numRows > 0;
}

function updateChallengeSolvers($conn, $challengeId)
{
    // Check if the challenge_id already exists in challenge_solvers table
    $queryCheck = "SELECT COUNT(*) AS count FROM challenge_solvers WHERE challenge_id = $challengeId";
    $resultCheck = mysqli_query($conn, $queryCheck);
    $rowCheck = mysqli_fetch_assoc($resultCheck);
    $count = $rowCheck['count'];

    if ($count > 0) {
        // If the challenge_id exists, increment the num_teams_solved
        $queryUpdate = "UPDATE challenge_solvers SET num_teams_solved = num_teams_solved + 1 WHERE challenge_id = $challengeId";
        mysqli_query($conn, $queryUpdate);
    } else {
        // If the challenge_id does not exist, insert a new row
        $queryInsert = "INSERT INTO challenge_solvers (challenge_id, num_teams_solved) VALUES ($challengeId, 1)";
        mysqli_query($conn, $queryInsert);
    }
}



function getpoints($conn, $pointsToAdd, $challengeId, $difficulty)
{
    $queryCount = "SELECT num_teams_solved FROM challenge_solvers WHERE challenge_id = ?";
    $stmt = mysqli_prepare($conn, $queryCount);
    mysqli_stmt_bind_param($stmt, "i", $challengeId);
    mysqli_stmt_execute($stmt);
    $resultCount = mysqli_stmt_get_result($stmt);
    
    // Rest of the code remains the same

    if ($resultCount) {
        $row = mysqli_fetch_assoc($resultCount);
        $numTeamsSolved = $row['num_teams_solved'];

        // Check if the number of solvers for this challenge is greater than or equal to 5
        if ($numTeamsSolved >= 5) {
            // Calculate the number of times to deduct points (every group of 5 teams)
            $numDeductions = floor($numTeamsSolved / 5);

            // Deduct points based on the difficulty
            switch ($difficulty) {
                case 'Easy':
                    $pointsToAdd -= min(5 * $numDeductions, $pointsToAdd / 2);
                    break;
                case 'Medium':
                    $pointsToAdd -= min(10 * $numDeductions, $pointsToAdd / 2);
                    break;
                case 'Hard':
                    $pointsToAdd -= min(15 * $numDeductions, $pointsToAdd / 2);
                    break;
                default:
                    // Default deduction
                    $pointsToAdd -= min(5 * $numDeductions, $pointsToAdd / 2);
            }
        }

        echo "$pointsToAdd points";
    }
}
function dalpoints($conn, $pointsToAdd, $challengeId)
{
    $queryCount = "SELECT num_teams_solved FROM challenge_solvers WHERE challenge_id = ?";
    $stmt = mysqli_prepare($conn, $queryCount);
    mysqli_stmt_bind_param($stmt, "i", $challengeId);
    mysqli_stmt_execute($stmt);
    $resultCount = mysqli_stmt_get_result($stmt);
    
    // Rest of the code remains the same

    if ($resultCount) {
        $row = mysqli_fetch_assoc($resultCount);
        $numTeamsSolved = $row['num_teams_solved'];
     echo "$pointsToAdd points";
    }
}



function updateScoreboard($conn, $teamName, $pointsToAdd, $challengeId) {
    // Check if the team exists in the scoreboard
    $checkQuery = "SELECT * FROM scoreboard WHERE team_name = ?";
    $stmt = mysqli_prepare($conn, $checkQuery);
    mysqli_stmt_bind_param($stmt, "s", $teamName);
    mysqli_stmt_execute($stmt);
    $checkResult = mysqli_stmt_get_result($stmt);
    
    // Rest of the code continues here


    if (!$checkResult) {
        echo "Error checking scoreboard: " . mysqli_error($conn);
        exit();
    }

    if (mysqli_num_rows($checkResult) > 0) {
    // Team exists, check if the challenge has already been solved by this team
    $checkSolvedQuery = "SELECT * FROM solved_challenges WHERE team_name = ? AND challenge_id = ?";
    $stmt = mysqli_prepare($conn, $checkSolvedQuery);
    mysqli_stmt_bind_param($stmt, "si", $teamName, $challengeId);
    mysqli_stmt_execute($stmt);
    $checkSolvedResult = mysqli_stmt_get_result($stmt);
    
    // Rest of the code continues here
        if (!$checkSolvedResult) {
            echo "Error checking if challenge is already solved: " . mysqli_error($conn);
            exit();
        }

        if (mysqli_num_rows($checkSolvedResult) == 0) {
            // Update the scoreboard
            $updateQuery = "UPDATE scoreboard 
            SET Challenges_Solved = Challenges_Solved + 1, 
                Score = Score + $pointsToAdd,
                first_solve_time = NOW()
            WHERE team_name = '$teamName'";
            $updateResult = mysqli_query($conn, $updateQuery);

            if (!$updateResult) {
                echo "Error updating scoreboard: " . mysqli_error($conn);
                exit();
            }

            // Mark the challenge as solved for this team in the database
            $insertSolvedQuery = "INSERT INTO solved_challenges (team_name, challenge_id, solved) 
                                  VALUES ('$teamName', $challengeId, true)";
            $insertSolvedResult = mysqli_query($conn, $insertSolvedQuery);
            if (!$insertSolvedResult) {
                echo "Error marking challenge as solved: " . mysqli_error($conn);
                exit();
            }

            echo "Challenge is Solved!";
            // Change the color of the challenge card to green
            echo "<script>
                    var challengeCard = document.querySelector('.challenge-card[data-challenge-id=\"$challengeId\"]');
                    if (challengeCard) {
                        challengeCard.classList.add('solved');
                    }
                    document.getElementById('flag').disabled = true;
                    document.getElementById('submit').disabled = true;
                  </script>";
        } else {
            // If the challenge is already solved, update the first_solve_time
           $updateQuery = "UPDATE scoreboard 
                           SET first_solve_time = NOW()
                           WHERE team_name = ?";
           $stmt = mysqli_prepare($conn, $updateQuery);
           mysqli_stmt_bind_param($stmt, "s", $teamName);
           mysqli_stmt_execute($stmt);
           $updateResult = mysqli_query($conn, $updateQuery);

            if (!$updateResult) {
                echo "Error updating scoreboard: " . mysqli_error($conn);
                exit();
            }

            echo "Challenge is already solved by your team!";
        }
    } else {
        // Team does not exist, insert a new entry
        $insertQuery = "INSERT INTO scoreboard (team_name, Challenges_Solved, Score) 
                        VALUES ('$teamName', 1, $pointsToAdd)";
        $insertResult = mysqli_query($conn, $insertQuery);

        if (!$insertResult) {
            echo "Error inserting into scoreboard: " . mysqli_error($conn);
            exit();
        }

        // Mark the challenge as solved for this team in the database
        $insertSolvedQuery = "INSERT INTO solved_challenges (team_name, challenge_id, solved) 
                              VALUES ('$teamName', $challengeId, true)";
        $insertSolvedResult = mysqli_query($conn, $insertSolvedQuery);
        if (!$insertSolvedResult) {
            echo "Error marking challenge as solved: " . mysqli_error($conn);
            exit();
        }

        echo "Challenge is Solved!";
        // Change the color of the challenge card to green
        echo "<script>
              var challengeCard = document.querySelector('.challenge-card[data-challenge-id=\"$challengeId\"]');
              if (challengeCard) {
                  challengeCard.classList.add('solved');
              }
              document.getElementById('flag').disabled = true;
              document.getElementById('submit').disabled = true;
              </script>";
    }
}
            
function getDifficulty($conn, $challengeId)
{
    $queryDifficulty = "SELECT difficulty FROM challenges WHERE challenge_id = ?";
    $stmt = mysqli_prepare($conn, $queryDifficulty);
    mysqli_stmt_bind_param($stmt, "i", $challengeId);
    mysqli_stmt_execute($stmt);
    $resultDifficulty = mysqli_stmt_get_result($stmt);
    if ($resultDifficulty) {
        $row = mysqli_fetch_assoc($resultDifficulty);
        return $row['difficulty'];
    }
    return "N/A"; // Default value if difficulty not found
}
           
            
            function getchallengeColor($conn, $challengeId, $teamName){
                session_start(); // Start the session
            
                // Check if the challenge has been solved by the current team in the session
                if (isset($_SESSION['solved_challenges'][$challengeId]) && $_SESSION['solved_challenges'][$challengeId] === true) {
                    return 'solved';
                }
            
                // Check if the flag is correct for the challenge
                if (isset($_POST['flag']) && isset($_POST['challenge_id']) && $_POST['challenge_id'] == $challengeId) {
                    // Escape user inputs to prevent SQL injection
                    $flag = mysqli_real_escape_string($conn, $_POST['flag']);
                    $checkFlagQuery = "SELECT flag FROM challenges WHERE challenge_id = ?";
                    $stmt = mysqli_prepare($conn, $checkFlagQuery);
                    mysqli_stmt_bind_param($stmt, "i", $challengeId);
                    mysqli_stmt_execute($stmt);
                    $checkFlagResult = mysqli_stmt_get_result($stmt);
                    if ($checkFlagResult) {
                        $row = mysqli_fetch_assoc($checkFlagResult);
                        $actualFlag = $row['flag'];
                        if ($flag === $actualFlag) {
                            // Mark the challenge as solved in the session
                            $_SESSION['solved_challenges'][$challengeId] = true;
                            return 'solved';
                        }
                    }
                }            
                // Check if the challenge has been solved by the current team in the database
                $checkSolvedQuery = "SELECT * FROM solved_challenges WHERE team_name = ? AND challenge_id = ?";
                $stmt = mysqli_prepare($conn, $checkSolvedQuery);
                mysqli_stmt_bind_param($stmt, "si", $teamName, $challengeId);
                mysqli_stmt_execute($stmt);
                $checkSolvedResult = mysqli_stmt_get_result($stmt);
                if (!$checkSolvedResult) {
                    echo "Error checking if challenge is already solved: " . mysqli_error($conn);
                    exit();
                }
            
                if (mysqli_num_rows($checkSolvedResult) > 0) {
                    // Mark the challenge as solved in the session
                    $_SESSION['solved_challenges'][$challengeId] = true;
                    return 'solved';
                }
            
                return '';
            }
            
            
            function handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId) {
                $query = "SELECT * FROM challenges WHERE flag = ? AND challenge_id = ?";
                $stmt = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($stmt, "si", $flag, $challengeId);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
            
                if (!$result) {
                    echo "Error: " . mysqli_error($conn);
                    exit();
                }
            
                if (mysqli_num_rows($result) > 0) {
                    $checkSolvedQuery = "SELECT * FROM solved_challenges WHERE team_name = ? AND challenge_id = ?";
                    $stmt = mysqli_prepare($conn, $checkSolvedQuery);
                    mysqli_stmt_bind_param($stmt, "si", $teamName, $challengeId);
                    mysqli_stmt_execute($stmt);
                    $checkSolvedResult = mysqli_stmt_get_result($stmt);
                    if (!$checkSolvedResult) {
                        echo "Error checking if challenge is already solved: " . mysqli_error($conn);
                        exit();
                    }
            
                    if (mysqli_num_rows($checkSolvedResult) == 0) {
                        // If the challenge is not solved, update the scoreboard and set the flag as correct
                        updateScoreboard($conn, $teamName, $pointsToAdd, $challengeId);
                        updateChallengeSolvers($conn, $challengeId);
                        getDifficulty($conn, $challengeId);
                        echo "<script>
                                document.getElementById('flag').disabled = true;
                                document.getElementById('submit').disabled = true;
                                document.getElementById('already_solved').style.display = 'none';
                              </script>";
                    }
                } else {
                    echo "Incorrect flag!";
                }
            }
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag'])  && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 1) {
    $pointsToAdd = 100;
    $queryCount = "SELECT COUNT(DISTINCT team_name) AS num_teams FROM scoreboard WHERE Challenges_Solved > 0";
    $stmt = mysqli_prepare($conn, $queryCount);
    mysqli_stmt_execute($stmt);
    $resultCount = mysqli_stmt_get_result($stmt);
    if ($resultCount) {
        $row = mysqli_fetch_assoc($resultCount);
        $numTeamsSolved = $row['num_teams'];

        // Calculate the number of times to deduct points (every group of 5 teams)
        $numDeductions = floor($numTeamsSolved / 5);

        // Deduct points for each group of 5 teams
        for ($i = 0; $i < $numDeductions; $i++) {
            $pointsToAdd -= 5;
        }
    }

    // Escape user inputs to prevent SQL injection
    $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
    $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
    $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
    $challengeId = mysqli_real_escape_string($conn, $_POST['challenge_id']);

    //handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag'])  && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 2) {
    
    $queryCount = "SELECT COUNT(DISTINCT team_name) AS num_teams FROM scoreboard WHERE Challenges_Solved > 0 ";
    if ($resultCount) {
        $row = mysqli_fetch_assoc($resultCount);
        $numTeamsSolved = $row['num_teams'];

        // Calculate the number of times to deduct points (every group of 5 teams)
        $numDeductions = floor($numTeamsSolved / 5);

        // Deduct points for each group of 5 teams
        for ($i = 0; $i < $numDeductions; $i++) {
            $pointsToAdd -= 10;
        }
    }

    // Escape user inputs to prevent SQL injection
    $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
    $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
    $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
    $challengeId = mysqli_real_escape_string($conn, $_POST['challenge_id']);

    //handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag'])  && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 3) {
    
    $queryCount = "SELECT COUNT(DISTINCT team_name) AS num_teams FROM scoreboard WHERE Challenges_Solved > 0";
$stmt = mysqli_prepare($conn, $queryCount);
mysqli_stmt_execute($stmt);
$resultCount = mysqli_stmt_get_result($stmt);
    if ($resultCount) {
        $row = mysqli_fetch_assoc($resultCount);
        $numTeamsSolved = $row['num_teams'];

        // Calculate the number of times to deduct points (every group of 5 teams)
        $numDeductions = floor($numTeamsSolved / 5);

        // Deduct points for each group of 5 teams
        for ($i = 0; $i < $numDeductions; $i++) {
            $pointsToAdd -= 15;
        }
    }

    // Escape user inputs to prevent SQL injection
    $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
    $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
    $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
    $challengeId = mysqli_real_escape_string($conn, $_POST['challenge_id']);

    //handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag'])  && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 4) {
    $queryCount = "SELECT COUNT(DISTINCT team_name) AS num_teams FROM scoreboard WHERE Challenges_Solved > 0";
$stmt = mysqli_prepare($conn, $queryCount);
mysqli_stmt_execute($stmt);
$resultCount = mysqli_stmt_get_result($stmt);
    if ($resultCount) {
        $row = mysqli_fetch_assoc($resultCount);
        $numTeamsSolved = $row['num_teams'];

        // Calculate the number of times to deduct points (every group of 5 teams)
        $numDeductions = floor($numTeamsSolved / 5);

        // Deduct points for each group of 5 teams
        for ($i = 0; $i < $numDeductions; $i++) {
            $pointsToAdd -= 15;
        }
    }

    // Escape user inputs to prevent SQL injection
    $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
    $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
    $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
    $challengeId = mysqli_real_escape_string($conn, $_POST['challenge_id']);

    //handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag'])  && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 5) {
    
    $queryCount = "SELECT COUNT(DISTINCT team_name) AS num_teams FROM scoreboard WHERE Challenges_Solved > 0";
$stmt = mysqli_prepare($conn, $queryCount);
mysqli_stmt_execute($stmt);
$resultCount = mysqli_stmt_get_result($stmt);
    if ($resultCount) {
        $row = mysqli_fetch_assoc($resultCount);
        $numTeamsSolved = $row['num_teams'];

        // Calculate the number of times to deduct points (every group of 5 teams)
        $numDeductions = floor($numTeamsSolved / 5);

        // Deduct points for each group of 5 teams
        for ($i = 0; $i < $numDeductions; $i++) {
            $pointsToAdd -= 5;
        }
    }

    // Escape user inputs to prevent SQL injection
    $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
    $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
    $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
    $challengeId = mysqli_real_escape_string($conn, $_POST['challenge_id']);

    //handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag'])  && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 6) {
    
    $queryCount = "SELECT COUNT(DISTINCT team_name) AS num_teams FROM scoreboard WHERE Challenges_Solved > 0";
$stmt = mysqli_prepare($conn, $queryCount);
mysqli_stmt_execute($stmt);
$resultCount = mysqli_stmt_get_result($stmt);
    if ($resultCount) {
        $row = mysqli_fetch_assoc($resultCount);
        $numTeamsSolved = $row['num_teams'];

        // Calculate the number of times to deduct points (every group of 5 teams)
        $numDeductions = floor($numTeamsSolved / 5);

        // Deduct points for each group of 5 teams
        for ($i = 0; $i < $numDeductions; $i++) {
            $pointsToAdd -= 5;
        }
    }

    // Escape user inputs to prevent SQL injection
    $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
    $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
    $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
    $challengeId = mysqli_real_escape_string($conn, $_POST['challenge_id']);

    //handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag'])  && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 7) {
    
    $queryCount = "SELECT COUNT(DISTINCT team_name) AS num_teams FROM scoreboard WHERE Challenges_Solved > 0";
$stmt = mysqli_prepare($conn, $queryCount);
mysqli_stmt_execute($stmt);
$resultCount = mysqli_stmt_get_result($stmt);
    if ($resultCount) {
        $row = mysqli_fetch_assoc($resultCount);
        $numTeamsSolved = $row['num_teams'];

        // Calculate the number of times to deduct points (every group of 5 teams)
        $numDeductions = floor($numTeamsSolved / 5);

        // Deduct points for each group of 5 teams
        for ($i = 0; $i < $numDeductions; $i++) {
            $pointsToAdd -= 5;
        }
    }

    // Escape user inputs to prevent SQL injection
    $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
    $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
    $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
    $challengeId = mysqli_real_escape_string($conn, $_POST['challenge_id']);

    //handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag'])  && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 8) {
    
    $queryCount = "SELECT COUNT(DISTINCT team_name) AS num_teams FROM scoreboard WHERE Challenges_Solved > 0";
$stmt = mysqli_prepare($conn, $queryCount);
mysqli_stmt_execute($stmt);
$resultCount = mysqli_stmt_get_result($stmt);
    if ($resultCount) {
        $row = mysqli_fetch_assoc($resultCount);
        $numTeamsSolved = $row['num_teams'];

        // Calculate the number of times to deduct points (every group of 5 teams)
        $numDeductions = floor($numTeamsSolved / 5);

        // Deduct points for each group of 5 teams
        for ($i = 0; $i < $numDeductions; $i++) {
            $pointsToAdd -= 5;
        }
    }

    // Escape user inputs to prevent SQL injection
    $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
    $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
    $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
    $challengeId = mysqli_real_escape_string($conn, $_POST['challenge_id']);

    //handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag'])  && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 9) {
    
    $queryCount = "SELECT COUNT(DISTINCT team_name) AS num_teams FROM scoreboard WHERE Challenges_Solved > 0";
$stmt = mysqli_prepare($conn, $queryCount);
mysqli_stmt_execute($stmt);
$resultCount = mysqli_stmt_get_result($stmt);
    if ($resultCount) {
        $row = mysqli_fetch_assoc($resultCount);
        $numTeamsSolved = $row['num_teams'];

        // Calculate the number of times to deduct points (every group of 5 teams)
        $numDeductions = floor($numTeamsSolved / 5);

        // Deduct points for each group of 5 teams
        for ($i = 0; $i < $numDeductions; $i++) {
            $pointsToAdd -= 10;
        }
    }

    // Escape user inputs to prevent SQL injection
    $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
    $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
    $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
    $challengeId = mysqli_real_escape_string($conn, $_POST['challenge_id']);

    //handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag'])  && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 10) {
    
    $queryCount = "SELECT COUNT(DISTINCT team_name) AS num_teams FROM scoreboard WHERE Challenges_Solved > 0";
$stmt = mysqli_prepare($conn, $queryCount);
mysqli_stmt_execute($stmt);
$resultCount = mysqli_stmt_get_result($stmt);
    if ($resultCount) {
        $row = mysqli_fetch_assoc($resultCount);
        $numTeamsSolved = $row['num_teams'];

        // Calculate the number of times to deduct points (every group of 5 teams)
        $numDeductions = floor($numTeamsSolved / 5);

        // Deduct points for each group of 5 teams
        for ($i = 0; $i < $numDeductions; $i++) {
            $pointsToAdd -= 10;
        }
    }

    // Escape user inputs to prevent SQL injection
    $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
    $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
    $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
    $challengeId = mysqli_real_escape_string($conn, $_POST['challenge_id']);

    //handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag'])  && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 11) {
    
    $queryCount = "SELECT COUNT(DISTINCT team_name) AS num_teams FROM scoreboard WHERE Challenges_Solved > 0";
$stmt = mysqli_prepare($conn, $queryCount);
mysqli_stmt_execute($stmt);
$resultCount = mysqli_stmt_get_result($stmt);
    if ($resultCount) {
        $row = mysqli_fetch_assoc($resultCount);
        $numTeamsSolved = $row['num_teams'];

        // Calculate the number of times to deduct points (every group of 5 teams)
        $numDeductions = floor($numTeamsSolved / 5);

        // Deduct points for each group of 5 teams
        for ($i = 0; $i < $numDeductions; $i++) {
            $pointsToAdd -= 15;
        }
    }

    // Escape user inputs to prevent SQL injection
    $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
    $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
    $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
    $challengeId = mysqli_real_escape_string($conn, $_POST['challenge_id']);

    //handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag'])  && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 12) {
    
    $queryCount = "SELECT COUNT(DISTINCT team_name) AS num_teams FROM scoreboard WHERE Challenges_Solved > 0";
$stmt = mysqli_prepare($conn, $queryCount);
mysqli_stmt_execute($stmt);
$resultCount = mysqli_stmt_get_result($stmt);
    if ($resultCount) {
        $row = mysqli_fetch_assoc($resultCount);
        $numTeamsSolved = $row['num_teams'];

        // Calculate the number of times to deduct points (every group of 5 teams)
        $numDeductions = floor($numTeamsSolved / 5);

        // Deduct points for each group of 5 teams
        for ($i = 0; $i < $numDeductions; $i++) {
            $pointsToAdd -= 5;
        }
    }

    // Escape user inputs to prevent SQL injection
    $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
    $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
    $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
    $challengeId = mysqli_real_escape_string($conn, $_POST['challenge_id']);

    //handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag'])  && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 13) {
    
    $queryCount = "SELECT COUNT(DISTINCT team_name) AS num_teams FROM scoreboard WHERE Challenges_Solved > 0";
$stmt = mysqli_prepare($conn, $queryCount);
mysqli_stmt_execute($stmt);
$resultCount = mysqli_stmt_get_result($stmt);
    if ($resultCount) {
        $row = mysqli_fetch_assoc($resultCount);
        $numTeamsSolved = $row['num_teams'];

        // Calculate the number of times to deduct points (every group of 5 teams)
        $numDeductions = floor($numTeamsSolved / 5);

        // Deduct points for each group of 5 teams
        for ($i = 0; $i < $numDeductions; $i++) {
            $pointsToAdd -= 10;
        }
    }

    // Escape user inputs to prevent SQL injection
    $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
    $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
    $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
    $challengeId = mysqli_real_escape_string($conn, $_POST['challenge_id']);

    //handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag'])  && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 14) {
    
    $queryCount = "SELECT COUNT(DISTINCT team_name) AS num_teams FROM scoreboard WHERE Challenges_Solved > 0";
$stmt = mysqli_prepare($conn, $queryCount);
mysqli_stmt_execute($stmt);
$resultCount = mysqli_stmt_get_result($stmt);
    if ($resultCount) {
        $row = mysqli_fetch_assoc($resultCount);
        $numTeamsSolved = $row['num_teams'];

        // Calculate the number of times to deduct points (every group of 5 teams)
        $numDeductions = floor($numTeamsSolved / 5);

        // Deduct points for each group of 5 teams
        for ($i = 0; $i < $numDeductions; $i++) {
            $pointsToAdd -= 10;
        }
    }

    // Escape user inputs to prevent SQL injection
    $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
    $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
    $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
    $challengeId = mysqli_real_escape_string($conn, $_POST['challenge_id']);

    //handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag'])  && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 15) {
    
    $queryCount = "SELECT COUNT(DISTINCT team_name) AS num_teams FROM scoreboard WHERE Challenges_Solved > 0";
$stmt = mysqli_prepare($conn, $queryCount);
mysqli_stmt_execute($stmt);
$resultCount = mysqli_stmt_get_result($stmt);
    if ($resultCount) {
        $row = mysqli_fetch_assoc($resultCount);
        $numTeamsSolved = $row['num_teams'];

        // Calculate the number of times to deduct points (every group of 5 teams)
        $numDeductions = floor($numTeamsSolved / 5);

        // Deduct points for each group of 5 teams
        for ($i = 0; $i < $numDeductions; $i++) {
            $pointsToAdd -= 5;
        }
    }

    // Escape user inputs to prevent SQL injection
    $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
    $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
    $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
    $challengeId = mysqli_real_escape_string($conn, $_POST['challenge_id']);

    //handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag'])  && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 16) {
    
    $queryCount = "SELECT COUNT(DISTINCT team_name) AS num_teams FROM scoreboard WHERE Challenges_Solved > 0";
$stmt = mysqli_prepare($conn, $queryCount);
mysqli_stmt_execute($stmt);
$resultCount = mysqli_stmt_get_result($stmt);
    if ($resultCount) {
        $row = mysqli_fetch_assoc($resultCount);
        $numTeamsSolved = $row['num_teams'];

        // Calculate the number of times to deduct points (every group of 5 teams)
        $numDeductions = floor($numTeamsSolved / 5);

        // Deduct points for each group of 5 teams
        for ($i = 0; $i < $numDeductions; $i++) {
            $pointsToAdd -= 5;
        }
    }

    // Escape user inputs to prevent SQL injection
    $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
    $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
    $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
    $challengeId = mysqli_real_escape_string($conn, $_POST['challenge_id']);

    //handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag'])  && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 17) {
    
    $queryCount = "SELECT COUNT(DISTINCT team_name) AS num_teams FROM scoreboard WHERE Challenges_Solved > 0";
$stmt = mysqli_prepare($conn, $queryCount);
mysqli_stmt_execute($stmt);
$resultCount = mysqli_stmt_get_result($stmt);
    if ($resultCount) {
        $row = mysqli_fetch_assoc($resultCount);
        $numTeamsSolved = $row['num_teams'];

        // Calculate the number of times to deduct points (every group of 5 teams)
        $numDeductions = floor($numTeamsSolved / 5);

        // Deduct points for each group of 5 teams
        for ($i = 0; $i < $numDeductions; $i++) {
            $pointsToAdd -= 10;
        }
    }

    // Escape user inputs to prevent SQL injection
    $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
    $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
    $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
    $challengeId = mysqli_real_escape_string($conn, $_POST['challenge_id']);

    //handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag'])  && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 18) {
    
    $queryCount = "SELECT COUNT(DISTINCT team_name) AS num_teams FROM scoreboard WHERE Challenges_Solved > 0";
$stmt = mysqli_prepare($conn, $queryCount);
mysqli_stmt_execute($stmt);
$resultCount = mysqli_stmt_get_result($stmt);
    if ($resultCount) {
        $row = mysqli_fetch_assoc($resultCount);
        $numTeamsSolved = $row['num_teams'];

        // Calculate the number of times to deduct points (every group of 5 teams)
        $numDeductions = floor($numTeamsSolved / 5);

        // Deduct points for each group of 5 teams
        for ($i = 0; $i < $numDeductions; $i++) {
            $pointsToAdd -= 15;
        }
    }

    // Escape user inputs to prevent SQL injection
    $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
    $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
    $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
    $challengeId = mysqli_real_escape_string($conn, $_POST['challenge_id']);

    //handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag'])  && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 32) {
    
    $queryCount = "SELECT COUNT(DISTINCT team_name) AS num_teams FROM scoreboard WHERE Challenges_Solved > 0";
$stmt = mysqli_prepare($conn, $queryCount);
mysqli_stmt_execute($stmt);
$resultCount = mysqli_stmt_get_result($stmt);
    if ($resultCount) {
        $row = mysqli_fetch_assoc($resultCount);
        $numTeamsSolved = $row['num_teams'];

        // Calculate the number of times to deduct points (every group of 5 teams)
        $numDeductions = floor($numTeamsSolved / 5);

        // Deduct points for each group of 5 teams
        for ($i = 0; $i < $numDeductions; $i++) {
            $pointsToAdd -= 15;
        }
    }

    // Escape user inputs to prevent SQL injection
    $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
    $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
    $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
    $challengeId = mysqli_real_escape_string($conn, $_POST['challenge_id']);

    //handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag'])  && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 19) {
    
    $queryCount = "SELECT COUNT(DISTINCT team_name) AS num_teams FROM scoreboard WHERE Challenges_Solved > 0";
$stmt = mysqli_prepare($conn, $queryCount);
mysqli_stmt_execute($stmt);
$resultCount = mysqli_stmt_get_result($stmt);
    if ($resultCount) {
        $row = mysqli_fetch_assoc($resultCount);
        $numTeamsSolved = $row['num_teams'];

        // Calculate the number of times to deduct points (every group of 5 teams)
        $numDeductions = floor($numTeamsSolved / 5);

        // Deduct points for each group of 5 teams
        for ($i = 0; $i < $numDeductions; $i++) {
            $pointsToAdd -= 5;
        }
    }

    // Escape user inputs to prevent SQL injection
    $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
    $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
    $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
    $challengeId = mysqli_real_escape_string($conn, $_POST['challenge_id']);

    //handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag'])  && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 20) {
    
    $queryCount = "SELECT COUNT(DISTINCT team_name) AS num_teams FROM scoreboard WHERE Challenges_Solved > 0";
$stmt = mysqli_prepare($conn, $queryCount);
mysqli_stmt_execute($stmt);
$resultCount = mysqli_stmt_get_result($stmt);
    if ($resultCount) {
        $row = mysqli_fetch_assoc($resultCount);
        $numTeamsSolved = $row['num_teams'];

        // Calculate the number of times to deduct points (every group of 5 teams)
        $numDeductions = floor($numTeamsSolved / 5);

        // Deduct points for each group of 5 teams
        for ($i = 0; $i < $numDeductions; $i++) {
            $pointsToAdd -= 10;
        }
    }

    // Escape user inputs to prevent SQL injection
    $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
    $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
    $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
    $challengeId = mysqli_real_escape_string($conn, $_POST['challenge_id']);

    //handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag'])  && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 21) {
    
    $queryCount = "SELECT COUNT(DISTINCT team_name) AS num_teams FROM scoreboard WHERE Challenges_Solved > 0";
$stmt = mysqli_prepare($conn, $queryCount);
mysqli_stmt_execute($stmt);
$resultCount = mysqli_stmt_get_result($stmt);
    if ($resultCount) {
        $row = mysqli_fetch_assoc($resultCount);
        $numTeamsSolved = $row['num_teams'];

        // Calculate the number of times to deduct points (every group of 5 teams)
        $numDeductions = floor($numTeamsSolved / 5);

        // Deduct points for each group of 5 teams
        for ($i = 0; $i < $numDeductions; $i++) {
            $pointsToAdd -= 10;
        }
    }

    // Escape user inputs to prevent SQL injection
    $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
    $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
    $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
    $challengeId = mysqli_real_escape_string($conn, $_POST['challenge_id']);

    //handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag'])  && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 22) {
    
    $queryCount = "SELECT COUNT(DISTINCT team_name) AS num_teams FROM scoreboard WHERE Challenges_Solved > 0";
$stmt = mysqli_prepare($conn, $queryCount);
mysqli_stmt_execute($stmt);
$resultCount = mysqli_stmt_get_result($stmt);
    if ($resultCount) {
        $row = mysqli_fetch_assoc($resultCount);
        $numTeamsSolved = $row['num_teams'];

        // Calculate the number of times to deduct points (every group of 5 teams)
        $numDeductions = floor($numTeamsSolved / 5);

        // Deduct points for each group of 5 teams
        for ($i = 0; $i < $numDeductions; $i++) {
            $pointsToAdd -= 15;
        }
    }

    // Escape user inputs to prevent SQL injection
    $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
    $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
    $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
    $challengeId = mysqli_real_escape_string($conn, $_POST['challenge_id']);

    //handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag'])  && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 23) {
    
    $queryCount = "SELECT COUNT(DISTINCT team_name) AS num_teams FROM scoreboard WHERE Challenges_Solved > 0";
$stmt = mysqli_prepare($conn, $queryCount);
mysqli_stmt_execute($stmt);
$resultCount = mysqli_stmt_get_result($stmt);
    if ($resultCount) {
        $row = mysqli_fetch_assoc($resultCount);
        $numTeamsSolved = $row['num_teams'];

        // Calculate the number of times to deduct points (every group of 5 teams)
        $numDeductions = floor($numTeamsSolved / 5);

        // Deduct points for each group of 5 teams
        for ($i = 0; $i < $numDeductions; $i++) {
            $pointsToAdd -= 5;
        }
    }

    // Escape user inputs to prevent SQL injection
    $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
    $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
    $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
    $challengeId = mysqli_real_escape_string($conn, $_POST['challenge_id']);

    //handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag'])  && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 24) {
    
    $queryCount = "SELECT COUNT(DISTINCT team_name) AS num_teams FROM scoreboard WHERE Challenges_Solved > 0";
$stmt = mysqli_prepare($conn, $queryCount);
mysqli_stmt_execute($stmt);
$resultCount = mysqli_stmt_get_result($stmt);
    if ($resultCount) {
        $row = mysqli_fetch_assoc($resultCount);
        $numTeamsSolved = $row['num_teams'];

        // Calculate the number of times to deduct points (every group of 5 teams)
        $numDeductions = floor($numTeamsSolved / 5);

        // Deduct points for each group of 5 teams
        for ($i = 0; $i < $numDeductions; $i++) {
            $pointsToAdd -= 10;
        }
    }

    // Escape user inputs to prevent SQL injection
    $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
    $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
    $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
    $challengeId = mysqli_real_escape_string($conn, $_POST['challenge_id']);

    //handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag'])  && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 25) {
    
    $queryCount = "SELECT COUNT(DISTINCT team_name) AS num_teams FROM scoreboard WHERE Challenges_Solved > 0";
$stmt = mysqli_prepare($conn, $queryCount);
mysqli_stmt_execute($stmt);
$resultCount = mysqli_stmt_get_result($stmt);
    if ($resultCount) {
        $row = mysqli_fetch_assoc($resultCount);
        $numTeamsSolved = $row['num_teams'];

        // Calculate the number of times to deduct points (every group of 5 teams)
        $numDeductions = floor($numTeamsSolved / 5);

        // Deduct points for each group of 5 teams
        for ($i = 0; $i < $numDeductions; $i++) {
            $pointsToAdd -= 5;
        }
    }

    // Escape user inputs to prevent SQL injection
    $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
    $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
    $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
    $challengeId = mysqli_real_escape_string($conn, $_POST['challenge_id']);

    //handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag'])  && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 26) {
    
    $queryCount = "SELECT COUNT(DISTINCT team_name) AS num_teams FROM scoreboard WHERE Challenges_Solved > 0";
$stmt = mysqli_prepare($conn, $queryCount);
mysqli_stmt_execute($stmt);
$resultCount = mysqli_stmt_get_result($stmt);
    if ($resultCount) {
        $row = mysqli_fetch_assoc($resultCount);
        $numTeamsSolved = $row['num_teams'];

        // Calculate the number of times to deduct points (every group of 5 teams)
        $numDeductions = floor($numTeamsSolved / 5);

        // Deduct points for each group of 5 teams
        for ($i = 0; $i < $numDeductions; $i++) {
            $pointsToAdd -= 5;
        }
    }

    // Escape user inputs to prevent SQL injection
    $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
    $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
    $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
    $challengeId = mysqli_real_escape_string($conn, $_POST['challenge_id']);

    //handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag'])  && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 27) {
    
    $queryCount = "SELECT COUNT(DISTINCT team_name) AS num_teams FROM scoreboard WHERE Challenges_Solved > 0";
$stmt = mysqli_prepare($conn, $queryCount);
mysqli_stmt_execute($stmt);
$resultCount = mysqli_stmt_get_result($stmt);
    if ($resultCount) {
        $row = mysqli_fetch_assoc($resultCount);
        $numTeamsSolved = $row['num_teams'];

        // Calculate the number of times to deduct points (every group of 5 teams)
        $numDeductions = floor($numTeamsSolved / 5);

        // Deduct points for each group of 5 teams
        for ($i = 0; $i < $numDeductions; $i++) {
            $pointsToAdd -= 15;
        }
    }

    // Escape user inputs to prevent SQL injection
    $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
    $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
    $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
    $challengeId = mysqli_real_escape_string($conn, $_POST['challenge_id']);

    //handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag'])  && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 28) {
    
    $queryCount = "SELECT COUNT(DISTINCT team_name) AS num_teams FROM scoreboard WHERE Challenges_Solved > 0";
$stmt = mysqli_prepare($conn, $queryCount);
mysqli_stmt_execute($stmt);
$resultCount = mysqli_stmt_get_result($stmt);
    if ($resultCount) {
        $row = mysqli_fetch_assoc($resultCount);
        $numTeamsSolved = $row['num_teams'];

        // Calculate the number of times to deduct points (every group of 5 teams)
        $numDeductions = floor($numTeamsSolved / 5);

        // Deduct points for each group of 5 teams
        for ($i = 0; $i < $numDeductions; $i++) {
            $pointsToAdd -= 5;
        }
    }

    // Escape user inputs to prevent SQL injection
    $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
    $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
    $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
    $challengeId = mysqli_real_escape_string($conn, $_POST['challenge_id']);

    //handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag'])  && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 29) {
    
    $queryCount = "SELECT COUNT(DISTINCT team_name) AS num_teams FROM scoreboard WHERE Challenges_Solved > 0";
$stmt = mysqli_prepare($conn, $queryCount);
mysqli_stmt_execute($stmt);
$resultCount = mysqli_stmt_get_result($stmt);
    if ($resultCount) {
        $row = mysqli_fetch_assoc($resultCount);
        $numTeamsSolved = $row['num_teams'];

        // Calculate the number of times to deduct points (every group of 5 teams)
        $numDeductions = floor($numTeamsSolved / 5);

        // Deduct points for each group of 5 teams
        for ($i = 0; $i < $numDeductions; $i++) {
            $pointsToAdd -= 5;
        }
    }

    // Escape user inputs to prevent SQL injection
    $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
    $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
    $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
    $challengeId = mysqli_real_escape_string($conn, $_POST['challenge_id']);

    //handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag'])  && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 30) {
    
    $queryCount = "SELECT COUNT(DISTINCT team_name) AS num_teams FROM scoreboard WHERE Challenges_Solved > 0";
$stmt = mysqli_prepare($conn, $queryCount);
mysqli_stmt_execute($stmt);
$resultCount = mysqli_stmt_get_result($stmt);
    if ($resultCount) {
        $row = mysqli_fetch_assoc($resultCount);
        $numTeamsSolved = $row['num_teams'];

        // Calculate the number of times to deduct points (every group of 5 teams)
        $numDeductions = floor($numTeamsSolved / 5);

        // Deduct points for each group of 5 teams
        for ($i = 0; $i < $numDeductions; $i++) {
            $pointsToAdd -= 5;
        }
    }

    // Escape user inputs to prevent SQL injection
    $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
    $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
    $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
    $challengeId = mysqli_real_escape_string($conn, $_POST['challenge_id']);

    //handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag'])  && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 31) {
    
    $queryCount = "SELECT COUNT(DISTINCT team_name) AS num_teams FROM scoreboard WHERE Challenges_Solved > 0";
$stmt = mysqli_prepare($conn, $queryCount);
mysqli_stmt_execute($stmt);
$resultCount = mysqli_stmt_get_result($stmt);
    if ($resultCount) {
        $row = mysqli_fetch_assoc($resultCount);
        $numTeamsSolved = $row['num_teams'];

        // Calculate the number of times to deduct points (every group of 5 teams)
        $numDeductions = floor($numTeamsSolved / 5);

        // Deduct points for each group of 5 teams
        for ($i = 0; $i < $numDeductions; $i++) {
            $pointsToAdd -= 15;
        }
    }

    // Escape user inputs to prevent SQL injection
    $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
    $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
    $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
    $challengeId = mysqli_real_escape_string($conn, $_POST['challenge_id']);

    //handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag'])  && isset($_POST['challenge_id']) && $_POST['challenge_id'] == 33) {
    
    $queryCount = "SELECT COUNT(DISTINCT team_name) AS num_teams FROM scoreboard WHERE Challenges_Solved > 0";
$stmt = mysqli_prepare($conn, $queryCount);
mysqli_stmt_execute($stmt);
$resultCount = mysqli_stmt_get_result($stmt);

    // Escape user inputs to prevent SQL injection
    $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
    $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
    $flag = mysqli_real_escape_string($conn, $_POST['flag']); // Assuming the flag is submitted via POST
    $challengeId = mysqli_real_escape_string($conn, $_POST['challenge_id']);

    //handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $challengeId); // Use the correct challenge ID for each challenge
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <link rel="stylesheet" href="css/main.css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
    <style>
        
.h4,
h4 {
    margin-top: 1.5rem;
    font-size: 1.5rem;
}
        .category_Forensics{
    border-top: 4px solid rgb(150, 28, 134);
}
        .card-header.solved {
    background-color: green; /* Green color */
    color: white; /* White text color */
}
        .demo {
            font-size: 30px; /* Adjust the font size as needed */
            padding-left: 100px; /* Add some padding to the right for spacing */
            right:   50px; /* Position the clock in the top right corner of the window */
            color:red;
            font-family: 'Hack;apple-system;BlinkMacSystemFont;Segoe UI;Roboto;Helvetica Neue;Arial;sans-serif;Apple Color Emoji;Segoe UI Emoji;Segoe UI Symbol';
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
            padding-bottom: 2%;
            font-weight: bold;
            /* border-color: black; */
        }
        .dropdown{
            padding-top: 8px;
        }
        .dropdown-menu{
            min-width: 0px;
            background-color: transparent;
        }
        .show>.btn-secondary.dropdown-toggle{
            font-weight:bold;
            background-color: #000;
            border-color: black;
            color: white;
        }
        .btn-secondary:hover{
            background-color: #000;
            border-color: #000;
        }
        #more {display: none;}
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #000;
            padding: 20px;
            border: 1px solid #ccc;
            width: 80%;
            max-width: 600px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 999;
        }
        .closeBtn {
        position: absolute;
        top: 0;
        right: 0%;
        font-size: 20px;
        font-weight: bold;
        cursor: pointer;
    }
    </style>

</head>

<body style="
background-image: url('images/bg.jpg');
background-repeat: no-repeat;
background-position: center;
background-size: cover;
background-attachment: fixed;
">    
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
                        <a href="about" class="p-3 text-decoration-none text-light bold">
                            <i class="fas fa-info-circle mr-2"></i>
                            About
                        </a>
                        <a href="Scoreboard" class="p-3 text-decoration-none text-light bold">
                            <i class="fas fa-trophy mr-2"></i>
                            Scoreboard
                        </a>
                        <a href="quests"class="p-3 text-decoration-none text-white bold">
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
    <a href="#" onclick="return confirmLogout()" class="dropdown-item" style="color: white;font-weight: bold;"><i class="fas fa-sign-out-alt mr-2"></i> Log Out</a>
  </div>
</div>
    
                    </div>
                </div>
            </nav>

        </div>
    </div>
    <p id="demo" class="demo"></p>

    <div class="jumbotron bg-transparent mb-0 pt-3 radius-0">
        <div class="container">
            <div class="row">
                <div class="col-xl-12  text-center">
                    <h1 class="display-1 bold color_white content__title">QUESTS<span class="vim-caret">&nbsp;</span></h1>
                    <p class="text-grey text-spacey hackerFont lead mb-5">
                        Its time to show the world what you can do!
                    </p>
                </div>
            </div>
          
<?php include 'challenge_template.php'; ?>
         
            <div class="row hackerFont justify-content-center mt-5">
                <div class="col-md-12">
                    <br><br>Challenge Types:
                    <span class="p-1" style="background-color:#ef121b94">Web</span>
                    <span class="p-1" style="background-color:#17b06b94">Reversing</span>
                    <span class="p-1" style="background-color:#f9751594">Steganography</span>
                    <span class="p-1" style="background-color:#36a2eb94">Network</span>
                    <span class="p-1" style="background-color:#9966FF94">Cryptography</span>
                    <span class="p-1" style="background-color:#ffce5694">Misc</span>
                    <span class="p-1" style="background-color:#808080">OSINT</span>
                    <span class="p-1" style="background-color:rgb(150, 28, 134)">Forensics</span>
                </div>
            </div>
        </div>

        <script>
function submitChallenge(challengeId) {
    // Get the flag value entered by the user
    var flagValue = document.querySelector('#' + challengeId).value;
    
    // Set the value of the hidden input field in the form
    document.querySelector('#' + challengeId + '_flag').value = flagValue;
    
    // Submit the form
    document.getElementById('challengeForm').submit();
}
</script>
        
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
       <html>
<head>
  <title>Countdown Timer</title>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
  <div id="demo"></div>

  <script>
  // Set the countdown time to August 1, 2024, 17:45:00 in India timezone
  var countDownDate = new Date('Sept 30, 2024 17:45:00 GMT+0530');

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
      window.location.href = 'scoreboard';
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
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>
    function message()
    {
        alert('Message sent!');
    }
</body>

</html>