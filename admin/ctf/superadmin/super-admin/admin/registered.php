<?php
session_start();
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<!-- Add User Modal -->
<div class="modal fade" id="AddUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add User</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST">
        <div class="modal-body">
          <div class="form-group">
              <label for="">Name</label>
              <input type="text" name="name" class="form-control" placeholder="Name">
        </div>
        <div class="form-group">
              <label for="">Phone Number</label>
              <input type="text" name="phone" class="form-control" placeholder="Phone Number">
        </div>
        <div class="form-group">
              <label for="">Email Id</label>
              <input type="email" name="email" class="form-control" placeholder="Email">
        </div>
        <div class="form-group">
              <label for="">Password</label>
              <input type="password" name="password" class="form-control" placeholder="Password">
        </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="addUser" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Upload Excel Modal -->
<div class="modal fade" id="UploadExcelModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Users from Excel</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="upload_excel.php" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label for="excelFile">Choose Excel File</label>
            <input type="file" class="form-control-file" id="excelFile" name="excelFile" accept=".xls,.xlsx">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="uploadExcel" class="btn btn-primary">Upload</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="DeletModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm Deletion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="delete.php" method="POST">
        <div class="modal-body">
          Are you sure you want to delete this user?
          <input type="hidden" name="delete_user_id" class="delete_user_id">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" name="delete_btn" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Rest of the Dashboard content -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Registered Users</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <?php
      if(isset($_SESSION['status']))
      {
        echo "<h4>".$_SESSION['status']."</h4>";
        unset($_SESSION['status']);
      }
      ?>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Registered Users</h3>
    <a href="#" data-toggle="modal" data-target="#AddUserModal" class="btn btn-primary float-right">Add User</a>
    <a href="#" data-toggle="modal" data-target="#UploadExcelModal" class="btn btn-success float-right mr-2">Upload from Excel</a>
    <a href="export.php" class="btn btn-warning float-right mr-2">Export to Excel</a>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Id</th>
          <th>Name</th>
          <th>Phone Number</th>
          <th>Email</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $query = "SELECT * FROM users";
        $query_run = mysqli_query($con, $query);

        if(mysqli_num_rows($query_run) > 0)
        {
          foreach($query_run as $row)
          {
            ?>
            <tr>
              <td><?php echo $row['id']; ?></td>
              <td><?php echo $row['name']; ?></td>
              <td><?php echo $row['phone']; ?></td>
              <td><?php echo $row['email']; ?></td>
              <td>
                <a href="registered-edit.php?user_id=<?= $row['id']; ?>" class="btn btn-info btn-sm">Edit</a>
                <button type="button" value="<?= $row['id']; ?>" class="btn btn-danger btn-sm deletebtn">Delete</button>
              </td>
            </tr>
            <?php
          }
        }
        else
        {
          echo "No Record Found";
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

</div>

<?php include('includes/script.php'); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  var deleteBtns = document.querySelectorAll('.deletebtn');
  
  deleteBtns.forEach(function (btn) {
    btn.addEventListener('click', function () {
      var user_id = this.value;
      document.querySelector('.delete_user_id').value = user_id;
      var myModal = new bootstrap.Modal(document.getElementById('DeletModal'));
      myModal.show();
    });
  });
});

</script>

<?php include('includes/footer.php'); ?>
