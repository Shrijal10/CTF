<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include your database connection and functions file
include 'login.php'; // Replace with your actual database connection script

// Fetch user profile
$userprofile = $_SESSION['user_name'];

// Assuming your challenges are stored in a database table named 'challenges'
$query = "SELECT * FROM challenges";
$result = mysqli_query($conn, $query);

// Check for errors
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Function to check if a challenge has been solved by the current team
function isChallengeSolved($conn, $teamName, $challengeId) {
    $query = "SELECT * FROM solved_challenges WHERE team_name = ? AND challenge_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $teamName, $challengeId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quest Page</title>
</head>
<body>

<div class="container">
    <div class="row">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="col-md-4 mb-3">
                <div class="card category_<?php echo strtolower($row['category']); ?>">
                    <div class="card-header <?php echo getchallengeColor($conn, $row['challenge_id'], $userprofile);?>" id="challenge_id<?php echo $row['challenge_id']; ?>" data-challenge-id="<?php echo $row['challenge_id']; ?>" data-target="#problem_id_<?php echo $row['challenge_id']; ?>" data-toggle="collapse" aria-expanded="false" aria-controls="problem_id_<?php echo $row['challenge_id']; ?>">
                        <?php echo $row['challenge_name']; ?> <br> 
                        <span class="badge align-self-end"><?php echo $row['points']; ?> points</span>
                    </div>
                    <div id="problem_id_<?php echo $row['challenge_id']; ?>" class="collapse card-body">
                        <blockquote class="card-blockquote">
                            <div style="display: flex;">
                                <h6 class="solvers challenge_<?php echo $row['challenge_id']; ?>">Solvers: 
                                    <span class="solver_num"><?php echo solvers($conn, $row['challenge_id'], $flag, $teamName); ?></span>
                                    <br>
                                    <span class="color_blue challenge_<?php echo $row['challenge_id']; ?>">Difficulty: <?php echo getDifficulty($conn, $row['challenge_id']); ?></span>
                                </h6>
                            </div>
                            <p>
                                <?php echo $row['description']; ?>
                                <span id="dots">...</span>
                                <span id="more<?php echo $row['challenge_id']; ?>" style="display: none;">
                                    <?php echo $row['additional_description']; ?>
                                </span>
                                <button onclick="openPopup<?php echo $row['challenge_id']; ?>()" id="myBtn<?php echo $row['challenge_id']; ?>" style="background-color: transparent; color: white; font-size:12px;border:none">Read more</button>
                            </p>
                            <div id="popup<?php echo $row['challenge_id']; ?>" class="popup">
                                <span id="popupContent<?php echo $row['challenge_id']; ?>"></span>
                                <button onclick="closePopup<?php echo $row['challenge_id']; ?>()" class="closeBtn" style="background-color: transparent; color: #72d0eb;">&times;</button>
                            </div>
                            <a target="_blank" href="<?php echo htmlspecialchars($row['link']); ?>" class="btn btn-outline-secondary"><span class="fa fa-link mr-2"></span><?php $row['link']; ?></a>
                            <form action="" method="POST" autocomplete="off">
                                <div class="input-group mt-3">
                                    <input type="text" id="flag" class="form-control" placeholder="Enter Flag" aria-label="Enter Flag" aria-describedby="basic-addon2" name="flag" oninput="this.value = this.value.replace(/^\s+|\s+$/g, '').replace(/\s+/g, ' ')" <?php echo isChallengeSolved($conn, $userprofile, $row['challenge_id']) ? 'disabled' : ''; ?>>
                                    <div class="input-group-append">
                                        <input type="hidden" name="challenge_id" value="<?php echo $row['challenge_id']; ?>">
                                        <input type="submit" class="btn btn-outline-secondary" value="Go!" name="login" id="submit" <?php echo isChallengeSolved($conn, $userprofile, $row['challenge_id']) ? 'disabled' : ''; ?>>
                                    </div>
                                </div>
                                <span style="color: white; margin-top: 6px;">Author: <?php echo $row['author']; ?></span><br>
                                <?php
                                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flag']) && isset($_POST['challenge_id']) && $_POST['challenge_id'] == $row['challenge_id']) {
                                    $pointsToAdd = $row['points']; // Initial points
                                    
                                    // Calculate points deduction
                                    $challengeId = $row['challenge_id'];
                                    $queryCount = "SELECT num_teams_solved FROM challenge_solvers WHERE challenge_id = $challengeId";
                                    $resultCount = mysqli_query($conn, $queryCount);
                                    if ($resultCount) {
                                        $numTeamsSolved = mysqli_fetch_assoc($resultCount)['num_teams_solved'];
                                        $numDeductions = floor($numTeamsSolved / 5);
                                        if ($pointsToAdd == 100) {
                                            $numDeductions *= 5;
                                        } elseif ($pointsToAdd == 150) {
                                            $numDeductions *= 10;
                                        } elseif ($pointsToAdd == 200) {
                                            $numDeductions *= 15;
                                        }
                                        $pointsToAdd -= $numDeductions;
                                    }
                                    
                                    // Escape user inputs to prevent SQL injection
                                    $teamName = mysqli_real_escape_string($conn, $_SESSION['user_name']);
                                    $pointsToAdd = mysqli_real_escape_string($conn, $pointsToAdd);
                                    $flag = mysqli_real_escape_string($conn, $_POST['flag']);
                                    
                                    handleFlagSubmission($conn, $teamName, $pointsToAdd, $flag, $row['challenge_id']);
                                }
                                ?>
                            </form>
                        </blockquote>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<!-- JavaScript to handle popup functionality -->
<script>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
    function openPopup<?php echo $row['challenge_id']; ?>() {
        var moreText = document.getElementById("more<?php echo $row['challenge_id']; ?>");
        var popup = document.getElementById("popup<?php echo $row['challenge_id']; ?>");
        var popupContent = document.getElementById("popupContent<?php echo $row['challenge_id']; ?>");

        popupContent.innerHTML = moreText.innerHTML;
        popup.style.display = "block";
    }

    function closePopup<?php echo $row['challenge_id']; ?>() {
        var popup = document.getElementById("popup<?php echo $row['challenge_id']; ?>");
        popup.style.display = "none";
    }
    <?php endwhile; ?>
</script>

</body>
</html>

<?php
// Close database connection
mysqli_close($conn);
?>


