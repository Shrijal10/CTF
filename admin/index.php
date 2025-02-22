<?php
session_start(); // Start the session

// Database connection parameters
$servername = 'localhost';
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password
$dbname = 'ctf'; // Replace with your database name

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die('Connection failed: ' . $con->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['selected_names']) && !empty($_POST['selected_names'])) {
        // User selected names
        $selected_names = $con->real_escape_string($_POST['selected_names']); // Sanitize input
        $names_array = explode(',', $selected_names);
        $names_array = array_map('trim', $names_array); // Trim spaces
        $names_list = "'" . implode("','", $names_array) . "'";
        $ctf_query = "SELECT names FROM ctf_names WHERE names IN ($names_list)";
    } elseif (isset($_POST['new_names']) && !empty($_POST['new_names'])) {
        // User entered new names
        $new_names = $con->real_escape_string($_POST['new_names']); // Sanitize input
        $names_array = explode(',', $new_names);
        $names_array = array_map('trim', $names_array); // Trim spaces
        foreach ($names_array as $name) {
            $insert_query = "INSERT IGNORE INTO ctf_names (names) VALUES ('$name')";
            if (!$con->query($insert_query)) {
                $error = $con->error;
                if(strpos($error, 'Duplicate entry') !== false){
                    echo "<script>alert('CTF name is already present');</script>";
                } else {
                    echo "<script>alert('" . $error . "');</script>";
                }
            }
        }
        // Query to show all names including newly added ones
        $ctf_query = "SELECT names FROM ctf_names";
    }
} else {
    // Default query to show all names
    $ctf_query = "SELECT names FROM ctf_names";
}
$ctf_run = $con->query($ctf_query);

// Check if query was successful
if (!$ctf_run) {
    echo "<script>alert('" . $con->error . "');</script>";
    die('Query failed: ' . $con->error);
}

if ($ctf_run->num_rows > 0) {
    // Output data of each row
    while ($row = $ctf_run->fetch_assoc()) {
        // echo htmlspecialchars($row['names']) . '<br>'; // Use htmlspecialchars to prevent XSS attacks
    }
} else {
    echo '<script>alert("CTF_names are not present in the database."); location.href="index1.php";</script>';
}

include('config/dbcon.php');

include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
<?php

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die('Connection failed: ' . $con->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['selected_names']) && !empty($_POST['selected_names'])) {
        // User selected names
        $selected_names = $con->real_escape_string($_POST['selected_names']); // Sanitize input
        $names_array = explode(',', $selected_names);
        $names_list = "'" . implode("','", $names_array) . "'";
        $ctf_query = "SELECT names FROM ctf_names WHERE names IN ($names_list)";
    } elseif (isset($_POST['new_names']) && !empty($_POST['new_names'])) {
        // User entered new names
        $new_names = $con->real_escape_string($_POST['new_names']); // Sanitize input
        $names_array = explode(',', $new_names);
        // Query to show all names including newly added ones
        $ctf_query = "SELECT names FROM ctf_names ORDER BY id DESC LIMIT 1";
    }
} else {
    // Default query to show all names
    $ctf_query = "SELECT names FROM ctf_names";
}

$ctf_run = $con->query($ctf_query);

// Check if query was successful
if (!$ctf_run) {
    die('Query failed: ' . $con->error);
}

// Fetch and display the ctf_names
if ($ctf_run->num_rows > 0) {
    $row = $ctf_run->fetch_assoc();
    echo '<h1>' . htmlspecialchars($row['names']) . '</h1><br>';
} else {
    echo 'No results found.';
}
// Close connection

?>

    </ol>
    </div>
    </div>
    </div>
    </div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
              <?php
                $query = "SELECT COUNT(*) as total FROM abc.challenges";
                $result = mysqli_query($con, $query);
                $row = mysqli_fetch_assoc($result);
                ?>
                <h3><?php echo $row['total']; ?></h3>
                <p>Challenges</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="manage_challenges.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <?php
                $query = "SELECT COUNT(*) as total FROM phpadminpanel.users";
                $result = mysqli_query($con, $query);
                $row = mysqli_fetch_assoc($result);
                ?>
                <h3><?php echo $row['total']; ?></h3>
                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="registered.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
              <?php
                $query = "SELECT COUNT(*) as total FROM abc.login";
                $result = mysqli_query($con, $query);
                $row = mysqli_fetch_assoc($result);
                ?>
                <h3><?php echo $row['total']; ?></h3>
                <p>User</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="manage_users.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

</div>

<?php include('includes/script.php'); ?>
<!-- <?php include('includes/footer.php'); ?> -->