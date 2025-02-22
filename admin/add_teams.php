<?php
// Start the session
session_start();
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');


// Check if the user is not logged in, redirect them to the login page
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: admin_login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Team</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style>
        /* Your existing CSS styles */
    </style>
</head>
<body>
    <style>
        .container{
            max-width: 850px;
        }
    </style>
<div class="container">
    <h1>Add Team</h1>
    <form method="POST">
        <div class="form-group">
            <label for="members_num">No of Members:</label>
            <input type="number" class="form-control" id="members_num" name="members_num" value="2" readonly>
        </div>

        <div class="form-group">
            <label for="team_name">Team Name:</label>
            <input type="text" class="form-control" id="team_name" name="team_name" required>
        </div>

        <div class="form-group">
            <label>Select Members (exactly 2):</label>
            <div class="input-group">
                <input type="text" class="form-control" id="selected-members" readonly>
                <input type="hidden" id="selected-members-value" name="select_members[]">
                <input type="text" class="form-control" id="search-input" placeholder="Search member name">
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
            <button type="submit" class="btn btn-primary">Add Team</button>
        </div>
    </form>

    <?php
    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['members_num'], $_POST['team_name'], $_POST['select_members'])) {
        $members_num = $_POST['members_num'];
        $team_name = $_POST['team_name'];
        $members = is_array($_POST['select_members']) ? $_POST['select_members'] : [];

        // Validate number of selected members against specified limit
        $members_string = $members[0];
        $members_array = explode(',', $members_string);

        if (count($members_array) !== 2) {
            echo $members[0];
            // echo $members_array[1];

            echo '<div class="alert alert-danger" role="alert">Please select exactly 2 members.</div>';
        } else {
            // Establish connection to database my_database (where teams are stored)
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Check if any of the selected members are already in another team
            $existing_members_teams = [];
            foreach ($members_array as $member) {
                $check_query = "SELECT team_name FROM teams WHERE FIND_IN_SET(?, REPLACE(name_of_members, ' ', ''))";
                $check_stmt = $conn->prepare($check_query);
                $check_stmt->bind_param("s", $member);
                $check_stmt->execute();
                $check_result = $check_stmt->get_result();

                if ($check_result->num_rows > 0) {
                    while ($row = $check_result->fetch_assoc()) {
                        $existing_members_teams[] = $row['team_name'];
                    }
                }

                $check_stmt->close();
            }

            if (!empty($existing_members_teams)) {
                $existing_teams = array_unique($existing_members_teams);
                echo '<div class="alert alert-danger" role="alert">Members (' . implode(', ', $members_array) . ') are already part of team(s): ' . implode(', ', $existing_teams) . '.</div>';
            } else {
                // Insert new team if no members are already in another team
                $members_str = implode(", ", $members_array);
                $query = "INSERT INTO teams (team_name, no_of_members, name_of_members) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("sis", $team_name, $members_num, $members_str);

                // Attempt to execute the statement
                try {
                    $stmt->execute();
                    echo '<div class="alert alert-success" role="alert">Team added successfully!</div>';
                    echo '<script>
                        setTimeout(function() {
                            window.location.href = "manage_teams.php";
                        }, 500);
                      </script>';
                } catch (mysqli_sql_exception $e) {
                    if ($e->getCode() == 1062) { // Error code for duplicate entry
                        echo '<div class="alert alert-danger" role="alert">Error: Duplicate entry. This combination of members already exists in another team.</div>';
                    } else {
                        echo '<div class="alert alert-danger" role="alert">Error: ' . $e->getMessage() . '</div>';
                    }
                }

                $stmt->close();
            }

            $conn->close();
        }
    }
    ?>
</div>

<script>
    $(document).ready(function() {
        // Initially hide all options
        $("#member-select option").hide();

        // Filter member selection based on search input
        $('#search-input').on('input', function() {
            var searchTerm = $(this).val().toLowerCase().trim();
            if (searchTerm.length < 3) {
                $("#member-select option").hide();
            } else {
                $("#member-select option").each(function() {
                    var optionText = $(this).text().toLowerCase().trim();
                    if (optionText.indexOf(searchTerm) > -1) {
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
                selectedMembers.push($(this).val().trim());
            });
            $("#selected-members").val(selectedMembers.join(', '));
            $("#selected-members-value").val(selectedMembers.join(', '));
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>