<?php
session_start();
if(!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
  header('Location: admin_login.php');
  exit();
}
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');

?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="m-2">Add Images</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" method="post" action="add_images_action.php" enctype="multipart/form-data">
            <div class="box-body d-flex flex-wrap">
              <div class="form-group col-md-12">
                <div class="d-flex justify-content-center mb-3">
                  <label for="login_image" style="text-align: center;">Background Images</label>
                </div>
                <input type="file" class="form-control mx-auto" id="login_image" name="login_image" placeholder="Enter Image URL OR Path" style="max-width:300px">
                <br><br>
                <div class="form-group col-md-12">
                  <div class="d-flex justify-content-center mb-3">
                    <label for="file_name">Enter a new file name (with extension):</label>
</div>
<input type="text" class="form-control mx-auto" id="file_name" name="file_name" style="max-width:300px">
        </div>
        </div>
        <br><br>
            </div>
            </div>
          
            <!-- /.box-body -->

            <div class="box-footer d-flex justify-content-center">
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS and other scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>