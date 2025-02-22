<?php
// Start the session
session_start();

include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/db_connection.php');

// Check if the user is not logged in, redirect them to the login page
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: admin_login.php');
    exit();
}
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Admin';
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6 text-center">
        <h1 class="m-0">Dashboard</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item active">History</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<div class="content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-7">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">History</h3>
          </div>
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>CTF Name</th>
                  <th>No of Challenges</th>
                  <!-- <th>Challenge Name</th>
                  <th>Category</th> -->
                </tr>
              </thead>
              <tbody>
                <?php
                $query = "SELECT Names, (SELECT COUNT(*) as challenges FROM abc.challenges WHERE Names = ctf_names.Names) as challenges FROM ctf_names";
                $result = $con->query($query);
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['Names'] . '</td>';
                    echo '<td><a href="manage_challenges.php?ctfname='.$row['Names'].'">'.$row['challenges'].'</a></td>';
                    // echo '<td>' . $row['challenge_name'] . '</td>';
                    // echo '<td>' . $row['category'] . '</td>';
                    echo '</tr>';
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

