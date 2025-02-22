<?php
session_start();
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');
?>

<div class="content-wrapper">

<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit - Registered Users</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

<div class="container">
        <div class="row">
            <div class="col-md-12">
               <div class="card">
              <div class="card-header">
                <h3 class="card-title">Edit - Registered Users</h3>
                <a href="registered.php" class="btn btn-danger float-right">BACK</a>
              </div>
              <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                    <form action="code.php" method="POST">
                        <div class="modal-body">
                            <?php
                            if(isset($_GET['user_id']))
                            {
                            $user_id = $_GET['user_id'];
                            $query = "SELECT * FROM users WHERE id='$user_id' LIMIT 1";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                foreach($query_run as $row)
                                {
                                ?>

                            <input type="hidden" name="user_id" value="<?php echo $row['id'] ?>">
                            <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" value="<?php echo $row['name'] ?>" class="form-control" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="">Phone Number</label>
                            <input type="number" name="phone" value="<?php echo $row['phone'] ?>" class="form-control" placeholder="Phone Number" pattern="[0-9]*">
                        </div>
                        <div class="form-group">
                            <label for="">Email Id</label>
                            <input type="email" name="email" value="<?php echo $row['email'] ?>" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="text" name="password" value="<?php echo $row['password'] ?>" class="form-control" placeholder="password">
                        </div>
                                    <?php
                                }
                            }
                            else
                            {
                                echo "No Record Found";
                            }
                            }
                            ?>
                       
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="updateUser" class="btn btn-info">Update</button>
                    </div>
                    </form>
                </div>
              </div>
            </div>
        </div>
    </div>
    </div>
</div>
</div>

<?php
include('includes/script.php');
include('includes/footer.php');
?>