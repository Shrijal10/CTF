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
              <div class="form-group col-md-6">
                <div class="d-flex justify-content-center mb-3">
                  <label for="login_image" style="text-align: center;">Background Image(login-page)</label>
                </div>
                <input type="file" class="form-control mx-auto" id="login_image" name="login_image" placeholder="Enter Image URL OR Path" style="max-width:300px">
            </div>
              <div class="form-group col-md-6">
                <div class="d-flex justify-content-center mb-3">
                  <label for="logo" style="text-align: center;">(Logo)</label>
                </div>
                <input type="file" class="form-control mx-auto" id="logo" name="logo" placeholder="Enter Image URL OR Path" style="max-width: 300px" >
              </div>
              <div class="form-group col-md-6">
                <div class="d-flex justify-content-center mb-3">
                  <label for="create_password_image" style="text-align: center;">Background Image(Create Password)</label>
                </div>
                <input type="file" class="form-control mx-auto" id="create_password_image" name="create_password_image" placeholder="Enter Image URL OR Path" style="max-width: 300px" >
              </div>
              <div class="form-group col-md-6">
                <div class="d-flex justify-content-center mb-3">
                  <label for="profile_tab_image" style="text-align: center;">Background Image(Profile-Tab)</label>
                </div>
                <input type="file" class="form-control mx-auto" id="profile_tab_image" name="profile_tab_image" placeholder="Enter Image URL OR Path" style="max-width: 300px" >
              </div>
              <div class="form-group col-md-6">
                <div class="d-flex justify-content-center mb-3">
                  <label for="instructions_about_scorecard_image" style="text-align: center;">Background Image(Instructions/About/Scorecard)</label>
                </div>
                <input type="file" class="form-control mx-auto" id="instructions_about_scorecard_image" name="instructions_about_scorecard_image" placeholder="Enter Image URL OR Path" style="max-width: 300px" >
              </div>
              <div class="form-group col-md-6">
                <div class="d-flex justify-content-center mb-3">
                  <label for="index_image" style="text-align: center;">Background Image(Index)</label>
                </div>
                <input type="file" class="form-control mx-auto" id="index_image" name="index_image" placeholder="Enter Image URL OR Path" style="max-width: 300px" >
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
