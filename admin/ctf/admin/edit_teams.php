<?php
session_start();

// Check if the user is not logged in, redirect them to the login page
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: admin_login.php');
    exit();
}

// Ensure a team ID is provided in the URL parameter
if (!isset($_GET['team_id'])) {
    header('Location: manage_teams.php'); // Redirect if team_id is not provided
    exit();
}

// Fetch team details from the database based on team_id
$team_id = $_GET['team_id'];

// Establish connection to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_database";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch team details
$query = "SELECT team_name, name_of_members FROM teams WHERE team_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $team_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $team = $result->fetch_assoc();
    $team_name = $team['team_name'];
    $name_of_members = explode(", ", $team['name_of_members']);
} else {
    // Redirect if team_id does not exist
    header('Location: manage_teams.php');
    exit();
}

$stmt->close();

// Check if the team already has 2 members
$disable_add_member = count($name_of_members) >= 2;

// Fetch available members who are not already in the current team
$sql_available_members = "SELECT name FROM members WHERE name NOT IN (
                            SELECT name_of_members FROM teams WHERE team_id = ?
                          )";
$stmt_available_members = $conn->prepare($sql_available_members);
$stmt_available_members->bind_param("i", $team_id);
$stmt_available_members->execute();
$result_available_members = $stmt_available_members->get_result();

$available_members = [];
if ($result_available_members->num_rows > 0) {
    while ($row = $result_available_members->fetch_assoc()) {
        $available_members[] = $row["name"];
    }
}

$stmt_available_members->close();
$conn->close();

// Handle form submission for adding a new member
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_team'])) {
    $team_id = $_POST['team_id'];
    $team_name = $_POST['team_name'];
    $new_member = $_POST['add_existing_member'];

    // Check if a member is selected to add
    if (!empty($team_name)) {
        // Update team name
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $query_update_team = "UPDATE teams SET team_name = ? WHERE team_id = ?";
        $stmt_update_team = $conn->prepare($query_update_team);
        $stmt_update_team->bind_param("si", $team_name, $team_id);

        try {
            $stmt_update_team->execute();
            echo '<div class="alert alert-success" role="alert">Team name updated successfully!</div>';
        } catch (mysqli_sql_exception $e) {
            echo '<div class="alert alert-danger" role="alert">Error: ' . $e->getMessage() . '</div>';
        }

        $stmt_update_team->close();
        $conn->close();
    }

    if (!empty($new_member)) {
        // Add the new member to the team
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $query_add_member = "UPDATE teams SET name_of_members = CONCAT_WS(', ', COALESCE(name_of_members, ''), ?) WHERE team_id = ?";
        $stmt_add_member = $conn->prepare($query_add_member);
        $stmt_add_member->bind_param("si", $new_member, $team_id);

        try {
            $stmt_add_member->execute();
            echo '<div class="alert alert-success" role="alert">Member added successfully!</div>';
            $_SESSION['just_added'] = true;
        } catch (mysqli_sql_exception $e) {
            echo '<div class="alert alert-danger" role="alert">Error: ' . $e->getMessage() . '</div>';
        }

        $stmt_add_member->close();
        $conn->close();
    } else {
        echo '<div class="alert alert-warning" role="alert">Please select a member to add.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Team</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <h1>Edit Team</h1>
    <form method="POST">
        <input type="hidden" name="team_id" value="<?php echo $team_id; ?>">
        <div class="form-group">
            <label for="team_name">Team Name:</label>
            <input type="text" class="form-control" id="team_name" name="team_name" value="<?php echo $team_name; ?>" required>
        </div>

        <div class="form-group">
            <label>Current Members:</label>
            <ul id="current-members-list" class="list-group">
                <?php foreach ($name_of_members as $member) : ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?php echo $member; ?>
                        <?php if (count($name_of_members) > 1) : ?>
                            <a href="delete_member.php?team_id=<?php echo $team_id; ?>&member=<?php echo urlencode($member); ?>" class="btn btn-danger btn-sm ml-2">Delete</a>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="form-group">
            <label>Select Members (exactly 2):</label>
           
            <div class="input-group">
                <input type="text" class="form-control" id="selected-members" readonly>
                <input type="hidden" id="selected-members-value" name="add_existing_member">
                <input type="text" class="form-control" id="search-input" placeholder="Search member name" <?php if ($disable_add_member) echo 'disabled'; ?>>
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                </div>
            </div>
            <select class="form-control" id="member-select" multiple style="height: 100px">
                <?php
                // Establish connection to database my_database (where members are stored)
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "my_database";

                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Query to fetch available member names who are not in any team
                $sql = "SELECT name FROM members WHERE name NOT IN (SELECT TRIM(BOTH ' ' FROM SUBSTRING_INDEX(SUBSTRING_INDEX(name_of_members, ',', numbers.n), ',', -1)) FROM (SELECT 1 n UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9 UNION ALL SELECT 10) numbers INNER JOIN teams ON CHAR_LENGTH(name_of_members) - CHAR_LENGTH(REPLACE(name_of_members, ',', '')) >= numbers.n - 1)";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $memberName = $row["name"];
                        echo '<option value="' . htmlspecialchars($memberName) . '">' . htmlspecialchars($memberName) . '</option>';
                    }
                } else {
                    echo '<option disabled>No members available</option>';
                }
                $conn->close();
                ?>
            </select>
        </div>

        <div class="form-group ml-2">
            <button type="submit" class="btn btn-primary" name="update_team" <?php if ($disable_add_member); ?>>Update Team</button>
        </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        // Initially hide all options
        $("#member-select option").hide();

        // Filter member selection based on search input
        $('#search-input').on('input', function() {
            var searchTerm = $(this).val().toLowerCase();
            if (searchTerm.length < 3) {
                $("#member-select option").hide(); // Hide all options if less than 3 characters
            } else {
                $("#member-select option").each(function() {
                    var optionText = $(this).text().toLowerCase();
                    // Check if the option text contains the search term and is not already a current member
                    if (optionText.indexOf(searchTerm) > -1 && !isAlreadyMember(optionText)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }
        });

        // Update selected members list on change
        $('#member-select').on('change', function() {
            var selectedMembers = [];
            $("#member-select option:selected").each(function() {
                selectedMembers.push($(this).val());
            });
            $("#selected-members").val(selectedMembers.join(', '));
            $("#selected-members-value").val(selectedMembers.join(','));

            // Disable member selection if team already has 2 members
            if (selectedMembers.length >= 2) {
                $("#member-select").prop('disabled', true);
                $("#search-input").prop('disabled', true);
            } else {
                $("#member-select").prop('disabled', false);
                $("#search-input").prop('disabled', false);
            }
        });

        // Check initially on page load if team already has 2 members
        if (<?php echo count($name_of_members); ?> >= 2) {
            $("#member-select").prop('disabled', true);
            $("#search-input").prop('disabled', true);
        }

        // Function to check if a member is already in the current team
        function isAlreadyMember(memberName) {
            var currentMembers = <?php echo json_encode($name_of_members); ?>;
            return currentMembers.indexOf(memberName) !== -1;
        }
    });
</script>

</body>
</html>